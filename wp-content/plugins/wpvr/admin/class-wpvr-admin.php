<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://rextheme.com/
 * @since      1.0.0
 *
 * @package    Wpvr
 * @subpackage Wpvr/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpvr
 * @subpackage Wpvr/admin
 * @author     Rextheme <sakib@coderex.co>
 */
class Wpvr_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The post type of this plugin.
	 *
	 * @since 1.0.0
	 */
	private $post_type;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $post_type ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->post_type = $post_type;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpvr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpvr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$screen = get_current_screen();
		if ($screen->id=="toplevel_page_wpvr") {
            wp_enqueue_style( 'materialize-css', plugin_dir_url( __FILE__ ) . 'css/materialize.min.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'materialize-icons', plugin_dir_url( __FILE__ ) . 'lib/materializeicon.css', array(), $this->version, 'all' );
            wp_enqueue_style( 'owl-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), $this->version, 'all' );
            
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpvr-admin.css', array(), $this->version, 'all' );
		}

		if ($screen->id=="wpvr_item") {

			 wp_enqueue_style( $this->plugin_name . 'fontawesome', plugin_dir_url( __FILE__ ) . 'lib/fontawesome/css/all.css', array(), $this->version, 'all' );
			 wp_enqueue_style( 'icon-picker-css', plugin_dir_url( __FILE__ ) . 'css/jquery.fonticonpicker.min.css', array(), $this->version, 'all' );
			 wp_enqueue_style( 'icon-picker-css-theme', plugin_dir_url( __FILE__ ) . 'css/jquery.fonticonpicker.grey.min.css', array(), $this->version, 'all' );
			 wp_enqueue_style( 'owl-css', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', array(), $this->version, 'all' );
			 wp_enqueue_style('panellium-css', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/css/pannellum.css', array(), true);
	 		 wp_enqueue_style('videojs-css', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/css/video-js.css', array(), true);
			 wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpvr-admin.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wpvr_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wpvr_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( 'wp-api' );
		$adscreen = get_current_screen();
		wp_enqueue_media();
		if ($adscreen->id=="wpvr_item" || $adscreen->id=="toplevel_page_wpvr") {
			wp_enqueue_script('icon-picker', plugin_dir_url( __FILE__ ) . 'lib/jquery.fonticonpicker.min.js', array(), true);
			wp_enqueue_script('panellium-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/pannellum.js', array(), true);
			wp_enqueue_script('panelliumlib-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/libpannellum.js', array(), true);
			wp_enqueue_script( 'videojs-js', plugin_dir_url( __FILE__ ) .'js/video.js', array('jquery'), true);
			wp_enqueue_script('panelliumvid-js', plugin_dir_url( __FILE__ ) . 'lib/pannellum/src/js/videojs-pannellum-plugin.js', array(), true);
			wp_enqueue_script( 'jquery-repeater', plugin_dir_url( __FILE__ ) .'js/jquery.repeater.min.js', array('jquery'), true);
			wp_enqueue_script('icon-picker', plugin_dir_url( __FILE__ ) . 'lib/jquery.fonticonpicker.min.js', array(), true);
			wp_enqueue_script( 'owl', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.js', array( 'jquery' ), false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpvr-admin.js', array( 'jquery' ), $this->version, true );
			wp_localize_script( $this->plugin_name, 'wpvr_obj', array(
		        'ajaxurl' => admin_url( 'admin-ajax.php' ),
		        'ajax_nonce' => wp_create_nonce('wpvr'),
		    ) );
		}

    if ($adscreen->id=="toplevel_page_wpvr") {
    	wp_enqueue_script( 'materialize-js', plugin_dir_url( __FILE__ ) . 'js/materialize.min.js', array( 'jquery' ), $this->version, false );
    }
        wp_enqueue_script( 'owl-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array( 'jquery' ), false );
		wp_enqueue_script( 'wpvr-global', plugin_dir_url( __FILE__ ) . 'js/wpvr-global.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( 'wpvr-global', 'wpvr_global_obj', array(
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'ajax_nonce' => wp_create_nonce('wpvr_global'),
			) );
	}


    /**
     * Plugin action links
     *
     * @param $links
     * @return array
     */
    public function plugin_action_links_wpvr( $actions, $plugin_file, $plugin_data, $context ) {
        $actions['get_started'] = sprintf(
            '<a href="%s">%s</a>',
            esc_url( admin_url( 'admin.php?page=wpvr' ) ),
            esc_html__( 'Get Started', 'wpvr' )
        );
        $actions['documentation'] = sprintf(
            '<a href="%s" target="_blank">%s</a>',
            esc_url( 'https://rextheme.com/docs-category/wp-vr/' ),
            esc_html__( 'Documentation', 'wpvr' )
        );

        if(!apply_filters('is_wpvr_pro_active', false))  {
            $actions['go-pro'] = sprintf(
                '<a href="%s" target="_blank"  style="color: #201cfe; font-weight: bold;">%s</a>',
                esc_url( 'https://rextheme.com/wpvr/#pricing' ),
                esc_html__( 'Go Pro', 'wpvr' )
            );
        }
        return $actions;
    }


    /**
	 * Init the edit screen of the plugin post type item
	 *
	 * @since 1.0.0
	 */
	public function wpvr_admin_init() {
		/*
		 *  Documentation : https://developer.wordpress.org/reference/functions/add_meta_box/
		 */

		add_meta_box(

			$this->post_type . '_builder__box',
			__('Tour Preview', $this->plugin_name),
			array($this, 'wpvr_display_meta_box_builder'),
			$this->post_type,
			'side',
			'high'
		);
	}


	/**
	 * Register the custom post type
	 *
	 * @since 1.0.0
	 */
	public function wpvr_add_plugin_custom_post_type() {
		$labels = array(
			'name'              => __( 'Tours', $this->plugin_name ),
			'singular_name'     => __( 'Tours', $this->plugin_name ),
			'add_new'           => __( 'Add New Tour', $this->plugin_name ),
			'add_new_item'      => __( 'Add New Tour', $this->plugin_name ),
			'edit_item'         => __( 'Edit Tour', $this->plugin_name ),
			'new_item'          => __( 'New Tour', $this->plugin_name ),
			'view_item'         => __( 'View Tour', $this->plugin_name ),
			'search_items'      => __( 'Search Wpvr Tour', $this->plugin_name ),
			'not_found'         => __( 'No Wpvr Tour found', $this->plugin_name ),
			'not_found_in_trash'=> __( 'No Wpvr Tour found in Trash', $this->plugin_name ),
			'parent_item_colon' => '',
			'all_items'         => __( 'All Tours', $this->plugin_name ),
			'menu_name'         => __( 'WP VR', $this->plugin_name ),
		);

		$args = array(
			'labels'          => $labels,
			'public'          => false,
			'show_ui'         => true,
			'show_in_menu'   	=> false,
			'menu_position'   => 100,
			'supports'        => array( 'title' ),
			'menu_icon'           => plugins_url(). '/wpvr/images/icon.png',
			'capabilities' => array(
					'edit_post' => 'edit_wpvr_tour',
					'edit_posts' => 'edit_wpvr_tours',
					'edit_others_posts' => 'edit_other_wpvr_tours',
					'publish_posts' => 'publish_wpvr_tours',
					'read_post' => 'read_wpvr_tour',
					'read_private_posts' => 'read_private_wpvr_tours',
					'delete_post' => 'delete_wpvr_tour'
			),
			'map_meta_cap'    => true,
		);

		/**
		 * Documentation : https://codex.wordpress.org/Function_Reference/register_post_type
		 */
		register_post_type( $this->post_type, $args );
	}

	/**
	 * Populates the data in the custom columns
	 *
	 * @since 1.0.0
	 */
	function wpvr_manage_posts_custom_column( $column_name ){
		$post = get_post();

		switch( $column_name ) {
			case 'shortcode' :
				echo '<code>[wpvr id="' . $post->ID . '"]</code>';
				break;
			default:
				break;
		}
	}

	/**
	 * Adds the custom columns to the post type admin screen
	 *
	 * @since 1.0.0
	 */
	public function wpvr_manage_post_columns() {
		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'title'     => __( 'Title', $this->plugin_name),
			'shortcode' => __( 'Shortcodes', $this->plugin_name),
			'author'    => __( 'Author', $this->plugin_name),
			'date'      => __( 'Date', $this->plugin_name)
		);
		return $columns;
	}

	/**
	 * Sets the messages for the custom post type
	 *
	 * @since 1.0.0
	 */
	public function wpvr_post_updated_messages( $messages ) {
		$messages[$this->post_type][1] = __( 'WP VR item updated.', $this->plugin_name);
		$messages[$this->post_type][4] = __( 'WP VR item updated.', $this->plugin_name);

		return $messages;
	}

	/**
	 * Render the shortcode box for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function wpvr_display_meta_box_shortcode() {

		include_once( 'partials/wpvr-meta-box-shortcode-display.php' );
	}

	/**
	 * Render the builder box for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function wpvr_display_meta_box_builder() {
		include_once( 'partials/wpvr-meta-box-builder-display.php' );
	}

	/**
	 * Custom Metabox
	*/
    public function wpvr_add_setup_metabox(){

        add_meta_box( 'setup', __( 'Setup' ), array($this, 'wpvr_setup'), 'wpvr_item', 'normal', 'high' );
    }
	public function wpvr_setup($post) {

		$data_limit = 5;

		$scene_limit = $data_limit + 1;
		$postdata = get_post_meta( $post->ID, 'panodata', true );


		$autoload = true;
		if (isset($postdata["autoLoad"])) {
			$autoload = $postdata["autoLoad"];
		}

		$control = true;
		if (isset($postdata["showControls"])) {
            $control = $postdata["showControls"];
		}

		$default_scene = '';
		if (isset($postdata["defaultscene"])) {
			$default_scene = $postdata["defaultscene"];
		}

		$preview = '';
		if (isset($postdata['preview'])) {
		  $preview = $postdata['preview'];
		}

		$autorotation = '';
		if (isset($postdata["autoRotate"])) {
			$autorotation = $postdata["autoRotate"];
		}
		else {
			$autorotation = -5;
		}
		$autorotationinactivedelay = '';
		if (isset($postdata["autoRotateInactivityDelay"])) {
			$autorotationinactivedelay = $postdata["autoRotateInactivityDelay"];
		}

		$autorotationstopdelay = '';
		if (isset($postdata["autoRotateStopDelay"])) {
			$autorotationstopdelay = $postdata["autoRotateStopDelay"];
		}

		$scene_fade_duration = '';
		if (isset($postdata["scenefadeduration"])) {
			$scene_fade_duration = $postdata["scenefadeduration"];
		}

		$pano_data = '';
		if (isset($postdata["panodata"])) {
			$pano_data = $postdata["panodata"];
		}

		$custom_icon_array = new Wpvr_fontawesome_icons();
		$custom_icon = $custom_icon_array->icon;

		$html = '';



		$html .= '<div class="pano-setup">';

        // active tab variables
        $active_tab = 'general';
        $scene_active_tab = 1;
        $hotspot_active_tab = 1;
        if(isset($_GET['active_tab'])) {
            $active_tab = $_GET['active_tab'];
        }
        if(isset($_GET['scene'])) {
            $scene_active_tab = $_GET['scene'];
        }
        if(isset($_GET['hotspot'])) {
            $hotspot_active_tab = $_GET['hotspot'];
        }

        $html = '';

        $html .= '<div class="pano-setup">';

        $html .= '<input type="hidden" value="'.$active_tab.'" name="wpvr_active_tab" id="wpvr_active_tab"/>';
        $html .= '<input type="hidden" value="'.$scene_active_tab.'" name="wpvr_active_scenes" id="wpvr_active_scenes"/>';
        $html .= '<input type="hidden" value="'.$hotspot_active_tab.'" name="wpvr_active_hotspot" id="wpvr_active_hotspot"/>';

        $html .= '<div class="pano-alert scene-alert">';
            $html .= '<span class="destroy"><i class="fa fa-times"></i></span>';
            $html .= '<p></p>';
        $html .= '</div>';

        $html .='<div class="rex-pano-tabs">';
            $html .='<nav class="rex-pano-tab-nav rex-pano-nav-menu main-nav" id="wpvr-main-nav">';
                $html .='<ul>';
                    $html .='<li class="logo"><img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/logo.png'.'" alt="logo" /></li>';

                    $html .='<li class="general active" data-screen="general">';
                        $html .='<span data-href="#general">';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/general-regular.png'.'" alt="icon" class="regular" />';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/general-hover.png'.'" alt="icon" class="hover" />';
                        $html .=''.__('General','wpvr').'</span>';
                    $html .='</li>';

                    $html .='<li class="scene" data-screen="scene">';
                        $html .='<span data-href="#scenes">';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/scenes-regular.png'.'" alt="icon" class="regular" />';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/scenes-hover.png'.'" alt="icon" class="hover" />';
                        $html .=''.__('Scenes','wpvr').'</span>';
                    $html .='</li>';

                    $html .='<li class="hotspot" data-screen="hotspot">';
                        $html .='<span data-href="#scenes">';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/hotspot-regular.png'.'" alt="icon" class="regular" />';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/hotspot-hover.png'.'" alt="icon" class="hover" />';
                        $html .=''.__('Hotspot','wpvr').'</span>';
                    $html .='</li>';

                    $html .='<li class="video" data-screen="video">';
                        $html .='<span data-href="#video">';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/video-regular.png'.'" alt="icon" class="regular" />';
                            $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/video-hover.png'.'" alt="icon" class="hover" />';
                        $html .=''.__('Video','wpvr').'</span>';
                    $html .='</li>';
                $html .='</ul>';
            $html .='</nav>';

            $html .='<div class="rex-pano-tab-content" id="wpvr-main-tab-contents">';
                $html .='<div class="rex-pano-tab general active" id="general">';
                        
                    //=start inner tab=
                    $html .= '<div class="general-inner-tab">';
                        //=start inner nav=
                        $html .= '<ul class="inner-nav">';

                            $html .='<li class="gen-basic active">';
                                $html .='<span data-href="#gen-basic">';
                                    $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/basic-settings-regular.png'.'" alt="icon" class="regular" />';
                                    $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/basic-settings-hover.png'.'" alt="icon" class="hover" />';
                                $html .=''.__('Basic Settings ','wpvr').'</span>';
                            $html .='</li>';

                            $html .='<li class="gen-advanced">';
                                $html .='<span data-href="#gen-advanced">';
                                    $html .='<span class="pro-tag">pro</span>';
                                    $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/advance-control-regular.png'.'" alt="icon" class="regular" />';
                                    $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/advance-control-hover.png'.'" alt="icon" class="hover" />';
                                $html .=''.__('Advanced Controls ','wpvr').'</span>';
                            $html .='</li>';

                            $html .='<li class="gen-control">';
                                $html .='<span data-href="#gen-control">';
                                    $html .='<span class="pro-tag">pro</span>';
                                    $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/control-buttons-regular.png'.'" alt="icon" class="regular" />';
                                    $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/control-buttons-hover.png'.'" alt="icon" class="hover" />';
                                $html .=''.__('Control Buttons ','wpvr').'</span>';
                            $html .='</li>';

                            $html .='<li class="vr-documentation">';
                                $html .='<a href="https://rextheme.com/docs-category/wp-vr/" target="_blank">'.__('Documentation ','wpvr').'</a>';
                            $html .='</li>';

                        $html .= '</ul>';
                        //=end inner nav=

                        $html .= '<div class="inner-nav-content">';
                            $html .= '<div class="basic-settings-content inner-single-content active" id="gen-basic">';
                                $html .= '<div class="content-wrapper">';
                                    $html .= '<div class="left">';
                                        //===preview image===//
                                        if (!empty($preview)) {
                                            $html .= '<div class="single-settings preview-setting">';
                                                $html .= '<span>'.__('Set a Tour Preview Image : ','wpvr').'</span>';
                                                $html .= '<div class="form-group">';
                                                    $html .= '<input type="text" name="preview-attachment-url" class="preview-attachment-url" value="'.$preview.'">';
                                                    $html .= '<input type="button" class="preview-upload" id="vr-preview-img" data-info="" value="Upload"/>';
                                                    $html .= '<div class="img-upload-frame img-uploaded" style="background-image: url('.$preview.')">';
                                                        $html .= '<label for="vr-preview-img">';
                                                            $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/uplad-icon.png'.'" alt="preview img" />';
                                                            $html .= '<span>'.__('Click to Upload an Image ','wpvr').'</span>';
                                                        $html .= '</label>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                $html .= '<span class="hints">'.__('This option will not work if the "Tour Autoload" is turned on.','wpvr').'</span>';
                                            $html .= '</div>';
                                        }
                                        else {
                                            $html .= '<div class="single-settings preview-setting">';
                                                $html .= '<span>'.__('Set a Tour Preview Image : ','wpvr').'</span>';
                                                $html .= '<div class="form-group">';
                                                    $html .= '<input type="text" name="preview-attachment-url" class="preview-attachment-url" value="">';
                                                    $html .= '<input type="button" class="preview-upload" id="vr-preview-img" data-info="" value="Upload"/>';
                                                    $html .= '<div class="img-upload-frame">';
                                                        $html .= '<label for="vr-preview-img">';
                                                            $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/uplad-icon.png'.'" alt="icon" />';
                                                            $html .= '<span>'.__('Click to Upload an Image ','wpvr').'</span>';
                                                        $html .= '</label>';
                                                    $html .= '</div>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        }
                                        //===preview image end===//

                                        //=Autoload setup=//
                                        if ($autoload == true) {
                                            $html .= '<div class="single-settings autoload">';
                                                $html .= '<span>'.__('Tour Autoload: ','wpvr').'</span>';

                                                $html .= '<span class="wpvr-switcher">';
                                                    $html .= '<input id="wpvr_autoload" class="vr-switcher-check" name="autoload" type="checkbox" value="on" checked />';
                                                    $html .= '<label for="wpvr_autoload"></label>';
                                                $html .= '</span>';

                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('Tour Preview Image will not appear if this is turned on.','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        }
                                        else {
                                            $html .= '<div class="single-settings autoload">';
                                                $html .= '<span>'.__('Tour Autoload: ','wpvr').' </span>';

                                                $html .= '<span class="wpvr-switcher">';
                                                    $html .= '<input id="wpvr_autoload" class="vr-switcher-check" name="autoload" type="checkbox" value="off" />';
                                                    $html .= '<label for="wpvr_autoload"></label>';
                                                $html .= '</span>';

                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('Tour Preview Image will not appear if this is turned on.','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        }
                                        //=Autoload setup End=//

                                        //=Control Setup=
                                        if ($control == false) {
                                            $html .= '<div class="single-settings controls">';
                                                $html .= '<span>'.__('Basic Control Buttons: ','wpvr').'</span>';

                                                $html .= '<span class="wpvr-switcher">';
                                                    $html .= '<input id="wpvr_controls" class="vr-switcher-check" value="off" name="controls" type="checkbox" />';
                                                    $html .= '<label for="wpvr_controls"></label>';
                                                $html .= '</span>';
                                                
                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('This option will display Zoom In, Zoom Out and Full Screen buttons on the tour.','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        }
                                        else {
                                            $html .= '<div class="single-settings controls">';
                                                $html .= '<span>'.__('Basic Control Buttons: ','wpvr').'</span>';

                                                $html .= '<span class="wpvr-switcher">';
                                                    $html .= '<input id="wpvr_controls" class="vr-switcher-check" value="on" name="controls" type="checkbox" checked />';
                                                    $html .= '<label for="wpvr_controls"></label>';
                                                $html .= '</span>';

                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('This option will display Zoom In, Zoom Out and Full Screen buttons on the tour.','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        }
                                        //=Control setup End=//

                                    $html .= '</div>';
                                    //===end left===//

                                    $html .= '<div class="right">';
                                        //=scene fade duration=//
                                        $html .= '<div class="single-settings scene-fade-duration">';
                                            $html .= '<span>'.__('Scene Fade Duration: ','wpvr').'</span>';
                                            $html .= '<input type="number" name="scene-fade-duration" value="'.$scene_fade_duration.'" />';

                                            $html .= '<div class="field-tooltip">';
                                                $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                $html .= '<span>'.__('This will set the scene fade effect and execution time.','wpvr').'</span>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //=scene fade duration End=//

                                        //===Autorotation on off set==//
                                        if (isset($postdata["autoRotate"])) {
                                            $html .= '<div class="single-settings autoload">';
                                                $html .= '<span>'.__('Auto Rotation: ','wpvr').' </span>';

                                                $html .= '<span class="wpvr-switcher">';
                                                    $html .= '<input id="wpvr_autorotation" class="vr-switcher-check" value="on" name="autorotation" type="checkbox" checked />';
                                                    $html .= '<label for="wpvr_autorotation"></label>';
                                                $html .= '</span>';
                                            $html .= '</div>';
                                        }
                                        else {
                                            $html .= '<div class="single-settings autoload">';
                                                $html .= '<span>'.__('Auto Rotation: ','wpvr').' </span>';

                                                $html .= '<span class="wpvr-switcher">';
                                                    $html .= '<input id="wpvr_autorotation" class="vr-switcher-check" value="off" name="autorotation" type="checkbox" />';
                                                    $html .= '<label for="wpvr_autorotation"></label>';
                                                $html .= '</span>';
                                            $html .= '</div>';
                                        }
                                        //===end Autorotation on off set==//

                                        //=Auto Rotation=//
                                        $html .= '<div class="autorotationdata-wrapper">';
                                            $html .= '<div class="single-settings autorotationdata" >';
                                                $html .= '<span>'.__('Rotation Speed and Direction: ','wpvr').'</span>';
                                                $html .= '<input type="number" name="auto-rotation" value="'.$autorotation.'" placeholder="-5" />';

                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('Set a value to determine the speed of rotation. The higher the number, the faster it will rotate. Positive values will make it rotate clockwise and negative values will make it rotate anti clockwise','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                            //=Auto Rotation=//

                                            //=Auto rotation inactive delay=//
                                            $html .= '<div class="single-settings autorotationdata" >';
                                                $html .= '<span>'.__('Resume Auto-rotation after: ','wpvr').'</span>';
                                                $html .= '<input type="number" name="auto-rotation-inactive-delay" value="'.$autorotationinactivedelay.'" placeholder="2000" />';
                                                
                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('When someone clicks on the tour, auto-rotation stops. Here, set a time after which auto rotation will start again. Assign in milliseconds, where 1000 milliseconds = 1 second.','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                            //=Auto rotation inactive delay=//

                                            //=Auto rotation stop delay=//
                                            $html .= '<div class="single-settings autorotationdata" >';
                                                $html .= '<span>'.__('Stop Auto-rotation after: ','wpvr').'</span>';
                                                $html .= '<input type="number" name="auto-rotation-stop-delay" value="'.$autorotationstopdelay.'" placeholder="2000" />';
                                                
                                                $html .= '<div class="field-tooltip">';
                                                    $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                    $html .= '<span>'.__('Set a time after which auto rotation will stop. Assign in milliseconds, where 1000 milliseconds = 1 second.','wpvr').'</span>';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //=Auto rotation stop delay=//

                                    $html .= '</div>';
                                    //===end right===//

                                $html .= '</div>';
                            $html .= '</div>';
                            //===end basic settings===//

                            $html .= '<div class="advanced-settings-content inner-single-content" id="gen-advanced">';
                                $html .= '<div class="content-wrapper">';
                                    $html .= '<div class="left">';
                                        
                                        //=Keyboard Movement Control=//
                                        $html .= '<div class="single-settings compass">';
                                            $html .= '<span>'.__('Keyboard Movement Control: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_diskeyboard" class="vr-switcher-check" value="off" name="diskeyboard" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_diskeyboard" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=Keyboard Movement Control end=//

                                        //=Keyboard Zoom Control Setup=//
                                        $html .= '<div class="single-settings">';
                                            $html .= '<span>'.__('Keyboard Zoom Control: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_keyboardzoom" class="vr-switcher-check" value="off" name="keyboardzoom" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_keyboardzoom" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=Keyboard Zoom Control End=//

                                        //=Mouse Drag Control=//
                                        $html .= '<div class="single-settings">';
                                            $html .= '<span>'.__('Mouse Drag Control: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_draggable" class="vr-switcher-check" name="draggable" type="checkbox" value="off" disabled />';
                                                $html .= '<label for="wpvr_draggable" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=Mouse Drag Control End=//

                                        //=Mouse Zoom Control=//
                                        $html .= '<div class="single-settings">';
                                            $html .= '<span>'.__('Mouse Zoom Control: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_mouseZoom" class="vr-switcher-check" value="off" name="mouseZoom" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_mouseZoom" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=Mouse Zoom Control End=//

                                        //=Gyroscope Control=//
                                        $html .= '<div class="single-settings gyro">';
                                            $html .= '<span>'.__('Gyroscope Control: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_gyro" class="vr-switcher-check" value="off" name="gyro" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_gyro" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=Gyroscope Control End=//

                                        //=Auto Gyroscope Support=//
                                        $html .= '<div class="single-settings orientation">';
                                            $html .= '<span>'.__('Auto Gyroscope Support: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_deviceorientationcontrol" class="vr-switcher-check" value="off" name="deviceorientationcontrol" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_deviceorientationcontrol" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                            $html .= '<div class="field-tooltip">';
                                                $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                $html .= '<span>'.__('If set to true, device orientation control will be used when the panorama is loaded, if the device supports it. If false, device orientation control needs to be activated by pressing a button. Defaults to false. Will work if gyroscope is enabled','wpvr').'</span>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //=Auto Gyroscope Support End=//

                                        //=Compass Setup=//
                                        $html .= '<div class="single-settings compass">';
                                            $html .= '<span>'.__('Compass: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_compass" class="vr-switcher-check" value="off" name="compass" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_compass" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=Compass setup End=//

                                    $html .= '</div>';
                                    //===end left===//

                                    $html .= '<div class="right">';
                                        //= Scene Gallery=//
                                        $html .= '<div class="single-settings gallery">';
                                            $html .= '<span>'.__('Scene Gallery: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_vrgallery" class="vr-switcher-check" value="off" name="vrgallery" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_vrgallery" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                            $html .= '<div class="field-tooltip">';
                                                $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                $html .= '<span>'.__('Turning it On will display a gallery with all the scenes on your tour. By double clicking on a scene thumbnail on the gallery, you can move to that specific scene. The gallery will only show up on the front end and not on the preview.','wpvr').'</span>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //= Scene Gallery end=//

                                        //=Scene Titles on Gallery=//
                                        $html .= '<div class="single-settings">';
                                            $html .= '<span>'.__('Scene Titles on Gallery: ','wpvr').'</span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_vrgallery_title" class="vr-switcher-check" value="off" name="vrgallery_title" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_vrgallery_title" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                            $html .= '<div class="field-tooltip">';
                                                $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/question.png'.'" alt="icon" />';
                                                $html .= '<span>'.__('Turning it on will display scene titles on each scene thumbnail inside the Scene Gallery. The Scene IDs will be used as the Scene Title.','wpvr').'</span>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //=Scene Titles on Gallery End=//

                                        //===VR Audio setup===//
                                        $html .= '<div class="single-settings">';
                                            $html .= '<span>Tour Background Music: </span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_bg_music" class="vr-switcher-check" value="off" name="bg_music" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_bg_music" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //==VR audio End==//

                                        //===Company logo===//
                                        $html .= '<div class="single-settings company-info">';
                                            $html .= '<span>'.__('Add Company Information: ','wpvr').' </span>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_cpLogoSwitch" class="vr-switcher-check" value="off" name="cpLogoSwitch" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_cpLogoSwitch" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //===Company logo end===//
                                       
                                    $html .= '</div>';
                                    //===end right===//

                                $html .= '</div>';
                            $html .= '</div>';
                            //===end advanced settings===//

                            $html .= '<div class="control-settings-content inner-single-content" id="gen-control">';
                                $html .= '<div class="content-wrapper">';
                                    $html .= '<div class="left">';
                                        //=====Move up====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Move Up: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/move-up.jpg'.'" alt="icon" />';
                                            $html .= '</div>';
                                            
                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panupControl" class="vr-switcher-check" value="off" name="panupControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panupControl" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                        $html .= '</div>';
                                        //=====Moveup End====//

                                        //=====Move Down====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Move Down: ','wpvr').'</span>';
                                                
                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/move-down.jpg'.'" alt="icon" />';
                                            $html .= '</div>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panDownControl" class="vr-switcher-check" value="off" name="panDownControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panDownControl" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=====Move down End====//

                                        //=====Move Left====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Move Left: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/move-left.jpg'.'" alt="icon" />';
                                            $html .= '</div>';
                                            
                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panLeftControl" class="vr-switcher-check" value="off" name="panLeftControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panLeftControl" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=====Move Left End====//

                                        //=====Move Right====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Move Right: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/move-right.jpg'.'" alt="icon" />';
                                            $html .= '</div>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panRightControl" class="vr-switcher-check" value="off" name="panRightControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panRightControl" title="Pro Feature"></label>';
                                            $html .= '</span>';
                                        $html .= '</div>';
                                        //=====Move Right End====//

                                        //=====Zoom In====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Zoom In: ','wpvr').'</span>';
                                            
                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/zoom-in.jpg'.'" alt="icon" />';
                                            $html .= '</div>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panZoomInControl" class="vr-switcher-check" value="off" name="panZoomInControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panZoomInControl" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                        $html .= '</div>';
                                        //=====Zoom In End====//

                                    $html .= '</div>';
                                    //===end left===//

                                    $html .= '<div class="right">';
                                        //=====Zoom Out====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Zoom Out: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/zoom-out.jpg'.'" alt="icon" />';
                                            $html .= '</div>';

                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panZoomOutControl" class="vr-switcher-check" value="off" name="panZoomOutControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panZoomOutControl" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                        $html .= '</div>';
                                        //=====Zoom Out End====//
                                        
                                        //===== Full Screen====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Full Screen: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/full-screen.jpg'.'" alt="icon" />';
                                            $html .= '</div>';
                                            
                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_panFullscreenControl" class="vr-switcher-check" value="off" name="panFullscreenControl" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_panFullscreenControl" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                        $html .= '</div>';
                                        //=====Full Screen End====//

                                        //=====Gyroscope====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Gyroscope: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/gryscop.jpg'.'" alt="icon" />';
                                            $html .= '</div>';
                                            
                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_gyroscope" class="vr-switcher-check" value="off" name="gyroscope" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_gyroscope" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                        $html .= '</div>';
                                        //=====Gyroscope End====//

                                        //=====Back to home====//
                                        $html .= '<div class="single-settings controls custom-data-set">';
                                            $html .= '<span>'.__('Home: ','wpvr').'</span>';

                                            $html .= '<div class="color-icon">';
                                                $html .='<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/home.jpg'.'" alt="icon" />';
                                            $html .= '</div>';
                                            
                                            $html .= '<span class="wpvr-switcher">';
                                                $html .= '<input id="wpvr_backToHome" class="vr-switcher-check" value="off" name="backToHome" type="checkbox" disabled />';
                                                $html .= '<label for="wpvr_backToHome" title="Pro Feature"></label>';
                                            $html .= '</span>';

                                        $html .= '</div>';
                                        //=====Back to home End====//
                                    $html .= '</div>';
                                    //===end right===//

                                $html .= '</div>';
                            $html .= '</div>';
                            //===end control settings===//

                        $html .= '</div>';
                        //=end inner tab content=

                        $html .= '<div class="wpvr-use-shortcode">';
                            $post = get_post();
                            $id = $post->ID;
                            $slug = $post->post_name;
                            $postdata = get_post_meta( $post->ID, 'panodata', true );

                            $html .= '<h4 class="area-title">'.__('Using this Tour', 'wpvr').'</h4>';

                            $html .= '<div class="shortcode-wrapper">';
                                $html .= '<div class="single-shortcode classic">';
                                    $html .= '<span class="shortcode-title">'.__('For Classic Editor:', 'wpvr').'</span>';

                                    $html .= '<div class="field-wapper">';
                                        $html .= '<span>'.__('To use this WP VR tour in your posts or pages use the following shortcode ','wpvr').'</span>';

                                        $html .= '<div class="shortcode-field">';
                                            $html .= '<p class="copycode" id="copy-shortcode">[wpvr id="'.$id.'"]</p>';

                                            $html .= '<span id="wpvr-copy-shortcode" class="wpvr-copy-shortcode">';
                                                $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/copy.png'.'" alt="icon" />';
                                            $html .= '</span>';
                                        $html .= '</div>';


                                        $html .= '<span id="wpvr-copied-notice" class="wpvr-copied-notice"></span>';

                                    $html .= '</div>';
                                $html .= '</div>';

                                $html .= '<div class="single-shortcode gutenberg">';
                                    $html .= '<span class="shortcode-title">'.__('For Gutenberg:', 'wpvr').'</span>';

                                    $html .= '<div class="field-wapper">';
                                        $html .= '<span>'.__('Select tour with this ID on WP VR block setting ','wpvr').'</span>';

                                        $html .= '<div class="shortcode-field">';
                                            $html .= '<p class="copycode">'.$id.'</p>';
                                        $html .= '</div>';
                                    $html .= '</div>';
                                $html .= '</div>';
                            $html .= '</div>';
                        $html .= '</div>';
                        //=end shortcode area=

                    $html .= '</div>';
                    //=end inner tab=


                    $html .= '<script>';
                    $html .= '

                    document.getElementById("wpvr-copy-shortcode").addEventListener("click", function() {
                        copyToClipboard(document.getElementById("copy-shortcode"));
                    });

                    function copyToClipboard(elem) {
                        // create hidden text element, if it doesn\'t already exist
                        var targetId = "_hiddenCopyText_";
                        var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                        var origSelectionStart, origSelectionEnd;
                        if (isInput) {
                            // can just use the original source element for the selection and copy
                            target = elem;
                            origSelectionStart = elem.selectionStart;
                            origSelectionEnd = elem.selectionEnd;
                        } else {
                            // must use a temporary form element for the selection and copy
                            target = document.getElementById(targetId);
                            if (!target) {
                                var target = document.createElement("textarea");
                                target.style.position = "absolute";
                                target.style.left = "-9999px";
                                target.style.top = "0";
                                target.id = targetId;
                                document.body.appendChild(target);
                            }
                            target.textContent = elem.textContent;
                        }
                        // select the content
                        var currentFocus = document.activeElement;
                        target.focus();
                        target.setSelectionRange(0, target.value.length);

                        // copy the selection
                        var succeed;
                        try {
                            succeed = document.execCommand("copy");
                            document.getElementById("wpvr-copied-notice").innerHTML = "Copied!";
                        } catch(e) {
                            succeed = false;
                        }
                        // restore original focus
                        if (currentFocus && typeof currentFocus.focus === "function") {
                            currentFocus.focus();
                        }

                        setTimeout(function(){
                            document.getElementById("wpvr-copied-notice").innerHTML = "";
                        }, 2000 );

                        if (isInput) {
                            // restore prior selection
                            elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                        } else {
                            // clear temporary content
                            target.textContent = "";
                        }
                        document.getElementById("wpvr-copy-shortcode").scrollIntoView()
                        return succeed;
                    }

                    ';

                    $html .= '</script>';

                $html .='</div>';
                //---end general tab----

                $html .='<div class="rex-pano-tab" id="scenes">';

                    //=Scene and Hotspot repeater=//
                    if (empty($pano_data)) {
                        $html .= '<div class="scene-setup rex-pano-sub-tabs" data-limit="'.$scene_limit.'">';

                            $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu scene-nav">';
                                $html .= '<ul>';
                                    $html .= '<li class="active"><span data-index="1" data-href="#scene-1"><i class="fa fa-image"></i></span></li>';
                                    $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
                                $html .= '</ul>';
                            $html .= '</nav>';

                            $html .= '<div data-repeater-list="scene-list" class="rex-pano-tab-content">';

                            	$html .= '<div data-repeater-item class="single-scene rex-pano-tab" data-title="0" id="scene-0">';

                                    $html .= '<div class="scene-content">';
                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                        $html .= '<div class="scene-left">';
                                            //==Set Default Scene==//
                                            $html .= '<div class="single-settings dscene">';
                                                $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                $html .= '<select class="dscen" name="dscene">';
                                                    $html .= '<option value="on"> Yes</option>';
                                                    $html .= '<option value="off" selected > No</option>';
                                                $html .= '</select>';
                                            $html .= '</div>';
                                            //==Set Default Scene end==//
                                            
                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                                $html .= '<input class="sceneid" type="text" name="scene-id"/>';
                                            $html .= '</div>';

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                                $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                            $html .= '</div>';

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                                $html .= '<div class="form-group">';
                                                    $html .= '<img src="" style="display: none;"><br>';
                                                    $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                    $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="">';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //---end scene-left---

                                    $html .= '</div>';

                                    //--hotspot setup--
                                    $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
                                            $html .= '<ul>';
                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-0-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
                                            $html .= '</ul>';
                                        $html .= '</nav>';

                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-0-hotspot-1">';

                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

                                                $html .= '<div class="wrapper">';
                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
                                                    $html .= '</div>';

													$html .= '<div class="hotspot-setting">';
                                                    	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
                                                    	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
                                                	$html .= '</div>';

                                                $html .= '</div>';

                                                $html .= '<div class="hotspot-type hotspot-setting">';
                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
                                                    $html .= '<select name="hotspot-type">';
                                                        $html .= '<option value="info" selected> Info</option>';
                                                        $html .= '<option value="scene"> Scene</option>';
                                                    $html .= '</select>';

                                                    $html .= '<div class="hotspot-url">';
                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-content">';
                                                        $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-content"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-hover">';
                                                        $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
                                                        	$html .= '<option value="none" selected> None</option>';
                                                    	$html .= '</select>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                //=Hotspot type End=//
                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
                                            $html .= '</div>';
                                        $html .= '</div>';

                                    $html .= '</div>';
                                    $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
                           		$html .= '</div>';


                                $html .= '<div data-repeater-item class="single-scene rex-pano-tab active" data-title="1" id="scene-1">';

                                    $html .= '<div class="scene-content">';
                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                        $html .= '<div class="scene-left">';
                                            //==Set Default Scene==//
                                            $html .= '<div class="single-settings dscene">';
                                                $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                $html .= '<select class="dscen" name="dscene">';
                                                    $html .= '<option value="on"> Yes</option>';
                                                    $html .= '<option value="off" selected > No</option>';
                                                $html .= '</select>';
                                            $html .= '</div>';
                                            //==Set Default Scene end==//

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                                $html .= '<input class="sceneid" type="text" name="scene-id"/>';
                                            $html .= '</div>';

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                                $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                            $html .= '</div>';

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                                $html .= '<div class="form-group">';
                                                    $html .= '<img src="" style="display: none;"><br>';
                                                    $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                    $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="">';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //----end scene left------

                                    $html .= '</div>';

                                    //--hotspot setup--//
                                    $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
                                            $html .= '<ul>';
                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-1-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
                                            $html .= '</ul>';
                                        $html .= '</nav>';

                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-1-hotspot-1">';

                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

                                                $html .= '<div class="wrapper">';
                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
                                                    $html .= '</div>';

													$html .= '<div class="hotspot-setting">';
                                                    	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
                                                    	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
                                                	$html .= '</div>';

                                                $html .= '</div>';

                                                $html .= '<div class="hotspot-type hotspot-setting">';
                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
                                                    $html .= '<select name="hotspot-type">';
                                                        $html .= '<option value="info" selected> Info</option>';
                                                        $html .= '<option value="scene"> Scene</option>';
                                                    $html .= '</select>';

                                                    $html .= '<div class="hotspot-url">';
                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-content">';
                                                        $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-content"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-hover">';
                                                        $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
                                                        	$html .= '<option value="none"> None</option>';
                                                    	$html .= '</select>';
                                                    $html .= '</div>';
                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                //=Hotspot type End=//
                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';
                                    $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
                                $html .= '</div>';
                            $html .= '</div>';

                        $html .= '</div>';
                    }
                    else {
                        $html .= '<div class="scene-setup rex-pano-sub-tabs" data-limit="'.$scene_limit.'">';

                            $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu scene-nav">';
                                $html .= '<ul>';
                                $i = 1;
                                $firstvalue = reset($pano_data["scene-list"]);
                                foreach ($pano_data["scene-list"] as $pano_scenes) {
                                	if ($pano_scenes['scene-id'] == $firstvalue['scene-id']) {
                                		$html .= '<li class="active"><span data-index="'.$i.'" data-href="#scene-'.$i.'"><i class="fa fa-image"></i></span></li>';
                                	}
                                	else {
                                		$html .= '<li><span data-index="'.$i.'" data-href="#scene-'.$i.'"><i class="fa fa-image"></i></span></li>';
                                	}
                                	$i++;
                                }
                                    $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
                                $html .= '</ul>';
                            $html .= '</nav>';


                            $html .= '<div data-repeater-list="scene-list" class="rex-pano-tab-content">';

                             //===Default empty repeater declared by nazmus sakib===//
                            $html .= '<div data-repeater-item class="single-scene rex-pano-tab" data-title="0" id="scene-0">';

                                    $html .= '<div class="scene-content">';
                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                        $html .= '<div class="scene-left">';
                                            //==Set Default Scene==//
                                            $html .= '<div class="single-settings dscene">';
                                                $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                $html .= '<select class="dscen" name="dscene">';
                                                    $html .= '<option value="on"> Yes</option>';
                                                    $html .= '<option value="off" selected > No</option>';
                                                $html .= '</select>';
                                            $html .= '</div>';
                                            //==Set Default Scene end==//
                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                                $html .= '<input class="sceneid" type="text" name="scene-id"/>';
                                            $html .= '</div>';

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                                $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                            $html .= '</div>';

                                            $html .= '<div class=scene-setting>';
                                                $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                                $html .= '<div class="form-group">';
                                                    $html .= '<img src="" style="display: none;"><br>';
                                                    $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                    $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="">';
                                                $html .= '</div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                        //-----end scene left------

                                    $html .= '</div>';

                                    //--hotspot setup--//
                                    $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
                                            $html .= '<ul>';
                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-0-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
                                            $html .= '</ul>';
                                        $html .= '</nav>';

                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-0-hotspot-1">';

                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

                                                $html .= '<div class="wrapper">';
                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-setting">';
                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
                                                    $html .= '</div>';

													$html .= '<div class="hotspot-setting">';
                                                    	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
                                                    	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
                                                	$html .= '</div>';

                                                $html .= '</div>';

                                                $html .= '<div class="hotspot-type hotspot-setting">';
                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
                                                    $html .= '<select name="hotspot-type">';
                                                        $html .= '<option value="info" selected> Info</option>';
                                                        $html .= '<option value="scene"> Scene</option>';
                                                    $html .= '</select>';

                                                    $html .= '<div class="hotspot-url">';
                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-content">';
                                                        $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-content"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-hover">';
                                                        $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
                                                        	$html .= '<option value="none" selected> None</option>';
                                                    	$html .= '</select>';
                                                    $html .= '</div>';

                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
                                                    $html .= '</div>';

                                                $html .= '</div>';
                                                //=Hotspot type End=//
                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
                                            $html .= '</div>';
                                        $html .= '</div>';

                                    $html .= '</div>';
                                    $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
                            $html .= '</div>';
                            //==Empty repeater end==//

                            	$s = 1;
                                foreach ($pano_data["scene-list"] as $pano_scenes) {
                                	$dscene = '';
                                	if (isset($pano_scenes['dscene'])) {
                                		$dscene = $pano_scenes['dscene'];
                                	}
                                    $scene_id = '';
                                    $scene_id = $pano_scenes["scene-id"];
                                    $scene_type = 'equirectangular';
                                    $scene_type = $pano_scenes["scene-type"];
                                    $scene_photo = '';
                                    $scene_photo = $pano_scenes["scene-attachment-url"];

                                    $pano_hotspots = array();
                                    if (isset($pano_scenes["hotspot-list"])) {
                                    	$pano_hotspots = $pano_scenes["hotspot-list"];
                                    }

                                    $firstvalueset = reset($pano_data["scene-list"]);
                                    if ($pano_scenes['scene-id'] == $firstvalueset['scene-id']) {
	                                    $html .= '<div data-repeater-item  class="single-scene rex-pano-tab active" data-title="1" id="scene-'.$s.'">';

	                                        $html .= '<div class="scene-content">';
                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';
                                                
                                                $html .= '<div class="scene-left">';
                                                    //==Set Default Scene==//
                                                    if ($dscene == 'on') {
                                                        $html .= '<div class="single-settings dscene">';
                                                            $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                            $html .= '<select class="dscen" name="dscene">';
                                                                $html .= '<option value="on" selected > Yes</option>';
                                                                $html .= '<option value="off"> No</option>';
                                                            $html .= '</select>';
                                                        $html .= '</div>';

                                                    }
                                                    else {
                                                        $html .= '<div class="single-settings dscene">';
                                                            $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                            $html .= '<select class="dscen" name="dscene">';
                                                                $html .= '<option value="on"> Yes</option>';
                                                                $html .= '<option value="off" selected > No</option>';
                                                            $html .= '</select>';
                                                        $html .= '</div>';
                                                    }
                                                    //==Set Default Scene end==//
                                                    $html .= '<div class=scene-setting>';
                                                        $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                                        $html .= '<input class="sceneid" type="text" name="scene-id" value="'.$scene_id.'" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class=scene-setting>';
                                                        $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                                        $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class=scene-setting>';
                                                        $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                                        $html .= '<div class="form-group">';
                                                            $html .= '<img name ="scene-photo" src="'.$scene_photo.'"> <br/>';
                                                            $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                            $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="'.$scene_photo.'">';
                                                        $html .= '</div>';
                                                    $html .= '</div>';
                                                $html .= '</div>';
                                                // ---end scene left---
                                                
	                                        $html .= '</div>';

	                                        if (!empty($pano_hotspots)) {
	                                            $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

	                                                $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
	                                                    $html .= '<ul>';
	                                                    $j = 1;
	                                                    $firstvaluehotspot = reset($pano_hotspots);
	                                                    foreach ($pano_hotspots as $pano_hotspot) {

	                                                    	if ($pano_hotspot['hotspot-title'] == $firstvaluehotspot['hotspot-title']) {
	                                                        	$html .= '<li class="active"><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    	else {
	                                                        $html .= '<li><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    $j++;
	                                                    }
	                                                        $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
	                                                    $html .= '</ul>';
	                                                $html .= '</nav>';

	                                                $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';

	                                            	$h = 1;
	                                            	$firstvaluehotspotset = reset($pano_hotspots);
                                                    $is_wpvr_premium = apply_filters('is_wpvr_premium', false);
	                                                foreach ($pano_hotspots as $pano_hotspot) {
	                                                    $hotspot_title = '';
	                                                    $hotspot_title = $pano_hotspot['hotspot-title'];
	                                                    $hotspot_pitch = '';
	                                                    $hotspot_pitch = $pano_hotspot['hotspot-pitch'];
	                                                    $hotspot_yaw = '';
	                                                    $hotspot_yaw = $pano_hotspot['hotspot-yaw'];
	                                                    $hotspot_type = '';
	                                                    $hotspot_type = $pano_hotspot['hotspot-type'];
	                                                    $hotspot_url = '';
	                                                    $hotspot_url = $pano_hotspot['hotspot-url'];
	                                                    $hotspot_content = '';
	                                                    $hotspot_content = $pano_hotspot['hotspot-content'];
	                                                    $hotspot_hover = '';
	                                                    $hotspot_hover = $pano_hotspot['hotspot-hover'];
	                                                    $hotspot_target_scene = '';
	                                                    $hotspot_target_scene = $pano_hotspot['hotspot-scene'];
	                                                    $hotspot_custom_class = '';
	                                                    if (isset($pano_hotspot['hotspot-customclass'])) {
	                                                    	$hotspot_custom_class = $pano_hotspot['hotspot-customclass'];
	                                                    }

	                                                    if ($pano_hotspot['hotspot-title'] == $firstvaluehotspotset['hotspot-title']) {
		                                                    $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'
		                                                                </label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene"> '.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                    else {
	                                                    	$html .= '<div data-repeater-item class="single-hotspot rex-pano-tab clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
                                                                            $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                $h++;
	                                                }
	                                                $html .= '</div>';
	                                            $html .= '</div>';
	                                        }
	                                        else {
	                                        	$html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

			                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
			                                            $html .= '<ul>';
			                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-'.$s.'-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
			                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
			                                            $html .= '</ul>';
			                                        $html .= '</nav>';

			                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
			                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-1">';

			                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

			                                                $html .= '<div class="wrapper">';
			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
			                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
			                                                    $html .= '</div>';

																$html .= '<div class="hotspot-setting">';
		                                                        	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon class: ','wpvr').'</label>';
		                                                        	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
		                                                    	$html .= '</div>';

			                                                $html .= '</div>';

			                                                $html .= '<div class="hotspot-type hotspot-setting">';
			                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
			                                                    $html .= '<select name="hotspot-type">';
			                                                        $html .= '<option value="info" selected> Info</option>';
			                                                        $html .= '<option value="scene"> Scene</option>';
			                                                    $html .= '</select>';

			                                                    $html .= '<div class="hotspot-url">';
			                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
			                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-content">';
			                                                        $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-content"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-hover">';
			                                                        $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
			                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
			                                                        	$html .= '<option value="none"> None</option>';
			                                                    	$html .= '</select>';
			                                                    $html .= '</div>';
			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
			                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
			                                                    $html .= '</div>';

			                                                $html .= '</div>';
			                                                //=Hotspot type End=//
			                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
			                                            $html .= '</div>';
			                                        $html .= '</div>';
			                                    $html .= '</div>';
	                                        }
	                                        $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
	                                    $html .= '</div>';
                                    }
                                    else {
                                    	$html .= '<div data-repeater-item  class="single-scene rex-pano-tab" data-title="1" id="scene-'.$s.'">';

	                                        $html .= '<div class="scene-content">';
	                                            $html .= '<h6 class="title"><i class="fa fa-cog"></i> Scene Setting </h6>';

                                                $html .= '<div class="scene-left">';
                                                    //==Set Default Scene==//
                                                    if ($dscene == 'on') {
                                                        $html .= '<div class="single-settings dscene">';
                                                            $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                            $html .= '<select class="dscen" name="dscene">';
                                                                $html .= '<option value="on" selected > Yes</option>';
                                                                $html .= '<option value="off"> No</option>';
                                                            $html .= '</select>';
                                                        $html .= '</div>';

                                                    }
                                                    else {
                                                        $html .= '<div class="single-settings dscene">';
                                                            $html .= '<span>'.__('Set as Default: ','wpvr').'</span>';
                                                            $html .= '<select class="dscen" name="dscene">';
                                                                $html .= '<option value="on"> Yes</option>';
                                                                $html .= '<option value="off" selected> No</option>';
                                                            $html .= '</select>';
                                                        $html .= '</div>';
                                                    }
                                                    //==Set Default Scene end==//

                                                    $html .= '<div class=scene-setting>';
                                                        $html .= '<label for="scene-id">'.__('Scene ID : ','wpvr').'</label>';
                                                        $html .= '<input class="sceneid" type="text" name="scene-id" value="'.$scene_id.'" />';
                                                    $html .= '</div>';

                                                    $html .= '<div class=scene-setting>';
                                                        $html .= '<label for="scene-type">'.__('Scene Type : ','wpvr').'</label>';
                                                        $html .= '<input type="text" name="scene-type" value="equirectangular" disabled/>';
                                                    $html .= '</div>';

                                                    $html .= '<div class=scene-setting>';
                                                        $html .= '<label for="scene-upload">'.__('Scene Upload: ','wpvr').'</label>';
                                                        $html .= '<div class="form-group">';
                                                            $html .= '<img name ="scene-photo" src="'.$scene_photo.'"> <br/>';
                                                            $html .= '<input type="button" class="scene-upload" data-info="" value="Upload"/>';
                                                            $html .= '<input type="hidden" name="scene-attachment-url" class="scene-attachment-url" value="'.$scene_photo.'">';
                                                        $html .= '</div>';
                                                    $html .= '</div>';
                                                $html .= '</div>';
                                                //--end scene left----
                                                
	                                        $html .= '</div>';

	                                        if (!empty($pano_hotspots)) {
	                                            $html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

	                                                $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
	                                                    $html .= '<ul>';
	                                                    $j = 1;
	                                                    foreach ($pano_hotspots as $pano_hotspot) {
	                                                    	if ($pano_hotspot['hotspot-title'] == $pano_hotspots[0]['hotspot-title']) {
	                                                        	$html .= '<li class="active"><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    	else {
	                                                        $html .= '<li><span data-index="'.$j.'" data-href="#scene-'.$s.'-hotspot-'.$j.'"><i class="far fa-dot-circle"></i></span></li>';
	                                                    	}
	                                                    $j++;
	                                                    }
	                                                        $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i></span></li>';
	                                                    $html .= '</ul>';
	                                                $html .= '</nav>';

	                                                $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';

	                                            	$h = 1;
	                                                foreach ($pano_hotspots as $pano_hotspot) {
	                                                    $hotspot_title = '';
	                                                    $hotspot_title = $pano_hotspot['hotspot-title'];
	                                                    $hotspot_pitch = '';
	                                                    $hotspot_pitch = $pano_hotspot['hotspot-pitch'];
	                                                    $hotspot_yaw = '';
	                                                    $hotspot_yaw = $pano_hotspot['hotspot-yaw'];
	                                                    $hotspot_type = '';
	                                                    $hotspot_type = $pano_hotspot['hotspot-type'];
	                                                    $hotspot_url = '';
	                                                    $hotspot_url = $pano_hotspot['hotspot-url'];
	                                                    $hotspot_content = '';
	                                                    $hotspot_content = $pano_hotspot['hotspot-content'];
	                                                    $hotspot_hover = '';
	                                                    $hotspot_hover = $pano_hotspot['hotspot-hover'];
	                                                    $hotspot_target_scene = '';
	                                                    $hotspot_target_scene = $pano_hotspot['hotspot-scene'];
	                                                    $hotspot_custom_class = '';
	                                                    if (isset($pano_hotspot['hotspot-customclass'])) {
	                                                    	$hotspot_custom_class = $pano_hotspot['hotspot-customclass'];
	                                                    }

	                                                    if ($pano_hotspot['hotspot-title'] == $pano_hotspots[0]['hotspot-title']) {
		                                                    $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene"/>';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                    else {
	                                                    	$html .= '<div data-repeater-item class="single-hotspot rex-pano-tab clearfix" id="scene-'.$s.'-hotspot-'.$h.'">';

		                                                        $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting</h6>';

		                                                        $html .= '<div class="wrapper">';
		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
		                                                                $html .= '<input type="text" id="hotspot-title" name="hotspot-title" value="'.$hotspot_title.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch" value="'.$hotspot_pitch.'" />';
		                                                            $html .= '</div>';

		                                                            $html .= '<div class="hotspot-setting">';
		                                                                $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
		                                                                $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw" value="'.$hotspot_yaw.'" />';
		                                                            $html .= '</div>';

																	$html .= '<div class="hotspot-setting">';
	                                                                	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom icon Class: ','wpvr').'</label>';
	                                                                	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass" value="'.$hotspot_custom_class.'"/>';
	                                                            	$html .= '</div>';

		                                                        $html .= '</div>';

		                                                        //=Hotspot type=//
		                                                        if ($hotspot_type == "info") {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select name="hotspot-type">';
		                                                                    $html .= '<option value="info" selected> Info</option>';
		                                                                    $html .= '<option value="scene"> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url">';
		                                                                    $html .= '<label for="hotspot-url">'.__(' URL: ','wpvr').'</label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" value="'.$hotspot_url.'" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content">'.$hotspot_content.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" style="display:none;" >';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        else {

		                                                            $html .= '<div class="hotspot-type hotspot-setting">';
		                                                                $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
		                                                                $html .= '<select class="trtr" name="hotspot-type">';
		                                                                    $html .= '<option value="info"> Info</option>';
		                                                                    $html .= '<option value="scene" selected> Scene</option>';
		                                                                $html .= '</select>';

		                                                                $html .= '<div class="hotspot-url" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').' </label>';
		                                                                    $html .= '<input type="url" name="hotspot-url" />';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-content" style="display:none;">';
		                                                                    $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').' </label>';
		                                                                    $html .= '<textarea name="hotspot-content"></textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-hover">';
		                                                                    $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
		                                                                    $html .= '<textarea name="hotspot-hover">'.$hotspot_hover.'</textarea>';
		                                                                $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene" >';
					                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
					                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
					                                                        	$html .= '<option value="none" selected> None</option>';
					                                                    	$html .= '</select>';
					                                                    $html .= '</div>';

		                                                                $html .= '<div class="hotspot-scene">';
		                                                                    $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').' </label>';
		                                                                    $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" value="'.$hotspot_target_scene.'" disabled />';
		                                                                $html .= '</div>';

		                                                            $html .= '</div>';

		                                                        }
		                                                        //=Hotspot type End=//
		                                                        $html .= '<button data-repeater-delete type="button" title="Delete Hotspot" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
		                                                    $html .= '</div>';
	                                                    }
	                                                $h++;
	                                                }
	                                                $html .= '</div>';
	                                            $html .= '</div>';
	                                        }
	                                        else {
	                                        	$html .= '<div class="hotspot-setup rex-pano-sub-tabs" data-limit="'.$data_limit.'">';

			                                        $html .= '<nav class="rex-pano-tab-nav rex-pano-nav-menu hotspot-nav">';
			                                            $html .= '<ul>';
			                                                $html .= '<li class="active"><span data-index="1" data-href="#scene-'.$s.'-hotspot-1"><i class="far fa-dot-circle"></i></span></li>';
			                                                $html .= '<li class="add" data-repeater-create><span><i class="fa fa-plus-circle"></i> </span></li>';
			                                            $html .= '</ul>';
			                                        $html .= '</nav>';

			                                        $html .= '<div data-repeater-list="hotspot-list" class="rex-pano-tab-content">';
			                                            $html .= '<div data-repeater-item class="single-hotspot rex-pano-tab active clearfix" id="scene-'.$s.'-hotspot-1">';

			                                                $html .= '<h6 class="title"><i class="fa fa-cog"></i> Hotspot Setting </h6>';

			                                                $html .= '<div class="wrapper">';
			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-title">'.__('Hotspot ID : ','wpvr').'</label>';
			                                                        $html .= '<input type="text" id="hotspot-title" name="hotspot-title"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-pitch">'.__('Pitch: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-pitch" name="hotspot-pitch"/>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-setting">';
			                                                        $html .= '<label for="hotspot-yaw">'.__('Yaw: ','wpvr').'</label>';
			                                                        $html .= '<input type="text" class="hotspot-yaw" name="hotspot-yaw"/>';
			                                                    $html .= '</div>';

																$html .= '<div class="hotspot-setting">';
		                                                        	$html .= '<label for="hotspot-customclass">'.__('Hotspot Custom Icon Class: ','wpvr').'</label>';
		                                                        	$html .= '<input type="text" id="hotspot-customclass" name="hotspot-customclass"/>';
		                                                    	$html .= '</div>';

			                                                $html .= '</div>';

			                                                $html .= '<div class="hotspot-type hotspot-setting">';
			                                                    $html .= '<label for="hotspot-type">'.__('Hotspot-Type: ','wpvr').'</label>';
			                                                    $html .= '<select name="hotspot-type">';
			                                                        $html .= '<option value="info" selected> Info</option>';
			                                                        $html .= '<option value="scene"> Scene</option>';
			                                                    $html .= '</select>';

			                                                    $html .= '<div class="hotspot-url">';
			                                                        $html .= '<label for="hotspot-url">'.__('URL: ','wpvr').'</label>';
			                                                        $html .= '<input type="url" name="hotspot-url" value="" />';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-content">';
			                                                        $html .= '<label for="hotspot-content">'.__('On Click Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-content"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-hover">';
			                                                        $html .= '<label for="hotspot-hover">'.__('On Hover Content: ','wpvr').'</label>';
			                                                        $html .= '<textarea name="hotspot-hover"></textarea>';
			                                                    $html .= '</div>';

			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Select Target Scene from List: ','wpvr').'</label>';
			                                                        $html .= '<select class="hotspotscene" name="hotspot-scene-list">';
			                                                        	$html .= '<option value="none"> None</option>';
			                                                    	$html .= '</select>';
			                                                    $html .= '</div>';
			                                                    $html .= '<div class="hotspot-scene" style="display:none;" >';
			                                                        $html .= '<label for="hotspot-scene">'.__('Target Scene ID: ','wpvr').'</label>';
			                                                        $html .= '<input class="hotspotsceneinfodata" type="text" name="hotspot-scene" disabled/>';
			                                                    $html .= '</div>';

			                                                $html .= '</div>';
			                                                //=Hotspot type End=//
			                                                $html .= '<button data-repeater-delete title="Delete Hotspot" type="button" class="delete-hotspot"><i class="far fa-trash-alt"></i></button>';
			                                            $html .= '</div>';
			                                        $html .= '</div>';
			                                    $html .= '</div>';
	                                        }
	                                        $html .= '<button data-repeater-delete type="button" title="Delete Scene" class="delete-scene"><i class="far fa-trash-alt"></i></button>';
	                                    $html .= '</div>';
                                    }
                                	$s++;
                                }
                            $html .= '</div>';

                        $html .= '</div>';
                    }

                    $html .= '<div class="preview-btn-wrapper">';
                        $html .= '<div class="preview-btn-area clearfix">';

                             $html .= '<button id="panolenspreview">'.__('Preview','wpvr').'</button>';
                        $html .= '</div>';
			        $html .= '</div>';
                $html .='</div>';
                //---end scenes tab----
                $html .= '<div id="error_occured"></div>';

                //----start video tab content---------
                $html .='<div class="rex-pano-tab video" id="video">';
                    $html .= '<h6 class="title"> '.__('Video Settings : ','wpvr').'</h6>';
                    //==Video Setup==//
                	if (isset($postdata['vidid'])) {
                		$vidautoplay = $postdata['vidautoplay'];
                		$vidautoplay_on = '';
                		$vidautoplay_off = '';
                		if (!empty($vidautoplay)) {
                			$vidautoplay_on = 'checked';
                		}
                		else {
                			$vidautoplay_off = 'checked';
                		}

                		$vidcontrol = $postdata['vidcontrol'];
                		$vidcontrol_on = '';
                		$vidcontrol_off = '';
                		if (!empty($vidcontrol)) {
                			$vidcontrol_on = 'checked';
                		}
                		else {
                			$vidcontrol_off = 'checked';
                		}
						$html .= '<div class="single-settings videosetup">';
                            $html .= '<span>'.__('Enable Video:','wpvr').'</span>';
                            $html .= '<ul>';
                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio" type="radio" name="panovideo" value="off" >';
                                    $html .= '<label for="styled-radio">Off</label>';
                                $html .= '</li>';

                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio-0" type="radio" name="panovideo" value="on" checked>';
                                    $html .= '<label for="styled-radio-0">On</label>';
                                $html .= '</li>';
                            $html .= '</ul>';
                        $html .= '</div>';


                        $html .= '<div class="video-setting" style="display:none;">';
                            $html .= '<div class="single-settings">';
                                $html .= '<span>'.__('Upload or Add Link: ','wpvr').'</span>';
                                $html .= '<div class="form-group">';
                                    $html .= '<input type="text" name="video-attachment-url" placeholder="Paste Youtube or Vimeo link or upload" class="video-attachment-url" value="'.$postdata['vidurl'].'">';
                                    $html .= '<input type="button" class="video-upload" data-info="" value="Upload" />';
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<button id="videopreview">Preview</button>';
                        $html .= '</div>';
					}
					else {
						$html .= '<div class="single-settings videosetup">';
                            $html .= '<span>'.__('Enable Video: ','wpvr').'</span>';
                            $html .= '<ul>';
                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio" type="radio" name="panovideo" value="off" checked >';
                                    $html .= '<label for="styled-radio">Off</label>';
                                $html .= '</li>';

                                $html .= '<li class="radio-btn">';
                                    $html .= '<input class="styled-radio" id="styled-radio-0" type="radio" name="panovideo" value="on" >';
                                    $html .= '<label for="styled-radio-0">On</label>';
                                $html .= '</li>';
                            $html .= '</ul>';
                        $html .= '</div>';

                        //==Video setup end==//

                        //==Video Setting==/
                        $html .= '<div class="video-setting" style="display:none;">';
                            $html .= '<div class="single-settings">';
                                $html .= '<span>'.__('Upload or Add Link: ','wpvr').'</span>';
                                $html .= '<div class="form-group">';
                                    $html .= '<input type="text" placeholder="Paste Youtube or Vimeo link or upload" name="video-attachment-url" class="video-attachment-url" value="">';
                                    $html .= '<input type="button" class="video-upload" data-info="" value="Upload"/>';
                                $html .= '</div>';
                            $html .= '</div>';
                            $html .= '<button id="videopreview">Preview</button>';
                        $html .= '</div>';
                    }
                    
                    $html .= '<div class="wpvr-use-shortcode">';
                        $post = get_post();
                        $id = $post->ID;
                        $slug = $post->post_name;
                        $postdata = get_post_meta( $post->ID, 'panodata', true );

                        $html .= '<h4 class="area-title">'.__('Using this Tour', 'wpvr').'</h4>';

                        $html .= '<div class="shortcode-wrapper">';
                            $html .= '<div class="single-shortcode classic">';
                                $html .= '<span class="shortcode-title">'.__('For Classic Editor:', 'wpvr').'</span>';

                                $html .= '<div class="field-wapper">';
                                    $html .= '<span>'.__('To use this WP VR tour in your posts or pages use the following shortcode ','wpvr').'</span>';

                                    $html .= '<div class="shortcode-field">';
                                        $html .= '<p class="copycode" id="copy-shortcode-video">[wpvr id="'.$id.'"]</p>';
                                        $html .= '<span id="wpvr-copy-shortcode-video" class="wpvr-copy-shortcode">';
                                            $html .= '<img src="'.WPVR_PLUGIN_DIR_URL . 'admin/icon/copy.png'.'" alt="icon" />';
                                        $html .= '</span>';
                                    $html .= '</div>';

                                    $html .= '<span id="wpvr-copied-notice-video" class="wpvr-copied-notice"></span>';

                                $html .= '</div>';
                            $html .= '</div>';

                            $html .= '<div class="single-shortcode gutenberg">';
                                $html .= '<span class="shortcode-title">'.__('For Gutenberg:', 'wpvr').'</span>';

                                $html .= '<div class="field-wapper">';
                                    $html .= '<span>'.__('Select tour with this ID on WP VR block setting ','wpvr').'</span>';

                                    $html .= '<div class="shortcode-field">';
                                        $html .= '<p class="copycode">'.$id.'</p>';
                                    $html .= '</div>';
                                $html .= '</div>';
                            $html .= '</div>';
                        $html .= '</div>';

                        $html .= '<script>';
                        $html .= '
    
                        document.getElementById("wpvr-copy-shortcode-video").addEventListener("click", function() {
                            copyToClipboardVideo(document.getElementById("copy-shortcode-video"));
                        });
    
                        function copyToClipboardVideo(elem) {
                            // create hidden text element, if it doesn\'t already exist
                            var targetId = "_hiddenCopyText_";
                            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
                            var origSelectionStart, origSelectionEnd;
                            if (isInput) {
                                // can just use the original source element for the selection and copy
                                target = elem;
                                origSelectionStart = elem.selectionStart;
                                origSelectionEnd = elem.selectionEnd;
                            } else {
                                // must use a temporary form element for the selection and copy
                                target = document.getElementById(targetId);
                                if (!target) {
                                    var target = document.createElement("textarea");
                                    target.style.position = "absolute";
                                    target.style.left = "-9999px";
                                    target.style.top = "0";
                                    target.id = targetId;
                                    document.body.appendChild(target);
                                }
                                target.textContent = elem.textContent;
                            }
                            // select the content
                            var currentFocus = document.activeElement;
                            target.focus();
                            target.setSelectionRange(0, target.value.length);
    
                            // copy the selection
                            var succeed;
                            try {
                                succeed = document.execCommand("copy");
                                document.getElementById("wpvr-copied-notice-video").innerHTML = "Copied!";
                            } catch(e) {
                                succeed = false;
                            }
                            // restore original focus
                            if (currentFocus && typeof currentFocus.focus === "function") {
                                currentFocus.focus();
                            }
    
                            setTimeout(function(){
                                document.getElementById("wpvr-copied-notice-video").innerHTML = "";
                            }, 2000 );
    
                            if (isInput) {
                                // restore prior selection
                                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
                            } else {
                                // clear temporary content
                                target.textContent = "";
                            }
                            document.getElementById("wpvr-copy-shortcode-video").scrollIntoView()
                            return succeed;
                        }
    
                        ';
    
                        $html .= '</script>';
                    $html .= '</div>';
                    //=end shortcode area=
                    //==Video Setting End==//

                $html .='</div>';
                //---end video tab----
            $html .='</div>';
            //---end rex-pano-tab-content----
        $html .='</div>';
        //---end rex-pano-tabs---
	$html .= '</div>';
	$html .= '<div class="wpvr-loading" style="display:none;">Loading&#8230;</div>';
	echo $html;
	}

	/**
	 * Rollback execution
	 */
	public function trigger_rollback() {
		if (isset($_GET['wpvr_version'])) {
			 $version = $_GET['wpvr_version'];
			 $plugin_slug = 'wpvr';
			 $rollback = new WPVR_Rollback(
						 [
							 'version' => $version,
							 'plugin_name' => 'wpvr',
							 'plugin_slug' => $plugin_slug,
							 'package_url' => sprintf( 'https://downloads.wordpress.org/plugin/%s.%s.zip', $plugin_slug, $version ),
						 ]
					 );

					 $rollback->run();
		}
	}


}
