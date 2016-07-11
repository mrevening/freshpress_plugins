<?php
//function registration_errors_check ($errors) {
//    if ( empty( $_POST['key_pesel'] ) || ! empty( $_POST['key_pesel'] ) && trim( $_POST['key_pesel'] ) == '' ) {
//        $errors->add( 'pesel_error', __( '<strong>B£¥D</strong>: Proszê wprowadziæ pesel.', 'mydomain' ) );
//    }
//    else if (! validatepesel($_POST['key_pesel'] ) ) {
//        $errors->add( 'pesel_error', __( '<strong>B£¥D</strong>: Nieprawid³owy format numeru pesel.', 'mydomain' ) );
//    }
//    else if ( pesel_exists($_POST['key_pesel'] ) ) {
//        $errors->add( 'pesel_error', __( '<strong>B£¥D</strong>: Pesel jest ju¿ w systemie.', 'mydomain' ) );
//    }
//    if (empty( $errors->errors ) ) {
//        add_action('login_head', 'wpb_remove_loginshake');
//        function wpb_remove_loginshake() {
//            add_action('login_head', 'wp_shake_js', 12);
//        }
//    }
//    return $errors;
//}


function validatepesel($pesel) {
    $reg = '/^[0-9]{11}$/';
    if(preg_match($reg, $pesel)==false)
        return false;
    else
    {
        $dig = str_split($pesel);
        $kontrola = (1*intval($dig[0]) + 3*intval($dig[1]) + 7*intval($dig[2]) + 9*intval($dig[3]) + 1*intval($dig[4]) + 3*intval($dig[5]) + 7*intval($dig[6]) + 9*intval($dig[7]) + 1*intval($dig[8]) + 3*intval($dig[9]))%10;
        if($kontrola == 0) $kontrola = 10;
        $kontrola = 10 - $kontrola;
        if(intval($dig[10]) == $kontrola)
            return true;
        else
            return false;
    }
}
    function pesel_exists( $pesel ) {
        if ( get_users(array('meta_key' => 'pesel', 'meta_value' => $pesel) ) ) {
            return true;
        }
        return false;
}

?>