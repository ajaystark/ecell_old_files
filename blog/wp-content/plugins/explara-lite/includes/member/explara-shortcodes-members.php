<?php
namespace explara;

// Members as list
add_shortcode('explara-group', array('explara\ExplaraShortcodesMembers', 'group'));

class ExplaraShortcodesMembers {

	public static function group($atts) {

		$default = array(
			'id' => NULL,
			'type' => 'members',
			'layout' => 'section',
			'count' => 10,
			'class' => '',
		);

		extract(shortcode_atts($default, $atts));

		// Validation Check
		if ($atts['id'] == NULL) {

			return "Please add a group id.";
		}

		if ($atts['type'] == 'login') {

			return self::members_login($atts);

		} elseif ($atts['type'] == 'members') {

			return self::members_list($atts);
		}
	}

	public static function members_list($atts) {

		$data['atts'] = $atts;

		if ($atts['layout'] == 'section') {

			$api_data = ExplaraMemberApi::getMemberList($atts['id'], $atts['membership']);

			$file = 'list.php';

		} else {

			$api_data = ExplaraMemberApi::getMemberListPage($atts['id'], $atts['membership']);

			$file = 'page.php';
		}

		$data['members'] = json_decode(json_encode($api_data->membership), true);

		return includeShortcodeFile('members/shortcode-members-' . $file, $data);
	}

	private static function members_login($atts) {

		$data['atts'] = $atts;

		if ($atts['layout'] == 'section') {

			$api_data = ExplaraMemberApi::getGroupDetails($atts['id']);

			$file = 'login.php';

		} else {

			$api_data = ExplaraMemberApi::getGroupDetails($atts['id']);

			$file = 'login-page.php';
		}

		$data['group'] = json_decode(json_encode($api_data->details), true);

		return includeShortcodeFile('members/shortcode-members-' . $file, $data);
	}

}
