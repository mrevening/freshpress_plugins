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
?>