<?php
/*
Plugin Name: Rejsm Superwtyczka
Plugin URI: https://github.com/mrevening/rejsm_superwtyczka
Description: Dostosowuje panel administracyjny i funkcjonalność backendu Wordpress do potrzeb platformy Rejsm
Version: 0.1
Author: Dominik Wieczorek
Author URI: https://github.com/mrevening/
License: GPLv2
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
load_plugin_textdomain( 'rejsm_superwtyczka', false, 'rejsm_superwtyczka/languages' );
require_once dirname(__FILE__) . '/includes/rejsm_registration_form_customize.php';
require_once dirname(__FILE__) . '/includes/rejsm_new_post_type_badanie.php';
require_once dirname(__FILE__) . '/includes/rejsm_users_possibilities.php';
require_once dirname(__FILE__) . '/includes/rejsm_form_dane_demograficzne.php';
require_once dirname(__FILE__) . '/includes/rejsm_custom_design.php';
require_once dirname(__FILE__) . '/includes/rejsm_change_username_text.php';


?>