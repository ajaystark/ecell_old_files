<?php

class ExplaraEvents_Install {

	public static function activate() {

		add_option('explara_lite_version', EXPL_LITE_VERSION);

		add_option('explara_lite_access_token');
	}

	public static function deactivate() {
		return true;
	}

	public static function delete() {

		self::deleteOptionEntries();
	}

	private function deleteOptionEntries() {

		delete_option('explara_lite_access_token');
		delete_option('explara_events_version');
	}
}

?>