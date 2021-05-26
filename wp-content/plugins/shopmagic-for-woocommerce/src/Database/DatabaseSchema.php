<?php
/**
 * Creates tables and populate data for plugin
 */

namespace WPDesk\ShopMagic\Database;

use WPDesk\ShopMagic\Frontend\ListsOnAccount;
use WPDesk\ShopMagic\Guest\GuestBackgroundConverter;

class DatabaseSchema {
	const VERSION = 42;
	const OPTION_NAME_WITH_VERSION = 'shopmagic_db_version';
	const OPTION_DB_LOG = 'shopmagic_db_log';

	/** @var string */
	private $base_file_name;

	/** @var string[] */
	private $log;

	/**
	 * @return string
	 */
	public static function get_optin_email_table_name() {
		global $wpdb;

		return $wpdb->prefix . 'shopmagic_optin_email';
	}

	/**
	 * @return string
	 */
	public static function get_automation_outcome_table_name() {
		global $wpdb;

		return $wpdb->prefix . 'shopmagic_automation_outcome';
	}

	/**
	 * @return string
	 */
	public static function get_guest_table_name() {
		global $wpdb;

		return $wpdb->prefix . 'shopmagic_guest';
	}

	/**
	 * @return string
	 */
	public static function get_guest_meta_table_name() {
		global $wpdb;

		return $wpdb->prefix . 'shopmagic_guest_meta';
	}

	/**
	 * @return string
	 */
	public static function get_outcome_logs_table_name() {
		global $wpdb;

		return $wpdb->prefix . 'shopmagic_automation_outcome_logs';
	}

	public function __construct( $base_file_name ) {
		$this->base_file_name = $base_file_name;
		$this->log            = json_decode( get_option( self::OPTION_DB_LOG, '[]' ), true );
		if ( ! is_array( $this->log ) ) {
			$this->log = [];
		}
	}

	public function register_activation_hook() {
		register_activation_hook( $this->base_file_name, array( $this, 'install' ) );
	}

	/**
	 * @return bool
	 */
	public function is_old_database() {
		return $this->get_current_db_version() !== self::VERSION;
	}

	/**
	 * @return int
	 */
	private function get_current_db_version() {
		return (int) get_option( self::OPTION_NAME_WITH_VERSION, 0 );
	}

	/**
	 * @return bool
	 */
	private function v37() {
		global $wpdb;

		$table_name      = self::get_optin_email_table_name();
		$charset_collate = $wpdb->get_charset_collate();

		$table_optin_sql = "CREATE TABLE {$table_name} (
			id int NOT NULL AUTO_INCREMENT,
			email varchar(255) NOT NULL,
			communication_type int NOT NULL,
			created datetime NOT NULL,
			subscribe tinyint(1) NOT NULL,
			active tinyint(1) NOT NULL DEFAULT TRUE,
			PRIMARY KEY  (id)
		) {$charset_collate};";

		$results = dbDelta( [ $table_optin_sql ] );

		$this->db_log( "v37 results: " . json_encode( $results ) );

