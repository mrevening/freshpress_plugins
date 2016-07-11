<?php
//*************************
//Dodanie nowego typu wpisu - badañ
//*************************

/*Konfiguracja typu wpisu */
add_action( 'init', 'fresh_badanie');
/*Rejestracja typu wpisu bloga*/
function fresh_badanie(){
    /*Ustawienie argumentów dla typu wpisu badania */
    $badanie_args = array(
        'public' => true,
        'query_var' => 'badanie',
        'menu_position' => 3,
        //'taxonomies' => 'szpital',
        'menu_icon' => 'dashicons-edit',
        'labels' => array(
            'name' => 'Badania',
            'singular name' => 'Badanie',
            'add_new' => 'Dodaj nowe badanie',
            'add_new_item' => 'Dodaj nowe badanie',
            'edit_item' => 'Edytuj badanie',
            'new_item' => 'Nowe badanie',
            'view_item' => 'Wyœwietl badanie',
            'search_item' => 'Szukaj w badaniach',
            'now_found' => 'Nie znaleziono badania',
            'not_found_in_trash' => 'Nie znaleziono badania w koszu'
       ),
       'capabilities' => array(
            'edit_post' => 'edit_badanie',
            'edit_posts' => 'edit_badania',
            'edit_others_posts' => 'edit_other_badania',
            'publish_posts' => 'publish_badania',
            'read_post' => 'read_badania',
            'read_private_posts' => 'read_private_badania',
            'delete_post' => 'delete_badania',
        ),
    );
    /*Rejestracja typu wpisu bloga*/
    register_post_type( 'badanie', $badanie_args);
}