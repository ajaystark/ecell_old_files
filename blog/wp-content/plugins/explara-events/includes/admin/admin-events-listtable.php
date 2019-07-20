<?php
namespace explara;

if (!class_exists('\WP_List_Table')) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class AdminEventsListtable extends \WP_List_Table {

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

		$events = AdminEvents::getAllEvents($this->orderby, $this->order);
		return $events;
	}

	public function set_order() {
		$order = 'DESC';

		if (isset($_GET['order']) AND $_GET['order']) {
			$order = $_GET['order'];
		}

		$this->order = esc_sql($order);
	}

	public function set_orderby() {
		$orderby = 'event_created_at';

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
		_e('No events found. Please create events at Explara Platform and click on Fetch & Sync');
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
			'cb' => '<input type="checkbox" />',
			'event_title' => __('Title'),
			'type' => __('Type'),
			'created_on' => __('Created'),
			'start_date_time' => __("Starts"),
			'end_date_time' => __("Ends"),
			'status' => __('Status'),
			'action' => __('Show/Hide'),
		);

		return $columns;
	}

	/**
	 * @see WP_List_Table::get_sortable_columns()
	 */
	public function get_sortable_columns() {
		$sortable = array(
			'event_title' => array('event_title', true),
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

			$event_data = json_decode($item->list_dump);
			$checked = '';

			$item->event_title = '<a href="' . admin_url() . 'admin.php?page=explara-events&event_id=' . $item->event_display_id . ' " >' . $item->event_title . '</a>';
			$item->type = ucfirst($event_data->type);

			$item->created_on = date("d M Y", strtotime($event_data->createdOn));

			$item->start_date_time = date("d M Y", strtotime($event_data->startDate));
			$item->end_date_time = date("d M Y", strtotime($event_data->endDate));

			$item->status = ucfirst($item->status);

			$is_shown = (int) $item->is_shown;
			if ($is_shown === 1) {
				$checked = 'checked';
			}

			$item->action = '<input id="event_' . $item->id . '" class="exp_toggle_event tgl tgl-light" data-event="' . $item->id . '" data-shown="' . $item->is_shown . '" type="checkbox" name="exp_toggle_event" ' . $checked . ' > <label class="tgl-btn" for="event_' . $item->id . '">';

			$process_items[$key] = $item;

		}

		return $process_items;
	}

	public function get_bulk_actions() {
		return array(
			'show' => __('Show Events'),
			'hide' => __('Hide Events'),
		);
	}

	public function column_cb($item) {
		return sprintf(
			'<input class="explara_bulk_action_value" type="checkbox" name="events_ids[]" value="%s" />', $item->id
		);
	}

}
?>