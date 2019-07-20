<?php
namespace explara;

class AdminGroups {

	public static function getAllGroups($orderby, $order) {

		global $wpdb;
		$explara_groups = $wpdb->prefix . 'explara_groups';

		$query = "SELECT * FROM $explara_groups";

		if (isset($_GET['status'])) {
			$status = $_GET['status'];
			$query .= " WHERE status = '$status' ";
		}

		if (isset($_GET['s'])) {
			$keyword = $_GET['s'];
			$query .= " WHERE group_title LIKE '%$keyword%' ";
		}

		if (isset($_GET['orderby'])) {
			$query .= " ORDER BY $orderby $order";
		}

		$sql_results = $wpdb->get_results($query);

		return $sql_results;

	}

	public static function getListGroups() {

		global $wpdb;
		$explara_groups = $wpdb->prefix . 'explara_groups';

		$query = "SELECT id, group_id, group_title FROM $explara_groups";
		$sql_results = $wpdb->get_results($query);

		return $sql_results;
	}

	public static function getListShownGroups() {

		global $wpdb;
		$explara_groups = $wpdb->prefix . 'explara_groups';

		$query = "SELECT id, group_id, group_title FROM $explara_groups  WHERE status = 'created' ";
		$sql_results = $wpdb->get_results($query);

		return $sql_results;

	}

	public static function getSingleGroup() {

		global $wpdb;
		$explara_groups = $wpdb->prefix . 'explara_groups';

		$group_id = isset($_GET['group_id']) ? $_GET['group_id'] : NULL;

		if (empty($group_id)) {
			return NULL;
		}

		$query = "SELECT * FROM $explara_groups WHERE group_id = '$group_id' ";
		$sql_results = $wpdb->get_row($query);

		return $sql_results;
	}
}
?>