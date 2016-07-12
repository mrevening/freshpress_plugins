<?php
function rejsm_delete_users_oldrejsm( $role = 'subscriber' ) {
    $users = get_users(
            array (
                'role' => $role
            )
        );
    if ( is_array ($users ) ) {
        foreach ( $users as $user ) {
            wp_delete_user( $user->ID);
        }
    }
    else {
        return  new WP_Error('broke', __("Brak użytkowników."));
    }
}
$return = rejsm_delete_users_oldrejsm();
    if (is_wp_error( $return )) {
        echo '<div id="message" class="error">Zaistniał błąd podczas wykonywania skryptu. '.$return->get_error_message().'</div>';
    }
    else {
        echo '<div id="message" class="updated">Pomyślnie wykonano skrypt - usunięto użytkowników. </div>';
    }
?>