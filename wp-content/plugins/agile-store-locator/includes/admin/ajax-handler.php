<?php

namespace AgileStoreLocator\Admin;


if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
*
* AjaxHandler Responsible for handling all the AJAX Requests for the admin calls
*
* @package    AgileStoreLocator
* @subpackage AgileStoreLocator/Admin/AjaxHandler
* @author     AgileStoreLocator Team <support@agilelogix.com>
*/
class AjaxHandler {

  /**
   * [__construct Register the main route to handle AJAX]
   */
  public function __construct() {

    //  Admin request asl ajax handler for all requests
    add_action('wp_ajax_asl_ajax_handler', [$this, 'handle_request']); 
  }

  /**
   * [$ajax_actions All the AJAX actions]
   * @var array
   */
  private $ajax_actions = [];


  /**
   * [add_routes Add all the admin routes that handle the AJAX]
   */
  public function add_routes() {

    /*For Stores*/
    $this->register_route('update_store', 'Store' ,'update_store');
    $this->register_route('add_store', 'Store', 'add_new_store');  
    $this->register_route('delete_all_stores', 'Store', 'admin_delete_all_stores');  
    $this->register_route('get_store_list', 'Store', 'get_store_list');  
    $this->register_route('delete_store', 'Store', 'delete_store');  
    $this->register_route('duplicate_store', 'Store', 'duplicate_store');  
    $this->register_route('remove_duplicates', 'Store', 'remove_duplicates');  
    $this->register_route('validate_coords', 'Store', 'validate_coordinates'); 
    $this->register_route('store_status', 'Store', 'store_status');  
    $this->register_route('approve_stores', 'Store', 'approve_stores');

    /*Categories*/
    $this->register_route('add_categories', 'Category', 'add_category');
    $this->register_route('delete_category', 'Category', 'delete_category');
    $this->register_route('update_category', 'Category', 'update_category');
    $this->register_route('get_category_byid', 'Category', 'get_category_by_id');
    $this->register_route('get_categories', 'Category', 'get_categories');  
    

    //  Settings
    $this->register_route('save_setting', 'Setting', 'save_setting');
    $this->register_route('load_custom_template', 'Setting', 'load_custom_template');
    $this->register_route('save_custom_template', 'Setting', 'save_custom_template');
    $this->register_route('reset_custom_template', 'Setting', 'reset_custom_template');
    $this->register_route('expertise_level', 'Setting', 'expertise_level');

    $this->register_route('save_custom_fields', 'Setting', 'save_custom_fields'); 
    $this->register_route('load_ui_settings', 'Setting', 'load_ui_settings');
    $this->register_route('save_ui_settings', 'Setting', 'save_ui_settings');

    
    $this->register_route('change_options', 'Setting', 'change_options');

    //  KML files
    $this->register_route('add_kml', 'GoogleMap', 'upload_kml_file');
    $this->register_route('delete_kml', 'GoogleMap', 'remove_kml_file');
    $this->register_route('save_custom_map', 'GoogleMap', 'save_custom_map');
  }

  /**
   * [register_route Register the AJAX calls for the plugin]
   * @param  [type] $handle        [description]
   * @param  [type] $context_class [description]
   * @param  [type] $action        [description]
   * @return [type]                [description]
   */
  public function register_route($handle, $context_class, $action) {

    $this->ajax_actions[$handle] = [$context_class, $action];
  }


  /**
   * [handle_request Handle the AJAX Request]
   * @return [type] [description]
   */
  public function handle_request() {

    //  sl-action
    $route = isset($_REQUEST['sl-action'])? $_REQUEST['sl-action']: ''; 


    //  nouce validation for CSRF
    if(!wp_verify_nonce($_REQUEST['asl-nounce'], 'asl-nounce')) {

      return $this->json_response(['nouce' => $_REQUEST['asl-nounce'], 'error' => esc_attr__('Error! request verification fail.','asl_locator')]);
    }

    //if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //}

    //  validate the route
    if(isset($this->ajax_actions[$route])) {

      $sl_request = $this->ajax_actions[$route]; 

      //  Debug is enabled
      if(ASL_DEBUG) {
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
      }
      

      $class_name = '\\'.__NAMESPACE__ . '\\' .$sl_request[0];
      $class_inst = new $class_name;
      
      //  is callable method?
      if(!is_callable([$class_inst, $sl_request[1]])) {
        return $this->json_response(['error' => esc_attr__('Error! method not exist!','asl_locator')]);
      }

      //  Result of the execution
      $results  = null;

      try {
          
        //  Execute the method
        $results = call_user_func([$class_inst, $sl_request[1]]);

      } 
      //  Caught in exception
      catch (\Exception $e) {
          
        $results = ['msg' => $e->getMessage()];
      }

      $this->json_response($results);
    }

    //  route not found
    $this->json_response(['error' => esc_attr__('Error! route not found.','asl_locator')]);
  }


  /**
   * [json_response Send the $data as JSON]
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
  public function json_response($data) {

    echo wp_json_encode($data);
    die;
  }
}

