<?php
///*
//Plugin Name: Rejsm Dane demograficzne
//Plugin URI: https://github.com/mrevening/freshpress_plugins
//Description: Dodaje nowy typ wpisu - dane demograficzne
//Version: 0.1
//Author: Dominik Wieczorek
//Author URI: https://github.com/mrevening/
//License: GPLv2
// */
//add_action( 'init', 'rejsm_register_dane_demograficzne' );
//function rejsm_register_dane_demograficzne() {
//    $args = array (
//        'public' => true,
//        'query_var' => 'dane_demograficzne',
//        'rewrite' => array(
//            'slug' => 'dane_demograficzne',
//            'with_front' => false,
//        ),
//        'menu_position' => 2,
//        'menu_icon' => 'dashicons-edit',
//        'supports' => array(
//            //'title'//,
//            //'thumbnail'
//        ),
//        'labels' => array(
//            'name' => 'Dane demograficzne',
//            'singular_name' => 'Dana demograficzna',
//            'add_new' => 'Dodaj nowe dane demograficzne',
//            'add_new_item' => 'Dodaj nową daną demograficzną',
//            'edit_item' => 'Edytuj dane demograficzne',
//            'new_item' => 'Nowe dane demograficzne',
//            'view_item' => 'Wyświetl dane demograficzne',
//            'search_items' => 'Szukaj w danych demograficznych',
//            'not_found' => 'Nie znaleziono danych demograficznych',
//            'not_found_in_trash' => 'Nie znaleziono danych demograficznych w koszu'
//        ),
//    );
//    /* Rejestracja typu wpisu bloga music_album. */
//    register_post_type( 'music_album', $args );
//}
//add_action( 'add_meta_box', 'rejsm_pole_create');
//function rejsm_pole_create() {
//    add_meta_box( 'id-pole', 'Własne pole użytkownika', 'rejsm_pole_function', 'dane_demograficzne', 'normal', 'high');
//}
//function rejsm_pole_function() {
//    echo 'Witaj w polu użytkownika';
//}


















/*
Plugin Name: Przykładowa wtyczka pola użytkownika
Plugin URI: http://przyklad.pl/wtyczki-wordpresss/moja-wtyczka
Description: Wtyczka tworzy pola użytkownika w WordPress
Version: 1.0
Author: Brad Williams
Author URI: http://wrox.com
License: GPLv2
*/
// Zaczep pozwalający na dodanie pola użytkownika.
//add_action( 'add_meta_boxes', 'boj_mbe_create' );
function boj_mbe_create() {
	// Utworzenie własnego pola użytkownika.
	add_meta_box( 'boj-meta', 'Własne pole użytkownika', 'boj_mbe_function', 'post', 'normal', 'high' );
}
function boj_mbe_function( $post ) {
	// Pobranie wartości metadanych, o ile istnieją.
	$boj_mbe_name = get_post_meta( $post->ID, '_boj_mbe_name', true );
	$boj_mbe_costume = get_post_meta( $post->ID, '_boj_mbe_costume', true );
	echo 'Proszę wypełnić poniższe pola';
?>
	<p>Imię: <input type="text" name="boj_mbe_name" value="<?php echo esc_attr( $boj_mbe_name ); ?>" /></p>
    <p>Kostium:
    <select name="boj_mbe_costume">
        <option value="vampire" <?php selected( $boj_mbe_costume, 'vampire' ); ?>q>Wampir</option>
        <option value="zombie" <?php selected( $boj_mbe_costume, 'zombie' ); ?>>Zombie</option>
        <option value="smurf" <?php selected( $boj_mbe_costume, 'smurf' ); ?>>Smerf</option>
    </select>
    </p>
	<?php
}

// Zaczep pozwalający na zapis danych pola użytkownika.
//add_action( 'save_post', 'boj_mbe_save_meta' );

function boj_mbe_save_meta( $post_id ) {

	// Sprawdzenie, czy metadane zostały podane.
	if ( isset( $_POST['boj_mbe_name'] ) ) {
	
		// Zapis metadanych.
		update_post_meta( $post_id, '_boj_mbe_name', strip_tags( $_POST['boj_mbe_name'] ) );
		update_post_meta( $post_id, '_boj_mbe_costume', strip_tags( $_POST['boj_mbe_costume'] ) );
	
	}

}
?>

