<?php
require_once ABSPATH . '/wp-includes/pluggable.php' ; //błąd wordpressa, musi być ta komenda.

error_reporting(E_ALL);
ini_set('display_errors', 1); //raportowanie błędów. POTEM USUNĄĆ




add_action( 'admin_enqueue_scripts', 'rejsm_css_add_style');
function rejsm_css_add_style(){
    $handle = 'css_style_form_dane_demograficzne';
    $src =  '/wp-content/plugins/rejsm_superwtyczka/includes/css/css_style_dane_demograficzne.css';
    wp_enqueue_style( $handle, $src);
    //add_filter( 'wpcf7_support_html5_fallback', '__return_true' );
}
add_action( 'admin_enqueue_scripts', 'rejsm_pesel_verification');
if ( ! current_user_can('administrator') ) { //nie wyświetlaj danych demograficznych dla administratora, W PRZYSZŁOŚCI DODAJ LEKARZA
    add_action( 'profile_personal_options', 'rejsm_display_danedemograficzne_metadata' ); //dodaje treść za sekcją personalizacja
}
//
add_action( 'user_new_form', 'rejsm_display_pesel_metadata' );
function rejsm_display_pesel_metadata( $user ){
?>
        <table class="form-table">
        <tr>
            <th scope="row">Pesel <i>(wymagane)</i></th>
            <td>
                <input type="text" id ="pesel" name="key_pesel" maxlength="11"
                       onkeypress='return pesel_verification(event);' />
                <span class="description">Pesel użytkowników nie może być zmieniany.</span>
            </td>
        </tr>
        </table>
<?php
}
add_filter( 'user_profile_update_errors', 'pesel_verification_user_register_admin', 10, 3 );
function pesel_verification_user_register_admin($errors, $update , $user){
    if (! $update) {
        require_once dirname(__FILE__) . '/rejsm_validate_pesel.php';
        if ( empty( $_POST['key_pesel'] ) || ! empty( $_POST['key_pesel'] ) && trim( $_POST['key_pesel'] ) == '' ) {
            $errors->add( 'pesel_error', __( '<strong>BŁĄD</strong>: Proszę wprowadzić pesel.', 'mydomain' ) );
        }
        else if (! validatepesel($_POST['key_pesel'] ) ) {
            $errors->add( 'pesel_error', __( '<strong>BŁĄD</strong>: Nieprawidłowy format numeru pesel.', 'mydomain' ) );
        }
        else if ( pesel_exists($_POST['key_pesel'] ) ) {
            $errors->add( 'pesel_error', __( '<strong>BŁĄD</strong>: Pesel jest już w systemie.' , 'mydomain' ) );
        }
    }
    return $errors;
}




