<?php

namespace explara;

class ShortcodeGenerator {

	public static function eventShortcode() {

		$config = "Shortcode for ";

		$shortcode = "[explara-events ";

		// type
		$shortcode = $shortcode . " type=" . $_POST['events_type'];

		$config .= ucfirst($_POST['events_type']) . ' Events in ';

		// layout
		$shortcode = $shortcode . " layout=" . $_POST['events_layout_type'];

		$config .= ucfirst($_POST['events_layout_type']) . ' as ';

		// view type
		$shortcode = $shortcode . " view=" . $_POST['events_view_type'];

		$config .= ucfirst($_POST['events_view_type']) . ' View';

		// count
		if ($_POST['events_count'] != '') {
			$shortcode = $shortcode . " count=" . $_POST['events_count'];
		}

		$shortcode = $shortcode . "]";

		// Storing the shortcode
		ShortcodeStore::update('events', $shortcode, $config);

		return $shortcode;
	}

	public static function groupShortcode() {

		$config = "Shortcode for ";

		$shortcode = "[explara-group ";

		// id
		$shortcode = $shortcode . " id=" . $_POST['groupId'];

		$config .= ucfirst($_POST['groupIdName']) . ' Group <br>for ';

		// type
		$shortcode = $shortcode . " type=" . $_POST['member_listing_type'];

		$config .= ucfirst($_POST['member_listing_type']) . ' with Membership Type as ';

		// Membership Type
		$shortcode = $shortcode . " membership=" . $_POST['membershipType'];

		$config .= ucfirst($_POST['membershipTypeName']) . ' in ';

		// layout
		$shortcode = $shortcode . " layout=" . $_POST['member_layout_type'];

		$config .= ucfirst($_POST['member_layout_type']) . ' View';

		// count
		if ($_POST['members_count'] != '') {
			$shortcode = $shortcode . " count=" . $_POST['members_count'];
		}

		$shortcode = $shortcode . "]";

		// Storing the shortcode
		ShortcodeStore::update('groups', $shortcode, $config);

		return $shortcode;
	}
}
