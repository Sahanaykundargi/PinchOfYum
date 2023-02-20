<?php

/**
 * The settings of the plugin.
 *
 * @link       https://www.3cx.com
 * @since      10.0.0
 *
 * @package    wplc_Plugin
 * @subpackage wplc_Plugin/admin
 */

/**
 * Class WordPress_Plugin_Template_Settings
 *
 */
class wplc_Admin_Settings
{

  /**
   * The ID of this plugin.
   *
   * @since    10.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    10.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    10.0.0
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct($plugin_name, $version)
  {

    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * This function introduces the theme options into the 'Appearance' menu and into a top-level
   * '3CX Live Chat' menu.
   */
  public function setup_plugin_options_menu()
  {

    //Add the menu to the Plugins set of menu items
    add_menu_page(
      '3CX Live Chat',
      '3CX Live Chat',
      'manage_options',
      'wplc_options',
      array($this, 'render_settings_page_content'),
      'dashicons-format-chat'
    );
  }

  public function read_config()
  {
    return $this->get_display_options();
  }

  /**
   * Provides default values for the Display Options.
   *
   * @return array
   */
  private function get_display_options()
  {
    $defaults = array(
      'callus_url' => '',
      'show_all_pages' => '',
      'include_pages' => '',
      'powered_by' => ''
    );
    $temp_options = get_option('wplc_display_options');
    // force defaults when there is no value
    foreach ($defaults as $k => $v) {
      if (!isset($temp_options[$k])) {
        $temp_options[$k] = $v;
      }
    }
    $options = array();
    // remove values without a default
    foreach ($temp_options as $k => $v) {
      if (isset($defaults[$k])) {
        $options[$k] = $v;
      }
    }
    return $options;
  }

  /**
   * Renders settings page
   */
  public function render_settings_page_content($active_tab = '')
  {
?>
    <!-- Create a header in the default WordPress 'wrap' container -->
    <div class="wrap">

      <h2><?php _e('3CX Live Chat Options', 'wp-live-chat-support'); ?></h2>
      <?php $active_tab = 'display_options'; settings_errors(); ?>

      <form method="post" action="options.php">
        <?php

        if ($active_tab == 'display_options') {

          settings_fields('wplc_display_options');
          do_settings_sections('wplc_display_options');
        }

        submit_button();

        ?>
      </form>

    </div><!-- /.wrap -->
<?php
  }


  /**
   * This function provides a simple description for the General Options page.
   *
   * It's called from the 'wplc_initialize_theme_options' function by being passed as a parameter
   * in the add_settings_section function.
   */
  public function general_options_callback()
  {
  } // end general_options_callback

  /**
   * Initializes the theme's display options page by registering the Sections,
   * Fields, and Settings.
   *
   * This function is registered with the 'admin_init' hook.
   */
  public function initialize_display_options()
  {

    add_settings_section(
      'general_settings_section',                  // ID used to identify this section and with which to register options
      '',            // Title to be displayed on the administration page
      array($this, 'general_options_callback'),      // Callback used to render the description of the section
      'wplc_display_options'                    // Page on which to add this section of options
    );

    // Next, we'll introduce the fields for toggling the visibility of content elements.

    add_settings_field(
      'pbx_config',
      __('Get 3CX', 'wp-live-chat-support'),
      array($this, 'pbx_config_callback'),
      'wplc_display_options',
      'general_settings_section',
      array($this->read_config())
    );
    
    add_settings_field(
      'callus_url',
      __('3CX Talk URL', 'wp-live-chat-support'),
      array($this, 'toggle_callus_url_callback'),
      'wplc_display_options',
      'general_settings_section',
      array()
    );

    add_settings_field(
      'show_all_pages',                    
      __('Enable in all pages', 'wp-live-chat-support'), 
      array($this, 'toggle_show_all_pages_callback'), 
      'wplc_display_options',       
      'general_settings_section',   
      array(                        
      )
    );

    add_settings_field(
      'pages_include',
      __('Just these', 'wp-live-chat-support'),
      array($this, 'toggle_include_pages_callback'),
      'wplc_display_options',
      'general_settings_section',
      array(
      )
    );

    add_settings_field(
      'powered_by',                   
      __('Show "Powered By 3CX"', 'wp-live-chat-support'), 
      array($this, 'toggle_powered_by_callback'), 
      'wplc_display_options',     
      'general_settings_section', 
      array(                      
      )
    );    

    // Finally, we register the fields with WordPress
    register_setting(
      'wplc_display_options',
      'wplc_display_options',
      array($this, 'validate_options')
    );
  } // end initialize_display_options

