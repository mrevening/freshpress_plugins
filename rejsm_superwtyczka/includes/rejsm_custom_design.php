<?php
add_action("login_head", "my_login_head");
function my_login_head() {
    echo "
    <style>
    #login h1 a {
        background: url('".plugin_dir_url( __FILE__ )."/images/logo-login.gif') ;
        height: 84px;
        width: 84px;
    }
    </style>
    ";
}
function loginpage_custom_link() {
	return home_url();
}
add_filter('login_headerurl','loginpage_custom_link');

function change_title_on_logo() {
	return 'Rejestr chorych na stwardnienie rozsiane';
}
add_filter('login_headertitle', 'change_title_on_logo');

// Admin footer modification
function remove_footer_admin ()
{
    echo '<span id="footer-thankyou">Content-related supervision by dr n. med. Waldemar Brola, dr n. med. Małgorzata Fudala. Technological supervision by dr inż. Stanisław Flaga. Designed by <a href="http://www.github.com/mrevening" target="_blank">mrevening</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

function custom_admin_logo() {
    echo '
        <style type="text/css">
            #header-logo { background-image: url('.get_bloginfo('stylesheet_directory').'/images/logo.png) !important; }
        </style>
    ';
}
add_action('admin_head', 'custom_admin_logo');


///*-----------------------------------------------------------------------------------*/
///* Remove Unwanted Admin Menu Items */
///*-----------------------------------------------------------------------------------*/

//function remove_admin_menu_items() {
//    $remove_menu_items = array(__('Posts'));
//    global $menu;
//    end ($menu);
//    while (prev($menu)){
//        $item = explode(' ',$menu[key($menu)][0]);
//        if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
//        unset($menu[key($menu)]);}
//    }
//}

//add_action('admin_menu', 'remove_admin_menu_items');


function remove_website_row_wpse_94963_css()
{
    echo '<style>tr.user-url-wrap{ display: none; }</style>';
    echo '<style>tr.user-description-wrap{ display: none; }</style>';
    echo '<style>tr.user-profile-picture-wrap{ display: none; }</style>';
    echo '<style>tr.user-first-name-wrap{ display: none; }</style>';
    echo '<style>tr.user-last-name-wrap{ display: none; }</style>';


}
add_action( 'admin_head-user-edit.php', 'remove_website_row_wpse_94963_css' );
add_action( 'admin_head-profile.php',   'remove_website_row_wpse_94963_css' );



/**
 * Changes 'Username' to 'Email Address' on wp-admin login form
 * and the forgotten password form
 *
 * @return null
 */
function rejsm_login_head() {
    add_filter( 'gettext', 'rejsm_username_label', 20, 3 );
    function rejsm_username_label( $translated_text, $text, $domain ) {
        if ( 'Username or Email' === $text  ) {
            $translated_text = __( 'Pesel / Email' , 'user_login' );
        }
        if ( 'Username' === $text ) {
            $translated_text = __( 'Pesel' , 'user_login' );
        }
        if ( '<strong>ERROR</strong>: Please enter a username.' === $text ) {
            $translated_text = __( 'Pesel' , 'user_login' );
        }
        if ( 'Usernames cannot be changed.' === $text ) {
            $translated_text = __( 'Pesel nie może być zmieniony. ' , 'user_login' );
        }
        return $translated_text;
    }
}
add_action( 'login_head', 'rejsm_login_head' );
add_action( 'personal_options', 'rejsm_login_head');
add_action( 'user_new_form', 'rejsm_login_head');

add_filter('gettext', 'remove_admin_stuff', 20, 3);
/**
 * Remove the text at the bottom of the Custom fields box in WordPress Post/Page Editor.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function remove_admin_stuff( $translated_text, $untranslated_text, $domain ) {

    $custom_field_text = 'Username';

    if ( is_admin() && $untranslated_text === 'Username' ) {
        return "Pesel pacjenta <br> lub <br> Imie i nazwisko lekarza";
    }

    return $translated_text;
}

function remove_posts_menu() {
    
    if ( ! function_exists( 'unregister_post_type' ) ) :
    function unregister_post_type( $post_type ) {
        global $wp_post_types;
        if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
            return true;
        }
        return false;
    }
    endif;
    unregister_post_type( 'page' );
}
add_action('admin_init', 'remove_posts_menu');



//ładownie ankiet automoatycznie dla każdego pacjenta
function hide_the_dashboard()
{
    global $current_user;
    // is there a user ?
    if ( is_array( $current_user->roles ) ) {
        // substitute your role(s):
        if ( in_array( 'pacjent', $current_user->roles ) ) {
            // hide the dashboard:
            remove_menu_page( 'index.php' );
        }
    }
}
add_action( 'admin_menu', 'hide_the_dashboard' );

function your_login_redirect( $redirect_to, $request, $user )
{
    // is there a user ?
    if ( is_array( $user->roles ) ) {
        // substitute your role(s):
        if ( in_array( 'pacjent', $user->roles ) ) {
            // pick where to redirect to, in the example: Posts page
            return admin_url( 'post-new.php?post_type=msis_29' );
        } else {
            return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'your_login_redirect', 10, 3 );

?>