add_action( 'edit_user_profile', 'rejsm_display_danedemograficzne_metadata' );
function rejsm_display_danedemograficzne_metadata( $user ){
    $userid = $user->ID;
    $pesel = get_user_meta( $userid, 'pesel', true );
    $plec = get_user_meta( $userid, 'plec', true );
    $miejsce_zamieszkania = get_user_meta( $userid, 'miejsce_zamieszkania', true );
    $wojewodztwo = get_user_meta( $userid, 'wojewodztwo', true );
    $recznosc = get_user_meta( $userid, 'recznosc', true );
    $porody = get_user_meta( $userid, 'porody', true );
    $wyksztalcenie = get_user_meta( $userid, 'wyksztalcenie', true );
    $stan_rodzinny = get_user_meta( $userid, 'stan_rodzinny', true );
    $zatrudnienie = get_user_meta( $userid, 'zatrudnienie', true );
    $praca_dochod = get_user_meta( $userid, 'praca_dochod', true );
    $sm_w_rodzinie = get_user_meta( $userid, 'sm_w_rodzinie', true );
    $inicjaly = get_user_meta( $userid, 'inicjaly', true );
    $data_zgonu = get_user_meta( $userid, 'data_zgonu', true );


?>
    <h2>Dane demograficzne</h2>
    <table class="form-table">
        <tr>
            <th scope="row">Pesel <i>(wymagane)</i></th>
            <td>
                <input type="text" value="<?php echo $pesel; ?>" id ="pesel" name="key_pesel" maxlength="11" disabled />
                <span class="description">Pesel użytkowników nie może być zmieniany</span>
            </td>
        </tr>
        <tr>
            <th scope="row">Płeć</th>
            <td>
                <select id="plec" name="key_plec">
                    <option value="0" <?php selected( '0', $plec); ?> ></option>
                    <option value="1" <?php selected( '1', $plec); ?> >Mężczyzna</option>
                    <option value="2" <?php selected( '2', $plec); ?> >Kobieta</option>
                </select>
            </td>
        </tr>
        <tr>
        <th scope="row">Miejsce zamieszkania</th>
        <td>
            <select id="miejsce_zamieszkania" name="key_miejsce_zamieszkania">
                <option value="0" <?php selected( '0', $miejsce_zamieszkania); ?>></option>
                <option value="1" <?php selected( '1', $miejsce_zamieszkania); ?>>Miasto</option>
                <option value="2" <?php selected( '2', $miejsce_zamieszkania); ?>>Wieś</option>
            </select>
        </td>
    </tr>
        <tr>
            <th scope="row">Województwo</th>
            <td>
                <select id="wojewodztwo" name="key_wojewodztwo">
                    <option value="0" <?php selected( '0', $wojewodztwo); ?>></option>
                    <option value="1" <?php selected( '1', $wojewodztwo); ?>>dolnośląskie</option>
                    <option value="2" <?php selected( '2', $wojewodztwo); ?>>kujawsko-pomorskie</option>
                    <option value="3" <?php selected( '3', $wojewodztwo); ?>>lubelskie</option>
                    <option value="4" <?php selected( '4', $wojewodztwo); ?>>lubuskie</option>
                    <option value="5" <?php selected( '5', $wojewodztwo); ?>>łódzkie</option>
                    <option value="6" <?php selected( '6', $wojewodztwo); ?>> małopolskie</option>
                    <option value="7" <?php selected( '7', $wojewodztwo); ?>>mazowieckie</option>
                    <option value="8" <?php selected( '8', $wojewodztwo); ?>>opolskie</option>
                    <option value="9" <?php selected( '9', $wojewodztwo); ?>>podkarpackie</option>
                    <option value="10" <?php selected( '10', $wojewodztwo); ?>>podlaskie</option>
                    <option value="11" <?php selected( '11', $wojewodztwo); ?>>pomorskie</option>
                    <option value="12" <?php selected( '12', $wojewodztwo); ?>>śląskie</option>
                    <option value="13" <?php selected( '13', $wojewodztwo); ?>>świętokrzyskie</option>
                    <option value="14" <?php selected( '14', $wojewodztwo); ?>>warmińsko-mazurskie</option>
                    <option value="15" <?php selected( '15', $wojewodztwo); ?>>wielkopolskie</option>
                    <option value="16" <?php selected( '16', $wojewodztwo); ?>>zachodniopomorskie</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Ręczność</th>
            <td>
                <select id="recznosc" name="key_recznosc">
                    <option value="0"<?php selected( '0', $recznosc); ?>></option>
                    <option value="1"<?php selected( '1', $recznosc); ?>>Praworęczny</option>
                    <option value="2"<?php selected( '2', $recznosc); ?>>Leworęczny</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Porody</th>
            <td>
                <select id="porody" name="key_porody">
                    <option value="0" <?php selected( '0', $porody); ?>></option>
                    <option value="1" <?php selected( '0', $porody); ?>>0</option>
                    <option value="2" <?php selected( '1', $porody); ?>>1</option>
                    <option value="3" <?php selected( '2', $porody); ?>>2</option>
                    <option value="4" <?php selected( '3', $porody); ?>>3</option>
                    <option value="5" <?php selected( '4', $porody); ?>>3 lub więcej</option>
                    <option value="6" <?php selected( '5', $porody); ?>>Nie dotyczy
                    </option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Wykształcenie</th>
            <td>
                <select id="wyksztalcenie" name="key_wyksztalcenie">
                    <option value="0" <?php selected( '0', $wyksztalcenie); ?>></option>
                    <option value="1" <?php selected( '1', $wyksztalcenie); ?>>Podstawowe</option>
                    <option value="2" <?php selected( '2', $wyksztalcenie); ?>>Średnie</option>
                    <option value="3" <?php selected( '3', $wyksztalcenie); ?>>Wyższe</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Stan rodzinny</th>
            <td>
                <select id="stan_rodzinny" name="key_stan_rodzinny">
                    <option value="0" <?php selected( '0', $stan_rodzinny); ?>></option>
                    <option value="1" <?php selected( '1', $stan_rodzinny); ?>>Panna/Kawaler</option>
                    <option value="2" <?php selected( '2', $stan_rodzinny); ?>>Zamężna/Żonaty</option>
                    <option value="4" <?php selected( '4', $stan_rodzinny); ?>>Rozwiedziona/y</option>
                    <option value="3" <?php selected( '5', $stan_rodzinny); ?>>Wdowa/Wdowiec</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Zatrudnienie</th>
            <td>
                <select id="zatrudnienie" name="key_zatrudnienie">
                    <option value="0" <?php selected( '0', $zatrudnienie); ?>></option>
                    <option value="1" <?php selected( '1', $zatrudnienie); ?>>Nie pracuje</option>
                    <option value="2" <?php selected( '2', $zatrudnienie); ?>>Pracuje</option>
                    <option value="3" <?php selected( '3', $zatrudnienie); ?>>Renta</option>
                    <option value="4" <?php selected( '4', $zatrudnienie); ?>>Emerytura</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Dochód z pracy</th>
            <td>
                <select id="praca_dochod" name="key_praca_dochod">
                    <option value="0" <?php selected( '0', $praca_dochod); ?>></option>
                    <option value="1" <?php selected( '1', $praca_dochod); ?>>Tak</option>
                    <option value="2" <?php selected( '2', $praca_dochod); ?>>Nie</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">SM w rodzinie</th>
            <td>
                <select id="sm_w_rodzinie" name="key_sm_w_rodzinie">
                    <option value="0" <?php selected( '0', $sm_w_rodzinie); ?>></option>
                    <option value="1" <?php selected( '1', $sm_w_rodzinie); ?>>Tak</option>
                    <option value="2" <?php selected( '2', $sm_w_rodzinie); ?>>Nie</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row">Inicjały</th>
            <td>
                <input type="text" value="<?php echo $inicjaly; ?>" id="inicjaly" name="key_inicjaly" maxlength="3" />
                <span class="description">Pierwsza litera imienia i dwie pierwsze nazwiska</span>
            </td>
        </tr>
        <tr>
            <th scope="row">Data Zgonu</th>
            <td>
                <input type="date" value="<?php echo $data_zgonu; ?>" name="key_data_zgonu" id="data_zgonu">
                <span class="description">yyyy-mm-dd</span>
            </td>
        </tr>
    </table>
<?php
}

