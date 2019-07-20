<?php
namespace explara;

if (!class_exists('\WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class AdminGroupsListtable extends \WP_List_Table {

	private $order;
	private $orderby;
	private $items_per_page = 10;

	public function __construct() {
		parent::__construct();

		$this->set_order();
		$this->set_orderby();
		$this->prepare_items();
		$this->get_bulk_actions();
	}

	private function get_sql_results() {

		$groups = AdminGroups::getAllGroups($this->orderby, $this->order);
		return $groups;
	}

	public function set_order() {
		$order = 'DESC';

		if (isset($_GET['order']) AND $_GET['order']) {
			$order = $_GET['order'];
		}

		$this->order = esc_sql($order);
	}

	public function set_orderby() {
		$orderby = 'group_created_at';

		if (isset($_GET['orderby']) AND $_GET['orderby']) {
			$orderby = $_GET['orderby'];
		}

		$this->orderby = esc_sql($orderby);
	}

	/**
	 * @see WP_List_Table::ajax_user_can()
	 */
	public function ajax_user_can() {
		return current_user_can('edit_posts');
	}

	/**
	 * @see WP_List_Table::no_items()
	 */
	public function no_items() {
		_e('No groups found. Please create groups at Explara Platform and click on Fetch & Sync');
	}

	/**
	 * @see WP_List_Table::get_views()
	 */
	public function get_views() {

		$views = array();
		$current = (!empty($_REQUEST['status']) ? $_REQUEST['status'] : 'all');

		//All link
		$class = ($current == 'all' ? ' class="current"' : '');
		$all_url = remove_query_arg('status');
		$views['all'] = "<a href='{$all_url}' {$class} >All</a>";

		//Published link
		$published_url = add_query_arg('status', 'published');
		$class = ($current == 'published' ? ' class="current"' : '');
		$views['published'] = "<a href='{$published_url}' {$class} >Published</a>";

		return $views;
	}

	/**
	 * @see WP_List_Table::get_columns()
	 */
	public function get_columns() {
		$columns = array(
			'group_title' => __('Title'),
			'visibility' => __('Visibility'),
			'group_category' => __('Type'),
			'status' => __('Status'),
			'action' => __('Action'),

		);

		return $columns;
	}

	/**
	 * @see WP_List_Table::get_sortable_columns()
	 */
	public function get_sortable_columns() {
		$sortable = array(
			'group_title' => array('group_title', true),
			'visibility' => array('visibility', true),
			'group_category' => array('group_category', true),
			'status' => array('status', true),
		);

		return $sortable;
	}

	public function get_hidden_columns() {
		$hidden = array();

		return $hidden;
	}

	/**
	 * Prepare data for display
	 * @see WP_List_Table::prepare_items()
	 */
	public function prepare_items() {
		$columns = $this->get_columns();

		$hidden = $this->get_hidden_columns();

		$sortable = $this->get_sortable_columns();

		$this->_column_headers = array($columns, $hidden, $sortable);

		// SQL results
		$posts = $this->get_sql_results();

		empty($posts) AND $posts = array();

		# >>>> Pagination
		$per_page = $this->items_per_page;

		$current_page = $this->get_pagenum();

		$total_items = count($posts);

		$this->set_pagination_args(array(
			'total_items' => $total_items,
			'per_page' => $per_page,
			'total_pages' => ceil($total_items / $per_page),
		));

		$last_post = $current_page * $per_page;
		$first_post = $last_post - $per_page + 1;
		$last_post > $total_items AND $last_post = $total_items;

		// Setup the range of keys/indizes that contain
		// the posts on the currently displayed page(d).
		// Flip keys with values as the range outputs the range in the values.
		$range = array_flip(range($first_post - 1, $last_post - 1, 1));

		// Filter out the posts we're not displaying on the current page.
		$posts_array = array_intersect_key($posts, $range);
		# <<<< Pagination

		$processData = $this->process_items($posts_array);

		$this->items = $processData;
	}

	/**
	 * A single column
	 */
	public function column_default($item, $column_name) {
		return $item->$column_name;
	}

	public function process_items($items) {
		$process_items = array();

		foreach ($items as $key => $item) {

			$checked = '';

			$item->group_title = '<a data-group="' . $item->group_id . '" href="#" >' . $item->group_title . '</a>';

			$item->visibility = ucfirst($item->visibility);
			$item->status = ucfirst($item->status);

			$is_shown = (int) $item->is_shown;
			$button_text = 'Show';
			$button_attr = "";
			if ($is_shown === 1) {
				$checked = 'checked';
				$button_text = 'Showing';
				$button_attr = "disabled='true' style='pointer-events: none'";
			}

			$item->action = '<button ' . $button_attr . ' id="group_' . $item->id . '" class="exp_membership_toggle_group page-title-action tgl tgl-light " data-group="' . $item->id . '" data-shown="' . $item->is_shown . '" type="radio" name="exp_membership_toggle_group" ' . $checked . ' >' . $button_text . '</button>';

			$process_items[$key] = $item;

		}

		return $process_items;
	}
}
?>