		return true;
	}

	/**
	 * @return bool
	 */
	private function v39() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$result          = true;

		$table_outcome_name = self::get_automation_outcome_table_name();
		$result             = $result && $wpdb->query( "DROP TABLE IF EXISTS {$table_outcome_name};" );

		$sql = "CREATE TABLE IF NOT EXISTS {$table_outcome_name} (
			id int NOT NULL AUTO_INCREMENT,
			execution_id varchar(48) NOT NULL,
			automation_id int NOT NULL,
			automation_name varchar(255) NOT NULL,
			action_index varchar(255) NOT NULL,
			action_name varchar(255) NOT NULL,
			customer_id int,
			guest_id int,
			customer_email varchar(255) NOT NULL,
			success tinyint(1),
			finished tinyint(1) NOT NULL DEFAULT FALSE,
			created datetime NOT NULL,
			updated datetime NOT NULL,
			PRIMARY KEY  (id)
		) {$charset_collate};";

		$result = $result && $wpdb->query( $sql );

		$this->db_log( "v39-1 result: " . json_encode( $result ) );

		if ( $result ) {
			$table_name = self::get_outcome_logs_table_name();
			$result     = $result && $wpdb->query( "DROP TABLE IF EXISTS {$table_name};" );

			$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
				id int NOT NULL AUTO_INCREMENT,
				execution_id varchar(48) NOT NULL,
				note varchar(2048) NOT NULL,
				created datetime NOT NULL,
				PRIMARY KEY  (id),
				KEY execution_id (execution_id)
			) {$charset_collate};";

			$result = $result && $wpdb->query( $sql );
			$this->db_log( "v39-2 result: " . json_encode( $result ) );
		}

		return $result;
	}

	/**
	 * @return bool
	 */
	private function v40() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		$result          = true;

		$table_guest_name = self::get_guest_table_name();
		$result           = $result && $wpdb->query( "DROP TABLE IF EXISTS {$table_guest_name};" );

		$sql = "CREATE TABLE IF NOT EXISTS {$table_guest_name} (
			id int NOT NULL AUTO_INCREMENT,
			email varchar(255) NOT NULL,
			tracking_key varchar(32) NOT NULL,
			created datetime NOT NULL,
			updated datetime NOT NULL,
			PRIMARY KEY  (id)
		) {$charset_collate};";

		$result = $result && $wpdb->query( $sql );

		$this->db_log( "v40-1 result: " . json_encode( $result ) );

		if ( $result ) {
			$table_name = self::get_guest_meta_table_name();
			$result     = $result && $wpdb->query( "DROP TABLE IF EXISTS {$table_name};" );

			$sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
				meta_id int NOT NULL AUTO_INCREMENT,
				guest_id int NOT NULL,
				meta_key varchar(255) NOT NULL,
				meta_value longtext NOT NULL,
				PRIMARY KEY  (meta_id),
				KEY guest_id (guest_id)
			) {$charset_collate};";

			$result = $result && $wpdb->query( $sql );
			$this->db_log( "v40-2 result: " . json_encode( $result ) );
		}

		return $result;
	}

	/**
	 * @return bool
	 */
	private function v41() {
		global $wpdb;
		$result = true;

		$table_name = self::get_outcome_logs_table_name();

		$sql    = "ALTER TABLE {$table_name} MODIFY `note` TEXT NOT NULL";
		$result = $result && $wpdb->query( $sql );
		$sql    = "ALTER TABLE {$table_name} ADD `note_context` TEXT";
		$result = $result && $wpdb->query( $sql );

		$this->db_log( "v41 result: " . json_encode( $result ) );

		return $result;
	}

	/**
	 * Save info to special log that should be almost always available (if db is).
	 *
	 * @param string $message
	 */
	private function db_log( $message ) {
		$max_log_size = 30;
		$this->log[]  = date( 'Y-m-d G:i:s' ) . ": {$message}";
		if ( count( $this->log ) > $max_log_size ) {
			array_shift( $this->log );
		}
		update_option( self::OPTION_DB_LOG, json_encode( $this->log ), false );
	}

	/**
	 *  Creates tables
	 */
	public function install() {
		global $wpdb;
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

		$this->db_log( 'DB update start' );
		$current_version = $this->get_current_db_version();
		$no_errors       = true;

		$target_version = 37;
		if ( $no_errors && $current_version < $target_version ) {
			$this->db_log( "DB update {$current_version}:{$target_version}" );
			$no_errors = $no_errors && $this->v37();
			$this->db_log( "DB update {$current_version}:{$target_version} -> " . ( $no_errors ? 'OK' : 'ERROR: ' . $wpdb->last_error ) );
			update_option( self::OPTION_NAME_WITH_VERSION, $target_version, true );
		}

		$target_version = 39;
		if ( $no_errors && $current_version < $target_version ) {
			$this->db_log( "DB update {$current_version}:{$target_version}" );
			$no_errors = $no_errors && $this->v39();
			$this->db_log( "DB update {$current_version}:{$target_version} -> " . ( $no_errors ? 'OK' : 'ERROR: ' . $wpdb->last_error ) );
			update_option( self::OPTION_NAME_WITH_VERSION, $target_version, true );
		}

		$target_version = 40;
		if ( $no_errors && $current_version < $target_version ) {
			$this->db_log( "DB update {$current_version}:{$target_version}" );
			$no_errors = $no_errors && $this->v40();
			$this->db_log( "DB update {$current_version}:{$target_version} -> " . ( $no_errors ? 'OK' : 'ERROR: ' . $wpdb->last_error ) );
			update_option( self::OPTION_NAME_WITH_VERSION, $target_version, true );
		}

		$target_version = 41;
		if ( $no_errors && $current_version < $target_version ) {
			$this->db_log( "DB update {$current_version}:{$target_version}" );
			$no_errors = $no_errors && $this->v41();
			$this->db_log( "DB update {$current_version}:{$target_version} -> " . ( $no_errors ? 'OK' : 'ERROR: ' . $wpdb->last_error ) );
			update_option( self::OPTION_NAME_WITH_VERSION, $target_version, true );
		}

		$target_version = 42;
		if ( $no_errors && $current_version < $target_version ) {
			delete_option( GuestBackgroundConverter::CONVERSION_MUTEX_OPTION_NAME );
			update_option( self::OPTION_NAME_WITH_VERSION, $target_version, true );
		}

		if ( $no_errors ) {
			add_action( 'wp_loaded', function () {
				if ( get_option( ListsOnAccount::ACCOUNT_PAGE_ID_OPTION_KEY ) === false ) {
					$this->add_account_communication_page();
				}

				$this->db_log( 'DB update done' );
			} );
		}
		if ( ! $no_errors ) {
			$error_msg = "Error while upgrading a database: " . $wpdb->last_error;
			$this->db_log( $error_msg );
			error_log( $error_msg );
		}
	}

	private function add_account_communication_page() {
		$page_id = wp_insert_post( [
			'post_name'      => __( 'communication-preferences', 'shopmagic-for-woocommerce' ),
			'post_title'     => __( 'Communication preferences', 'shopmagic-for-woocommerce' ),
			'post_content'   => '[' . ListsOnAccount::ACCOUNT_SHORTCODE . ']',
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'post_author'    => 1,
			'comment_status' => 'closed',
		] );
		update_option( ListsOnAccount::ACCOUNT_PAGE_ID_OPTION_KEY, $page_id );
	}
}