add_action( 'personal_options_update', 'rejsm_update_dane_demograficzne_metadata' );
add_action( 'edit_user_profile_update', 'rejsm_update_dane_demograficzne_metadata' );
function rejsm_update_dane_demograficzne_metadata( $userid ) {
    if( isset( $_POST['key_pesel'] ) ) {
        $var_pesel = $_POST['key_pesel'];
        update_user_meta( $userid, 'pesel', $var_pesel);
    }
    if( isset( $_POST['key_plec'] ) ) {
        $var_plec = $_POST['key_plec'];
        update_user_meta( $userid, 'plec', $var_plec);
    }
    if( isset( $_POST['key_miejsce_zamieszkania'] ) ) {
        $var_miejsce_zamieszkania = $_POST['key_miejsce_zamieszkania'];
        update_user_meta( $userid, 'miejsce_zamieszkania', $var_miejsce_zamieszkania);
    }
    if( isset( $_POST['key_wojewodztwo'] ) ) {
        $var_wojewodztwo = $_POST['key_wojewodztwo'];
        update_user_meta( $userid, 'wojewodztwo', $var_wojewodztwo);
    }
    if( isset( $_POST['key_recznosc'] ) ) {
        $var_recznosc = $_POST['key_recznosc'];
        update_user_meta( $userid, 'recznosc', $var_recznosc);
    }
    if( isset( $_POST['key_porody'] ) ) {
        $var_porody = $_POST['key_porody'];
        update_user_meta( $userid, 'porody', $var_porody);
    }
    if( isset( $_POST['key_wyksztalcenie'] ) ) {
        $var_wyksztalcenie = $_POST['key_wyksztalcenie'];
        update_user_meta( $userid, 'wyksztalcenie', $var_wyksztalcenie);
    }
    if( isset( $_POST['key_stan_rodzinny'] ) ) {
        $var_stan_rodzinny = $_POST['key_stan_rodzinny'];
        update_user_meta( $userid, 'stan_rodzinny', $var_stan_rodzinny);
    }
    if( isset( $_POST['key_zatrudnienie'] ) ) {
        $var_zatrudnienie = $_POST['key_zatrudnienie'];
        update_user_meta( $userid, 'zatrudnienie', $var_zatrudnienie);
    }
    if( isset( $_POST['key_praca_dochod'] ) ) {
        $var_praca_dochod = $_POST['key_praca_dochod'];
        update_user_meta( $userid, 'praca_dochod', $var_praca_dochod);
    }
    if( isset( $_POST['key_sm_w_rodzinie'] ) ) {
        $var_sm_w_rodzinie = $_POST['key_sm_w_rodzinie'];
        update_user_meta( $userid, 'sm_w_rodzinie', $var_sm_w_rodzinie);
    }
    if( isset( $_POST['key_inicjaly'] ) ) {
        $var_inicjaly = $_POST['key_inicjaly'];
        update_user_meta( $userid, 'inicjaly', $var_inicjaly);
    }
    if( isset( $_POST['key_data_zgonu'] ) ) {
        $var_data_zgonu = $_POST['key_data_zgonu'];
        update_user_meta( $userid, 'data_zgonu', $var_data_zgonu);
    }
}
?>
