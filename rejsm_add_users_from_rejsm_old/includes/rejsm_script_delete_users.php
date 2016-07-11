<?php

//add_menu_page( 'admin', 'rejsm_delete_users_oldrejsm');
function rejsm_delete_users_oldrejsm(){

    $user_count = count_users();
    //var_dump ($user_count);
    for ($i = 2; $i < $user_count['total_users']-1; $i++) {
        wp_delete_user( $i);
    }
    $user_count = count_users();
    if ( $user_count['total_users'] == 1) {
        echo '<div id="message" class="updated">Pomyœlnie wykonano skrypt.</div>';
    }
    else {
        echo '<div id="message" class="error">Zaistnia³ b³¹d podczas wykonywania skryptu.</div>';
    }
}
?>