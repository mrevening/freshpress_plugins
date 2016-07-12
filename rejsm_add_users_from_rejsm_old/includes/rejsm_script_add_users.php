<?php
require_once dirname(__FILE__) . '/rejsm_script_user_login_string.php';
function rejsm_add_users_oldrejsm( $role = 'subscriber' ) {
    global $wpdb;
    $sql = "SELECT PESEL, email, password FROM patients ORDER BY Pesel ASC LIMIT 5";
    $dane_patient = $wpdb->get_results($sql, OBJECT);
    //$sql2 = "SELECT Pesel, Plec, MiejsceZamieszkania, Wojewodztwo, Recznosc, Porody, Wyksztalcenie, StanRodzinny, Zatrudnienie,
    //        SMwRodzinie, Inicjaly, PracaZarobek, Data_zgonu, Deleted FROM danedemograficzne ORDER BY Pesel ASC LIMIT 5";
    //$dane_demograficzne = $wpdb->get_results($sql2, OBJECT);
    if ($wpdb->last_error) {
        return new WP_Error('broke', __("Błąd bazy danych. ".$wpdb->print_error));
    }
    else {
        foreach ($dane_patient as $row_dane) {
            $userdata = array(
                'user_login' => rejsm_user_login ($row_dane->{'email'}),
                'user_email' => 'test_'.$row_dane->{'email'},
                'user_pass' => $row_dane->{'password'}
                );
            $user_created_new_id = wp_insert_user( $userdata);
            if (is_wp_error ($user_created_new_id)){
                return  new WP_Error('broke', __("Błąd podczas tworzenia użytkownika. ".$user_created_new_id->get_error_message()));
            }
            else {
                $sql2 = "SELECT Pesel, Plec, MiejsceZamieszkania, Wojewodztwo, Recznosc, Porody, Wyksztalcenie, StanRodzinny, Zatrudnienie,
                        SMwRodzinie, Inicjaly, PracaZarobek, Data_zgonu, Deleted FROM danedemograficzne WHERE PESEL = ".$row_dane->{'PESEL'};
                $row = $wpdb->get_row( $sql2, OBJECT);
                if ($wpdb->last_error) {
                    return new WP_Error('broke', __("Błąd podczas pobierania metadanych. ".$wpdb->print_error) );
                }
                else if ( $row->{'Deleted'} == 0 ) {
                    add_user_meta( $user_created_new_id, 'pesel', $row->{'Pesel'} );
                    add_user_meta( $user_created_new_id, 'plec', $row->{'Plec'} );
                    add_user_meta( $user_created_new_id, 'miejsce_zamieszkania', $row->{'MiejsceZamieszkania'} );
                    add_user_meta( $user_created_new_id, 'wojewodztwo', $row->{'Wojewodztwo'} );
                    add_user_meta( $user_created_new_id, 'recznosc', $row->{'Recznosc'} );
                    add_user_meta( $user_created_new_id, 'porody', $row->{'Porody'} );
                    add_user_meta( $user_created_new_id, 'wyksztalcenie', $row->{'Wyksztalcenie'} );
                    add_user_meta( $user_created_new_id, 'stan_rodzinny', $row->{'StanRodzinny'} );
                    add_user_meta( $user_created_new_id, 'zatrudnienie', $row->{'Zatrudnienie'} );
                    add_user_meta( $user_created_new_id, 'praca_dochod', $row->{'PracaZarobek'} );
                    add_user_meta( $user_created_new_id, 'sm_w_rodzinie', $row->{'SMwRodzinie'} );
                    add_user_meta( $user_created_new_id, 'inicjaly', $row->{'Inicjaly'} );
                    add_user_meta( $user_created_new_id, 'data_zgonu', $row->{'Data_zgonu'} );
                }
            }
        }
    }
}

$return = rejsm_add_users_oldrejsm();
if ( is_wp_error( $return )) {
    echo '<div id="message" class="error">Zaistniał błąd podczas wykonywania skryptu. '.$return->get_error_message().'</div>';
}
else {
    echo '<div id="message" class="updated">Pomyślnie wykonano skrypt - dodano użytkowników. </div>';
}

?>