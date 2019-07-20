<?php
namespace explara;
/**
 * @package Internals
 */

class ExpGet {

	public static function getCustomization() {

		$explara_events_customization = get_option('explara_events_customization');
		if (!empty($explara_events_customization)) {
			return unserialize($explara_events_customization);
		}

		return self::initCustomizationDefaultData();
	}

	private static function initCustomizationDefaultData() {

		$new_value = [
			'card_data' => [],
			'font_data' => [],
			'button_data' => [],
		];

		$new_value['card_data']['card_title_color'] = '#222222';
		$new_value['card_data']['card_description_color'] = '#555555';
		$new_value['font_data']['font_family'] = "'Open Sans',sans-serif";
		$new_value['font_data']['font_style'] = 'inherit';
		$new_value['button_data']['button_background_color'] = '#00D579';
		$new_value['button_data']['button_color'] = '#FFFFFF';

		return $new_value;
	}

}