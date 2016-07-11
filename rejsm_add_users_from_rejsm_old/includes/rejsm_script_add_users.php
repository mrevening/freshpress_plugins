<?php
global $wpdb;
$sql = "SELECT * FROM patients ORDER BY Pesel ASC LIMIT 10";
$dane = $wpdb->get_results($sql, OBJECT);
if ($wpdb->last_error) {
    ?><div id="message" class="error">Zaistniał błąd podczas wykonywania skryptu.</div>'<?php
}
else {
    ?><div id="message" class="updated">Pomyślnie wykonano skrypt.</div> <?php
    //add_action ('init', 'rejsm_create_user' );
    //function rejsm_create_user(){
    $i=1;
    foreach ($dane as $row) {
        $userdata = array(
            'user_login' => $row->{'PESEL'},
            'user_email' => $row->{'email'},
            'user_pass' => $row->{'password'}
            );
        wp_insert_user( $userdata);
        echo $i."</BR>";
    }
}
?>