<?php
namespace explara;

add_shortcode('explara-membership', array('explara\ExplaraMembershipShortcodes', 'groups'));

class ExplaraMembershipShortcodes {

	public static function groups($atts) {

		ob_start();

		extract(shortcode_atts(array(), $atts));

		self::getSingleGroupTemplate();

		$event_templates = ob_get_clean();

		return $event_templates;
	}

	private static function getSingleGroupTemplate() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		$is_exp_event_active = is_plugin_active('explara-events/explara-events.php');

		$photos = [];
		$hasTabs = false;
		$past_events = [];
		$upcoming_events = [];
		$event_style = '';

		$db_group = ExpGroupsDB::getGroup();

		if (empty($db_group)) {
			explara_member_redirect(home_url());
			exit;
		}

		$group = ExplaraMemberAdminApi::getSingleGroup($db_group->group_id);
		$group = $group->details;
		$group->db_group = $db_group;

		$SiginPageId = get_option('explara_membership_account_page');
		$signin_url = get_permalink($SiginPageId) . '?page=signin&from=' . $db_group->complete_link;

		$portal_link = get_option('explara_membership_portal_page');
		$portal_link = get_permalink($portal_link);
		$headerImage = "";

		if (isset($group->tabs) && !empty($group->tabs)) {
			$photos = self::getSingleGroupPhotos($group->tabs);
			$hasTabs = true;

			$past_events = self::getProcessEvents($group->tabs->Events->details->past, $is_exp_event_active);
			$upcoming_events = self::getProcessEvents($group->tabs->Events->details->upcoming, $is_exp_event_active);

			$upcoming_calendar_events = self::getUpcomingCalendarEvents($upcoming_events);
			$past_calendar_events = self::getPastCalendarEvents($past_events);
		}

		if (!empty($upcoming_events)) {
			$event_style = 'display: none';
		}

		$checkAuth = ExplaraMembershipAccountPost::checkAuth();
		$isMember = false;
		$groupMemberRenewLink = NULL;

		$all_members_list = ExplaraMemberAdminApi::getSingleMembers($db_group->group_id);
		$all_members_list = $all_members_list->membership;

		if (isset($group->headerImage) && !empty($group->headerImage)) {
			$headerImage = $group->headerImage;
		}

		if ($checkAuth) {

			$myMembership = ExplaraMembershipAccountPost::getMyMembership($db_group->group_id);
			$myMembership = $myMembership->membership;

			if (!isset($_GET['page'])) {

				if (!empty($myMembership) && count($myMembership) > 0) {

					if (isset($myMembership[0])) {
						$groupMemberRenewLink = $myMembership[0]->renewLink;
						if ($myMembership[0]->status != 'expired') {
							$isMember = true;
						}
					}
				}
			}
		}

		if (!isset($_GET['page'])) {

			if ($group->visibility == 'password-protected') {

				if (!$checkAuth) {
					explara_member_redirect($signin_url);
					exit;
				}

				if ($isMember) {
					return require EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/groups/single-group.php';
				} else {
					return require EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/groups/single-group-nonmember.php';
				}

			} else {

				return require EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/groups/single-group.php';
			}

		} else {
			$page = $_GET['page'];
		}

		if ($page == 'renew') {

			if ($checkAuth == false) {

				explara_member_redirect($signin_url);
				exit;
			}

			if (!empty($myMembership)) {
				$myMembership = $myMembership[0];
				$renewLink = $myMembership->renewLink;

				explara_member_redirect($renewLink);
				exit;
			}
		}

		switch ($page) {

		case 'renew':
			$file = 'group-renew.php';
			break;

		case 'checkout':

			$group->plans = ExplaraMemberAdminApi::getGroupMembershipPlanDetails($db_group->group_id);
			$group->baseCurrency = $group->plans->baseCurrency;

			$file = 'group-checkout.php';

			if ($group->accessType == 'public' && $group->visibility == 'public') {
				$file = 'group-open.php';
			}

			if ($group->visibility == 'password-protected') {

				if ($checkAuth == false) {
					explara_member_redirect($signin_url);
					exit;
				}

				$file = 'group-close.php';

				if ($group->accessType == 'restricted') {
					$file = 'group-close.php';
				}
				if ($group->accessType == 'nonmember') {
					$file = 'group-close.php';
				}
			}

			break;
		}

		return require EXPL_MEMBERSHIP_PLUGIN_DIR . '/pages/member/groups/' . $file;

	}

	public static function getSingleGroupPhotos($tabs) {

		$photos = [];

		if (!empty($tabs->Photos)) {
			if (!empty($tabs->Photos->details) && $tabs->Photos->details != null) {

				foreach ($tabs->Photos->details as $category) {
					if (!empty($category->images)) {
						$photos = array_merge($photos, $category->images);
					}
				}

			}
		}

		return $photos;
	}

	public static function checkMemberInGroup($members, $account_id) {

		$photos = [];
		$returnvalue = false;

		foreach ($members as $member) {

			if ($member->memberId == $account_id) {
				$returnvalue = true;
				break;
			}

		}

		return $returnvalue;
	}

	public static function getProcessEvents($events, $is_active) {

		$results = [];

		if ($events == null) {
			return $results;
		}

		$PageId = get_option('explara_events_page');
		$events_page_url = get_permalink($PageId);

		foreach ($events as $event) {

			if ($is_active) {
				$native_event_display_id = ExpMembershipDBClass::getEventDisplayIdByEventId($event->id);

				if ($native_event_display_id) {

					$native_event_url = $events_page_url . '?event_id=' . $native_event_display_id;
					$event->url = $native_event_url;
				}

			}
		}

		return $events;
	}

	public static function getUpcomingCalendarEvents($events) {
		$calendar_events = [];

		foreach ($events as $key => $event) {

			$innArr['event_id'] = $event->id;
			$innArr['url'] = $event->url;
			$innArr['title'] = $event->name;
			$innArr['start'] = $event->startDate->date;
			$innArr['end'] = $event->endDate->date;

			array_push($calendar_events, $innArr);
		}

		return $calendar_events;
	}

	public static function getPastCalendarEvents($events) {
		$calendar_events = [];

		foreach ($events as $key => $event) {

			$innArr['event_id'] = $event->id;
			$innArr['url'] = $event->url;
			$innArr['title'] = $event->name;
			$innArr['start'] = $event->startDate->date;
			$innArr['end'] = $event->endDate->date;

			array_push($calendar_events, $innArr);
		}

		return $calendar_events;
	}

}
?>