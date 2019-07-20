<?php

namespace explara;

class ShortcodeStore {

	private static function getOptionKey($type) {

		if ($type == 'events') {
			return 'explara-lite-shortcodes-events';
		} else {
			return 'explara-lite-shortcodes-groups';
		}
	}

	private static function checkShortcodeExists($shortcodeArry, $shortcodeKey) {

		foreach ($shortcodeArry as $shortcode) {

			if ($shortcode['shortcode'] == $shortcodeKey) {
				return true;
			}
		}

		return false;

	}

	public static function update($type, $shortcode, $configuration) {

		// Get the Type of Shortcode
		// Check if option exists
		// Create the option
		// Append the shortcode if it doesnt exists
		// Serialize
		// Update the option
		//

		if (get_option(self::getOptionKey($type)) == false) {

			$shortcodes = [];

			add_option(self::getOptionKey($type), $shortcodes, NULL, 'no');
		}

		$existingShortcodes = get_option(self::getOptionKey($type));

		if (self::checkShortcodeExists($existingShortcodes, $shortcode)) {
			return;
		}

		$shortcodeRow = [];

		$shortcodeRow['shortcode'] = $shortcode;
		$shortcodeRow['config'] = $configuration;

		array_push($existingShortcodes, $shortcodeRow);

		// The option already exists, so we just update it.
		update_option(self::getOptionKey($type), $existingShortcodes);

	}

	public static function getAll($type) {

		// Get the Type of shotcode
		// Check if the option exists
		// Get the value of the option
		// Unserialize the data
		// return

		if (get_option(self::getOptionKey($type)) == false) {
			return false;
		}

		return get_option(self::getOptionKey($type));
	}

}