<?php
/**
 * Changes 'Username' to 'Email Address' on wp-admin login form
 * and the forgotten password form
 *
 * @return null
 */
function rejsm_login_head() {
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
            $translated_text = __( 'Pesels cannot be changed. ' , 'user_login' );
        }

        return $translated_text;
    }
    add_filter( 'gettext', 'rejsm_username_label', 20, 3 );
}
add_action( 'login_head', 'rejsm_login_head' );
add_action( 'personal_options', 'rejsm_login_head');
add_action( 'user_new_form', 'rejsm_login_head');

//add_action( 'profile_personal_options', 'test');
//add_action( 'user_register', 'rejsm_login_head');
//add_action( 'register_form', 'rejsm_login_head');
//add_action( 'show_user_profile', 'rejsm_login_head');
//add_action( 'admin_head-profile', 'rejsm_login_head');
//add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
//add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );




//function remove_fields_edit_user()
//{
//    echo '<style>tr.user-url-wrap{ display: none; }</style>';
//}
//add_action( 'admin_head-user-edit.php', 'remove_fields_edit_user' );
//add_action( 'admin_head-profile.php',   'remove_fields_edit_user' );


add_filter('gettext', 'remove_admin_stuff', 20, 3);
/**
 * Remove the text at the bottom of the Custom fields box in WordPress Post/Page Editor.
 *
 * @link http://codex.wordpress.org/Plugin_API/Filter_Reference/gettext
 */
function remove_admin_stuff( $translated_text, $untranslated_text, $domain ) {

    $custom_field_text = 'Username';

    if ( is_admin() && $untranslated_text === $custom_field_text ) {
        return 'Pesel';
    }

    return $translated_text;
}





?>