  /**
   * This function renders the interface elements for toggling the visibility of the header element.
   *
   * It accepts an array or arguments and expects the first element in the array to be the description
   * to be displayed next to the checkbox.
   */

  public function pbx_config_callback($args){
    $config=reset($args);
    $html ='<p class="description">'.__('To activate Live Chat you need 3CX to be set up. You can sign up for a free 3CX account with unlimited users. If you already have 3CX you can skip this step.','wp-live-chat-support').'</p>';
    //if (empty($config['callus_url'])) {
      $html.='<div class="wplc_subscribe_box">
      <div class="wplc_subscribe_title">'.__('GET 3CX FREE', 'wp-live-chat-support').'</div>
      <div class="wplc_subscribe_subtitle">'.__('Live Chat & Call for Free', 'wp-live-chat-support').'</div>
      <a class="wplc_subscribe_button" href="https://www.3cx.com/startup?src=livechatwp" target="_blank"><img style="margin-right:4px" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=" alt="Google Sign Up" width="24" height="24">
      '.__('Sign up with Google', 'wp-live-chat-support').'</a>
      <div class="wplc_subscribe_or"><span class="xcx-line"></span><span>'.__('OR', 'wp-live-chat-support').'</span><span class="xcx-line"></span></div>
      <a class="wplc_subscribe_button" href="https://www.3cx.com/startup?src=livechatwp" target="_blank"><img style="width:23px;height:17px;margin-top:4px;margin-right:4px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAARCAMAAAABrcePAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6REE5NkY1MTM4QjUwMTFFREI0QjFDMDNGMDY1NDRDOUQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6REE5NkY1MTQ4QjUwMTFFREI0QjFDMDNGMDY1NDRDOUQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDpEQTk2RjUxMThCNTAxMUVEQjRCMUMwM0YwNjU0NEM5RCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDpEQTk2RjUxMjhCNTAxMUVEQjRCMUMwM0YwNjU0NEM5RCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PipCAH4AAADqUExURf///zc3N5iYmJTN/82UNzc3SKp4SNrz//P/////+v///EE3N3iq2lc3N/rguPHfz6JtSDdXgvH8/8Cabfr//4BkN5/W/zdBaDc3Qd/x/PbQl39sYevDj11BN+jHouD6/+jo3JtkN4JXN//88cPr/EFdj12Pw6q5z0g3N5/R8UFzpv/z05rA3PPapjdBXfPaqv/64NGfaPz//2FhYW2i02SAmLmqmFeCuMCUN9afUTdXl7jg+vzx0XhIN0h4qo9dQYW44Pzrw9D2///z2mx/onNBN7iFXeC4gjc3Uev8/5TA2mSb0cfo+jdIbfi3ptUAAACqSURBVHjadNBVEoNAEATQmSDB4u7u7u5u979OskAqsJD+fLVV070gecYOOpUYQNyF1sz3wOLI8j6EzMcZoMOq/vBTvMypjmuniTsr1Bx9i5+KF1KE+J3H9jaoc/csc8pUu1voydHyTeXdBiO1Pqv3kZIprJMjrROWit8+pKc7j69mNlDFSQaMDgee7OQUAcwOYjoxOD6Nu/7ttfeZzXfiNQwNr5W5ofAWYADEJQ1CtVI1fgAAAABJRU5ErkJggg=="/>
      '.__('Sign up with email', 'wp-live-chat-support').'</a>
    </div>';
    //}
    echo $html;
  } // end pbx_config_callback

