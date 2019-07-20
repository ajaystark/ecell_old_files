<?php
namespace explara;
/**
 * @package Internals
 */

class ExpMembershipGet {

	public static function getCustomization() {

		$explara_membership_customization = get_option('explara_membership_customization');
		if (!empty($explara_membership_customization)) {
			return unserialize($explara_membership_customization);
		}

		return self::initCustomizationDefaultData();
	}

	private static function initCustomizationDefaultData() {

		$new_value = [
			'card_data' => [],
			'font_data' => [],
			'button_data' => [],
		];

		$new_value['card_data']['card_title_color'] = '#333333';
		$new_value['card_data']['card_description_color'] = '#333333';
		$new_value['font_data']['font_family'] = "'Open Sans',sans-serif";
		$new_value['font_data']['font_style'] = 'inherit';
		$new_value['button_data']['button_background_color'] = '#4a90e2';
		$new_value['button_data']['button_color'] = '#FFFFFF';

		return $new_value;
	}

}