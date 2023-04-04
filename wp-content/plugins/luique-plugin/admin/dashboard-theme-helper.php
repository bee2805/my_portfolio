<?php

/* Theme Info Class */
if ( ! function_exists( 'luique_theme_info' ) ) {
  function luique_theme_info() {
    $data = array();

    $theme = wp_get_theme();
    $theme_parent = $theme->parent();
    if ( !empty( $theme_parent ) ) {
      $theme = $theme_parent;
    }
    $data['slug'] = $theme->get_stylesheet();
    $data['name'] = $theme[ 'Name' ];
    $data['version'] = $theme[ 'Version' ];
    $data['author'] = $theme[ 'Author' ];
    $data['is_child'] = ! empty( $theme_parent );

    return $data;
  }
}
if ( ! class_exists( 'LuiqueThemeInfo' ) ) {
  class LuiqueThemeInfo {

    private static $_instance = null;

    public $slug;

    public $name;

    public $version;

    public $author;

    public $is_child;

    public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init();
			}
			return self::$_instance;
		}

    public function __construct() {

		}

    public function init() {
      $theme = wp_get_theme();
      $theme_parent = $theme->parent();
      if ( !empty( $theme_parent ) ) {
        $theme = $theme_parent;
      }

      $this->slug = $theme->get_stylesheet();
      $this->name = $theme[ 'Name' ];
      $this->version = $theme[ 'Version' ];
      $this->author = $theme[ 'Author' ];
      $this->is_child = ! empty( $theme_parent );
    }
  }
}

function luique_theme_info() {
  return LuiqueThemeInfo::instance();
}
add_action( 'plugins_loaded', 'luique_theme_info' );

/* Plugin Info Class */
if ( ! class_exists( 'LuiquePluginInfo' ) ) {
  class LuiquePluginInfo {

    private static $_instance = null;

    public $name;

    public $version;

    public $author;

    public $slug;

    public $capability;

    public $dashboard_uri;

    public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
				self::$_instance->init();
			}
			return self::$_instance;
		}

    public function __construct() {

		}

    public function init() {
      $plugin = LuiquePlugin::get_plugin_info();
      $status = get_option( 'Luique_lic_Status' );

      $this->name = $plugin['Name'];
      $this->version = $plugin['Version'];
      $this->author = $plugin[ 'Author' ];
      $this->slug = 'luique-plugin';
      $this->capability = ( $status == 'active' ) ? 'extended' : 'normal';
      $this->dashboard_uri = plugin_dir_url( __FILE__ );
    }
  }
}

function luique_plugin_info() {
  return LuiquePluginInfo::instance();
}
add_action( 'plugins_loaded', 'luique_plugin_info' );

/*Activation Notice*/
if ( ! function_exists( 'luique_theme_activation_notice' ) ) {
	function luique_theme_activation_notice() {
	?>
		<div class="notice notice-warning">
			<p><?php echo wp_kses_post( 'Please activate Luique theme to unlock all features, premium plugins, demo content and receive theme updates automatically!', 'luique-plugin' ); ?></p>
			<p><?php echo sprintf( __( '<a href="%s" class="button button-primary">Activate Now</a>', 'luique-plugin' ), admin_url( 'admin.php?page=luique-theme-activation' ) ); ?></p>
		</div>
	<?php
	}
}

/* Activation Filter */
if ( ! function_exists( 'luique_is_theme_activated' ) ) {
	function luique_is_theme_activated() {
		return apply_filters( 'luique/is_theme_activated', false );
	}
}