  public function toggle_callus_url_callback($args)
  {
    $options = $this->read_config();
    $html ='<p class="description">'.__('During signup you were given a 3CX Talk URL (or get it from Admin > Voice & Chat> Add Live Chat). Copy the URL here.','wp-live-chat-support').'</p><br/>';
    $html.='<input type="text" id="callus_url" style="width:600px" name="wplc_display_options[callus_url]" placeholder="'.htmlspecialchars(sprintf(__('Example: %s', 'wp-live-chat-support'),'https://your-pbx.3cx.eu:5001/LiveChat12345')).'" value="' . $options['callus_url'] . '" />';
    echo $html;
  } // end toggle_callus_url_callback

  public function toggle_show_all_pages_callback($args)
  {
    $options = $this->read_config();
    $html = '<input type="checkbox" id="show_all_pages" name="wplc_display_options[show_all_pages]" value="1" ' . checked(1, isset($options['show_all_pages']) ? $options['show_all_pages'] : 0, false) . '/>';
    echo $html;
  } // end toggle_show_all_pages_callback

  public function toggle_include_pages_callback($args)
  {
    $options = $this->read_config();
    $pages = get_pages();
    $pagenums = !empty($options['include_pages']) ? $options['include_pages'] : array();
    $pagelist = array();
    $homepageId = get_option('page_on_front');
    $pagelist[1] = 'Home';
    if (!empty($homepageId)) {
      $pagelist[$homepageId] = 'Home';
    }
    foreach ($pages as $page) {
      $pagelist[$page->ID] = $page->post_title;
    }
    $html = '<div class="wplc_pages_scrollbox' . ($options['show_all_pages'] ? ' wplc_box_disabled' : '') . '">';
    foreach ($pagelist as $k => $v) {
      $html .= '<p><input type="checkbox" id="display_page_' . $k . '" name="wplc_display_options[include_pages][' . $k . ']" value="1" ' . checked(1, isset($pagenums[$k]) ? 1 : 0, false) . '/>';
      $html .= htmlspecialchars($v) . '</p>';
    }
    $html .= '</div>';
    echo $html;
  } // end toggle_include_pages_callback

  public function toggle_powered_by_callback($args)
  {
    $options = $this->read_config();
    $html = '<input type="checkbox" id="powered_by" name="wplc_display_options[powered_by]" value="1" ' . checked(1, isset($options['powered_by']) ? $options['powered_by'] : 0, false) . '/>';
    echo $html;
  } // end toggle_powered_by_callback  

  public function validate_options($input)
  {
    $output = array();
    $output['show_all_pages'] = 0;
    if (isset($input['show_all_pages'])) {
      $output['show_all_pages'] = intval($input['show_all_pages']);
    }
    $output['powered_by'] = 0;
    if (isset($input['powered_by'])) {
      $output['powered_by'] = intval($input['powered_by']);
    }
    $output['callus_url'] = '';
    if (isset($input['callus_url'])) {
      $output['callus_url'] = strip_tags(stripslashes($input['callus_url']));
      $url=parse_url($output['callus_url']);
      $path=preg_replace("/[^A-Za-z0-9 ]/", '', reset(explode('/',substr($url['path'],1).'/')));
      if ($path=='' || substr($output['callus_url'],-1,1)=='/' || substr($output['callus_url'],-1,1)=='?'|| substr($output['callus_url'],0,8)!='https://' || !filter_var($output['callus_url'], FILTER_VALIDATE_URL,  FILTER_FLAG_PATH_REQUIRED)) {
        add_settings_error('wplc_display_options', 'callus_url', sprintf(__('Invalid 3CX Talk URL: %s', 'wp-live-chat-support'), htmlspecialchars($input['callus_url'])), 'error');
        $output['callus_url'] = '';
      } else {
        $output['callus_url']='https://'.$url['host'].((isset($url['port']) && $url['port']!=443) ? ':'.$url['port'] : '').'/'.$path;
      }
    }
    $output['include_pages'] = array();
    if (is_array($input['include_pages'])) {
      foreach ($input['include_pages'] as $k => $v) {
        $output['include_pages'][intval($k)] = intval($v);
      }
    }
    return apply_filters('validate_options', $output, $input);
  } // end validate_options

}
