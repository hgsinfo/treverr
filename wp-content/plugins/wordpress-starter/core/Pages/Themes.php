<?php
namespace SiteGround_Central\Pages;

use SiteGround_Central\Rest\Rest;
use SiteGround_Central\Control\Themes as Themes_Control;
/**
 * SG Central Themes main class
 */
class Themes extends Custom_Page {
	/**
	 * Parent slug.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $parent_slug = 'themes.php';

	/**
	 * Capability.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $capability = 'install_themes';

	/**
	 * Menu slug.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $menu_slug = 'sg-themes-install.php';

	/**
	 * For checking the paths for overriding urls.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $submenu_slug = 'theme-install.php';

	/**
	 * Option which returns whether to hide or show custom page
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $option_name = 'siteground_wizard_hide_custom_themes';

	/**
	 * The page name for loading the correct scripts.
	 *
	 * @since  1.0.0
	 *
	 * @var string
	 */
	public $page_id = 'appearance_page_sg-themes-install';

	/**
	 * The network page name for loading the correct scripts.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $page_id_network = 'appearance_page_sg-themes-install-network';

	/**
	 * The singleton instance.
	 *
	 * @since 1.0.0
	 *
	 * @var The singleton instance.
	 */
	private static $instance;

	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Bail if the page should not be replaced.
		if ( false === $this->maybe_show_page() ) {
			return;
		}

		// Construct the parent.
		parent::__construct();

		$themes_control = new Themes_Control();
		// Highlight the submenu item.
		add_action( 'submenu_file', array( $this, 'highlight_submenu_menu_item' ) );
		// Add the load more script.
		add_action( 'wp_ajax_ajax_themes', array( $themes_control, 'ajax_themes' ) );
	}

	/**
	 * Prepare the necessary scripts.
	 *
	 * @since  1.0.0
	 */
	public function enqueue_scripts() {
		// Check if we are on the correct page.
		if ( false === $this->maybe_page() ) {
			return;
		}

		wp_enqueue_script( 'sg-central', \SiteGround_Central\URL . '/assets/js/sg-central.js', array( 'jquery' ), \Siteground_Central\VERSION );
		wp_enqueue_script( 'sg-themes', \SiteGround_Central\URL . '/assets/js/sg-themes.js', array( 'jquery', 'underscore' ), \Siteground_Central\VERSION );
		wp_enqueue_style( 'siteground-central-style', \SiteGround_Central\URL . '/assets/css/style.css' );


		wp_localize_script(
			'sg-themes',
			'centralData',
			array(
				'restNamespace' => untrailingslashit( get_rest_url( null, Rest::REST_NAMESPACE ) ),
				'rest_nonce' => wp_create_nonce( 'wp_rest' ),
			)
		);

		// Dequeue conflicting styles.
		foreach ( $this->dequeued_styles as $style ) {
			wp_dequeue_style( $style );
		}

		wp_localize_script(
			'sg-themes',
			'i18_strings',
			array(
				'activating'            => __( 'Activating...', 'siteground-wizard' ),
				'activate'              => __( 'Activate', 'siteground-wizard' ),
				'installing'            => __( 'Installing...', 'siteground-wizard' ),
				'install'               => __( 'Install', 'siteground-wizard' ),
				'importing_sample_data' => __( 'Importing Sample Data', 'siteground-wizard' ),
				'live_preview'          => __( 'Live Preview', 'siteground-wizard' ),
			)
		);

		wp_localize_script(
			'sg-central',
			'i18_strings_central',
			array(
				'installing' => __( 'Installing...', 'siteground-wizard' ),
			)
		);

	}

	/**
	 * Set the parent file to themes.php in order to hightlight
	 * the "Themes" when the current page is opened,
	 *
	 * @since  1.0.0
	 *
	 * @param  string $parent_file The parent file name.
	 *
	 * @return string $parent_file The modified parent file name.
	 */
	public function highlight_submenu_menu_item( $parent_file ) {
		// Get the current screen.
		$current_screen = get_current_screen();

		// Check whether is the custom dashboard page
		// and change the `parent_file` to themes.php.
		if ( 'appearance_page_sg-themes-install' === $current_screen->base ) {
			$parent_file = $this->parent_slug;
		}

		// Return the `parent_file`.
		return $parent_file;
	}

	/**
	 * Reorder or Remove button from the menu.
	 *
	 * @since  1.0.0
	 *
	 * @param  bool $menu_order Flag if the menu order is enabled.
	 *
	 * @return bool $menu_order Flag if the menu order is enabled.
	 */
	public function reorder_submenu_pages( $menu_order ) {
		// Check user capabilities.
		if ( ! current_user_can( 'switch_themes' ) ) {
			return $menu_order;
		}

		// Load the global submenu.
		global $submenu;

		// Find the "Add New" menu ID.
		foreach ( $submenu['themes.php'] as $key => $key_array ) {
			if ( false !== array_search( 'sg-themes-install.php', $submenu['themes.php'][$key] ) ) {
				$menu_key_id = $key;
			}
		}

		// Remove the menu button.
		if ( filter_var( $menu_key_id, FILTER_VALIDATE_INT ) ) {
			unset( $submenu['themes.php'][$menu_key_id] );
		}

		return $menu_order;
	}
}
