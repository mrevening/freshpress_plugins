<?php
/*
Plugin Name: Przenieś dane użytkowników ze starego rejestru REJSM do nowego
Plugin URI: https://github.com/mrevening/rejsm_superwtyczka
Description: Przenosi dane użytkowników ze starego rejestru. Przenieś ręcznie tabelę 'danedemograficzne' i 'pacjenci do bazy danych z wordpressem i wejdź w menu w zakładkę Użytkownicy -> Przenieś użytkowników.
Version: 0.1
Author: Dominik Wieczorek
Author URI: https://github.com/mrevening/
License: GPLv2
 */

add_action( 'admin_menu', 'rejsm_users_add_metadata_info_page');
function rejsm_users_add_metadata_info_page() {
    add_users_page( 'Przenieś użytkowników',
                   'Przenieś dane użytkowników ze starej witryny',
                   'manage_options',
                   __FILE__,
                   'rejsm_users_add_settings_page'
                   );
}

add_action( 'admin_menu', 'rejsm_add_users_js');
function rejsm_add_users_js() {
    wp_enqueue_script( 'rejsm_js_script', plugin_dir_path( __FILE__).'js/rejsm_add_user_script.js');
}

function rejsm_users_add_settings_page(){
?>
    <h2>Przenieś użytkowników z poprzedniej witryny</h2>
    <p>W celu przeniesienia danych o użytkownikach ze starego rejestru na nowy, oparty o Wordpress, musisz wykonać dwa kroki:</p>
    <li>przekopiuj tabele "danedemograficzne" i "pacjenci" do bazy danych zawierającej wordpressa</li>
    <li>kliknij przycisk "Dodaj użytkowników".</li>
    <!--<a href=".?dodaj=true"  class="button-primary">Dodaj użytkowników</a>-->
    <form action="#" method="post">
    <button type="submit" name="dodaj" value="true" class="button-primary">Dodaj użytkowników</button>
</form>
    <p>Po wykonaniu tej operacji usuń ręcznie zbędne tabele.</p>
    <?php
    if (isset($_POST['dodaj'])) {
        $select1 = $_POST['dodaj'];
        if ( $select1 == "true" ) {
            require_once dirname( __FILE__).'/includes/rejsm_script_add_users.php' ;
        }
    }
}
?>