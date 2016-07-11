<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//add_action( 'wp_enqueue_scripts', 'wpb_adding_js' );
//admin_enqueue_scripts
add_action( 'login_enqueue_scripts', 'rejsm_pesel_verification');
function rejsm_pesel_verification(){
    $handle = 'js_pesel_verification';
    $src =  '/wp-content/plugins/rejsm_superwtyczka/includes/js/js_pesel_verification.js';
    wp_enqueue_script( $handle, $src);
}

//1. Add a new form element...
add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {
    $pesel = ( ! empty( $_POST['key_pesel'] ) ) ? trim( $_POST['key_pesel'] ) : '';
?>
<p>
    <label for="pesel">
        <?php _e( 'Pesel', 'mydomain' ) ?>
        <br />
        <input type="text" name="key_pesel" id="pesel" maxlength="11" value="<?php echo esc_attr( wp_unslash( $pesel ) ); ?>"
            onkeypress='return pesel_verification(event);' />
    </label>
</p>
<?php
}
//2. Add validation. In this case, we make sure pesel is required.
add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {
    require_once dirname(__FILE__) . '/rejsm_validate_pesel.php';
    if ( empty( $_POST['key_pesel'] ) || ! empty( $_POST['key_pesel'] ) && trim( $_POST['key_pesel'] ) == '' ) {
        $errors->add( 'pesel_error', __( '<strong>BŁĄD</strong>: Proszę wprowadzić pesel.', 'mydomain' ) );
    }
    else if (! validatepesel($_POST['key_pesel'] ) ) {
        $errors->add( 'pesel_error', __( '<strong>BŁĄD</strong>: Nieprawidłowy format numeru pesel.', 'mydomain' ) );
    }
    else if ( pesel_exists($_POST['key_pesel'] ) ) {
        $errors->add( 'pesel_error', __( '<strong>BŁĄD</strong>: Pesel jest już w systemie.', 'mydomain' ) );
    }
    if (!empty( $errors->errors ) ) {
        add_action('login_head', 'wpb_add_loginshake');
        function wpb_add_loginshake() {
            add_action('login_head', 'wp_shake_js', 12);
        }
    }
    return $errors;
}

//3. Finally, save our extra registration user meta.
add_action( 'user_register', 'myplugin_user_register' );
function myplugin_user_register( $user_id ) {
    if ( ! empty( $_POST['key_pesel'] ) ) {
        update_user_meta( $user_id, 'pesel', trim( $_POST['key_pesel'] ) );
    }
}
?>