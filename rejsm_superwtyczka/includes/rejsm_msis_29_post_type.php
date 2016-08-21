<?php
//***********************                   tworzenie ankiety MSIS_29 

add_action( 'init', 'codex_msis_29_init' );
function codex_msis_29_init() {
	$labels = array(
		'name'               => _x( 'Ankieta MSIS-29', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Ankieta', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Ankiety MSIS-29', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Ankietę MSIS-29', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Dodaj nową ankietę', 'book', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Wypełnij nową ankietę MSIS 29', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nowa ankieta', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edytuj ankietę', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Zobacz ankietę', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Wszystkie ankiety', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Szukaj ankietę', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nie znaleziono ankiety.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nie znaleziono ankiety w koszu.', 'your-plugin-textdomain' ),
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Skala wpływu stwardnienia rozsianego (MSIS-29).', 'your-plugin-textdomain' ),
		'public'             => false, //it's not public, it shouldn't have it's own permalink, and so on
        'exclude_from_search'=> true, // you should exclude it from search results
		'publicly_queryable' => true, // you should be able to query it
		'show_ui'            => true, // you should be able to edit it in wp-admin
		'show_in_menu'       => true,
        'show_in_nav_menus'  => false,  // you shouldn't be able to add it to menus
        'show_in_admin_bar'  => true,
        'menu_position'      => 101,
        'menu_icon'          => null,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'msis_29' ),
		'capability_type'    => 'post',
		'hierarchical'       => false,
        'has_archive'        => false,  // it shouldn't have archive page
        'rewrite'            => false,  // it shouldn't have rewrite rules
        'capabilities'       => array(
              'read_post'          => 'read_msis_29', 
              'edit_post'          => 'edit_msis_29', 
              'edit_posts'         => 'edit_msis_29s', 
              'delete_posts'        => 'delete_msis_29', 
              'edit_others_posts'  => 'edit_others_msis_29', 
              'publish_posts'      => 'publish_msis_29',       
              'read_private_posts' => 'read_private_msis_29', 
              'create_posts'       => 'edit_msis_29', 
        ),
		'supports'           => array( '' ),
        'publicly_queryable' => true,
	);
	register_post_type( 'msis_29', $args );
}




//***********************                   tworzenie ankiety MSIS_29  -> koniec



//zmien automaytcznie tytul każdej ankiety
add_filter( 'wp_insert_post_data' , 'modify_post_title' , '99', 1 ); // Grabs the inserted post data so you can modify it.
function modify_post_title( $data )
{
    if ( $data['post_type'] == 'msis_29' ) { // If the actual field name of the rating date is different, you'll have to update this.
        //$date = date('m/d/Y h:i:s a', time());
        $typBadania = $data['post_type'];
        $autorid = $data['post_author'];
        $autor = get_userdata($autorid);
        $date = $data['post_date'];
        $title = 'Ankieta ' . $typBadania . '_' . $autor->user_login . '_' . $date;
        $data['post_title'] =  $title ; //Updates the post title to your new title.
    }
    return $data; // Returns the modified data.
}

// **************************   Pole użytkownika z pytaniem "W ciągu ostatnich 14 dni jak bardzo stwardnienie rozsiane ograniczyło Pani/Pana zdolność do…"
add_action( 'add_meta_boxes', 'rejsm_msis_29_create' );
function rejsm_msis_29_create() {
	// Utworzenie własnego pola użytkownika.
	add_meta_box( 'msis_29_1', 'W ciągu ostatnich 14 dni jak bardzo stwardnienie rozsiane ograniczyło Pani/Pana zdolność do:', 'rejsm_msis_29_add_metabox_1', 'msis_29', 'normal', 'high' );
}
function rejsm_msis_29_add_metabox_1( $post ) {
	// Pobranie wartości metadanych, o ile istnieją.
    $rejsm_msis_29_1 = get_post_meta( $post->ID, '_rejsm_msis_29_1', true );
    $rejsm_msis_29_2 = get_post_meta( $post->ID, '_rejsm_msis_29_2', true );


?>

    <p>Wykonywania czynności wymagających wysiłku fizycznego:</p>
    Wcale nie
        <input class="msis_check" name="rejsm_msis_29_1" value="1" type="radio" <?php checked( $rejsm_msis_29_1, '1' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_1" value="2" type="radio" <?php checked( $rejsm_msis_29_1, '2' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_1" value="3" type="radio" <?php checked( $rejsm_msis_29_1, '3' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_1" value="4" type="radio" <?php checked( $rejsm_msis_29_1, '4' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_1" value="5" type="radio" <?php checked( $rejsm_msis_29_1, '5' );?> ></input>
    Bardzo mocno

    <p>Silnego chwytania przedmiotów (np. odkręcania kurków):</p>
    Wcale nie
        <input class="msis_check" name="rejsm_msis_29_2" value="1" type="radio" <?php checked( $rejsm_msis_29_2, '1' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_2" value="2" type="radio" <?php checked( $rejsm_msis_29_2, '2' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_2" value="3" type="radio" <?php checked( $rejsm_msis_29_2, '3' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_2" value="4" type="radio" <?php checked( $rejsm_msis_29_2, '4' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_2" value="5" type="radio" <?php checked( $rejsm_msis_29_2, '5' );?> ></input>
    Bardzo mocno
   
	<?php

}





// ************************************ Pole użytkownika z pytaniem "Wciągu ostatnich 14 dni jak bardzo przeszkadzały Pani/Panu…"
add_action( 'add_meta_boxes', 'rejsm_msis_29_create_2' );
function rejsm_msis_29_create_2() {
	// Utworzenie własnego pola użytkownika.
	add_meta_box( 'msis_29_2', 'W ciągu ostatnich 14 dni jak bardzo przeszkadzały Pani/Panu:', 'rejsm_msis_29_add_metabox_2', 'msis_29', 'normal', 'high' );
}
function rejsm_msis_29_add_metabox_2( $post ) {
	// Pobranie wartości metadanych, o ile istnieją.
    $rejsm_msis_29_4 = get_post_meta( $post->ID, '_rejsm_msis_29_4', true );
    $rejsm_msis_29_5 = get_post_meta( $post->ID, '_rejsm_msis_29_5', true );


?>

    <p>Problemy z równowagą:</p>
    Wcale nie
        <input class="msis_check" name="rejsm_msis_29_4" value="1" type="radio" <?php checked( $rejsm_msis_29_4, '1' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_4" value="2" type="radio" <?php checked( $rejsm_msis_29_4, '2' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_4" value="3" type="radio" <?php checked( $rejsm_msis_29_4, '3' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_4" value="4" type="radio" <?php checked( $rejsm_msis_29_4, '4' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_4" value="5" type="radio" <?php checked( $rejsm_msis_29_4, '5' );?> ></input>
    Bardzo mocno

    <p>Trudności z poruszaniem się w pomieszczeniach:</p>
    Wcale nie
        <input class="msis_check" name="rejsm_msis_29_5" value="1" type="radio" <?php checked( $rejsm_msis_29_5, '1' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_5" value="2" type="radio" <?php checked( $rejsm_msis_29_5, '2' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_5" value="3" type="radio" <?php checked( $rejsm_msis_29_5, '3' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_5" value="4" type="radio" <?php checked( $rejsm_msis_29_5, '4' );?> ></input>
        <input class="msis_check" name="rejsm_msis_29_5" value="5" type="radio" <?php checked( $rejsm_msis_29_5, '5' );?> ></input>
    Bardzo mocno
   
	<?php

}














//***************************** css buttony dodaje skrytt css
add_action( 'admin_enqueue_scripts', 'rejsm_radio_button_css');
function rejsm_radio_button_css(){
    $handle = 'rejsm_radio_button_css';
    $src =  '/wp-content/plugins/rejsm_superwtyczka/includes/css/button-style.css';
    wp_enqueue_style( $handle, $src);
}


// **************************  dodaje skrypt javascript automatycznie uzupełniający wynik ankiety
add_action( 'admin_enqueue_scripts', 'rejsm_js_wynik_actualize');
function rejsm_js_wynik_actualize($hook){
   global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'msis_29' === $post->post_type ) {     
            $handle = 'js_wynik_actualize';
            $src =  '/wp-content/plugins/rejsm_superwtyczka/includes/js/js_wynik_actualize.js';
            wp_enqueue_script( $handle, $src);
        }
    }
}




// Zaczep pozwalający na zapis danych pola użytkownika.
add_action( 'save_post', 'rejsm_msis_29_save_meta' );
function rejsm_msis_29_save_meta( $post_id ) {

	if ( isset( $_POST['rejsm_msis_29_1'] ) ) {
		update_post_meta( $post_id, '_rejsm_msis_29_1', strip_tags( $_POST['rejsm_msis_29_1'] ) );
	}
    if ( isset( $_POST['rejsm_msis_29_2'] ) ) {
		update_post_meta( $post_id, '_rejsm_msis_29_2', strip_tags( $_POST['rejsm_msis_29_2'] ) );
	}

}

















//***********************                   tworzenie ankiety - taksonomie i podpunkty ankiety

/**
 * Register 'wynik' custom taxonomy.
 */
function register_wynik_msis_29_taxonomy() {
	$args = array(
		'label'             => __( 'Wynik' ),
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'meta_box_cb'       => 'wynik_msis_29_meta_box',
	);
	register_taxonomy( 'wynik_msis_29', 'msis_29', $args );
}
add_action( 'init', 'register_wynik_msis_29_taxonomy' );


/**
 * Display wynik meta box
 */
function wynik_msis_29_meta_box( $post ) {
	$terms = get_terms( 'wynik_msis_29', array( 'hide_empty' => false ) );
	$post  = get_post();
	$rating = wp_get_object_terms( $post->ID, 'wynik_msis_29', array( 'orderby' => 'term_id', 'order' => 'ASC' ) );
	$name  = '';
    if ( ! is_wp_error( $rating ) ) {
    	if ( isset( $rating[0] ) && isset( $rating[0]->name ) ) {
			$name = $rating[0]->name;
	    }
    }
	foreach ( $terms as $term ) { 
?>
		<label title='<?php esc_attr_e( $term->name ); ?>'>
		    <input type="radio" name="wynik_msis_29" value="<?php esc_attr_e( $term->name ); ?>" <?php checked( $term->name, $name ); ?> disabled>
			<span><?php esc_html_e( $term->name ); ?></span>
		</label><br>
<?php
    }
?>
        <input type="text" id="health_status_msis" class="scale_result" value="">
<?php

}

add_action( 'init', 'add_taxonomy_terms_plec' );
function add_taxonomy_terms_plec () {
    wp_insert_term ('1) 30 – 58', 'wynik_msis_29');
    wp_insert_term ('2) 59 – 87', 'wynik_msis_29');
    wp_insert_term ('3) 88 – 116', 'wynik_msis_29');
    wp_insert_term ('4) 117 – 145', 'wynik_msis_29');
}





add_filter( 'manage_edit-msis_29_columns', 'my_edit_msis_29_columns' ) ;
function my_edit_msis_29_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Wynik' ),
		'plec' => __( 'Wynik' ),
        'Wynik' => __( 'Wynik' ),
		'date' => __( 'Date' )
	);

	return $columns;
}

add_action( 'manage_msis_29_posts_custom_column', 'my_manage_msis_29_columns', 10, 2 );
function my_manage_msis_29_columns( $column, $post_id ) {
	global $post;

	switch( $column ) {

		/* If displaying the 'duration' column. */
		case 'niewasadfljalsfjlajf' :

			/* Get the post meta. */
			$plec = get_post_meta( $post_id, 'plec', true );

			/* If no duration is found, output a default message. */
			if ( empty( $plec ) )
				echo __( 'Unknown' );

			/* If there is a duration, append 'minutes' to the text string. */
			else
				echo  $plec ;

			break;

        /* If displaying the 'genre' column. */
        case 'wynik_msis_29' :

            /* Get the genres for the post. */
            $terms = get_the_terms( $post_id, 'wynik_msis_29' );

            /* If terms were found. */
            if ( !empty( $terms ) ) {

                $out = array();

                /* Loop through each term, linking to the 'edit posts' page for the specific term. */
                foreach ( $terms as $term ) {
                    $out[] = sprintf( '<a href="%s">%s</a>',
                        esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'wynik_msis_29' => $term->slug ), 'edit.php' ) ),
                        esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'wynik_msis_29', 'display' ) )
                    );
                }

                /* Join the terms, separating them with a comma. */
                echo join( ', ', $out );
            }

            /* If no terms were found, output a default message. */
            else {
                _e( 'Brak wyniku' );
            }

            break;

        /* Just break out of the switch statement for everything else. */
        default :
            break;
	}
}












//************************* tworzenie sortowanej kolumny w widoku wszystkich ankiet


add_filter( 'manage_edit-msis_29_sortable_columns', 'msis_29_sortable_columns' );
function msis_29_sortable_columns( $columns ) {

	$columns['wynik_msis_29'] = 'wynik_msis_29';

	return $columns;
}

/* Only run our customization on the 'edit.php' page in the admin. */
//add_action( 'load-edit.php', 'my_edit_dane_demograficzne_load' );

function my_edit_dane_demograficzne_load() {
	add_filter( 'request', 'my_sort_msis_29' );
}

/* Sorts the plec. */
function my_sort_msis_29( $vars ) {

	/* Check if we're viewing the 'dane_demograficzne' post type. */
	if ( isset( $vars['post_type'] ) && 'msis_29' == $vars['post_type'] ) {

		/* Check if 'orderby' is set to 'plec'. */
		if ( isset( $vars['orderby'] ) && 'wynik_msis_29' == $vars['orderby'] ) {

			/* Merge the query vars with our custom variables. */
			$vars = array_merge(
				$vars,
				array(
                    'post_type' => 'msis_29',
					'meta_key' => 'wynik_msis_29',
					'orderby' => 'meta_value',// meta_value_num jeśli cyfra
				)
			);
		}
	}

	return $vars;
}





//***********************                   tworzenie ankiety -> koniec

















//***********        dotyczy zakładki 'POMOC'



//wyświetla pomoc
add_action( 'contextual_help', 'msis_29_codex_add_help_text', 10, 3 );
function msis_29_codex_add_help_text( $contextual_help, $screen_id, $screen ) {
  //$contextual_help .= var_dump( $screen ); // use this to help determine $screen->id
  if ( 'msis_29' == $screen->id ) {
    $contextual_help =
      '<ul>' .
      '<li>' . __('Poniższe pytania dotyczą Pani/Pana zdania na temat wpływu stwardnienia rozsianego na Pani/Pana życie codzienne w ciągu ostatnich 14 dni', 'your_text_domain') . '</li>' .
      '<li>' . __('Przy każdym pytaniu proszę zaznaczyć jedną cyfrę, która najlepiej opisuje Pani/Pana sytuację.', 'your_text_domain') . '</li>' .
      '<li>' . __('Prosimy odpowiedzieć na wszystkie pytania.', 'your_text_domain') . '</li>' .
      '</ul>';

  } elseif ( 'edit-msis_29' == $screen->id ) {
    $contextual_help =
      '<p>' . __('To jest ekran pomocy wyświetlania tabeli zawartości ankiet.', 'your_text_domain') . '</p>' ;
  }
  return $contextual_help;
}
//wyświetla pomoc
add_action('admin_head', 'msis_29_codex_custom_help_tab');
function msis_29_codex_custom_help_tab() {

  $screen = get_current_screen();

  // Return early if we're not on the book post type.
  if ( 'msis_29' != $screen->post_type )
    return;

  // Setup help tab args.
  $args = array(
    'id'      => 'msis_29', //unique id for the tab
    'title'   => 'Pomoc', //unique visible title for the tab
    'content' => '<h3>Pomoc</h3><p>Jak nie wiesz jak wypełnić tą ankiete skontaktuj się ze swoim lekarzem.</p>',  //actual help text
  );
  
  // Add the help tab.
  $screen->add_help_tab( $args );
}


//private post 
add_action( 'transition_post_status', 'wpse118970_post_status_new', 10, 3 );
function wpse118970_post_status_new( $new_status, $old_status, $post ) { 
    if ( $post->post_type == 'dane_demograficzne' && $new_status == 'publish' && $old_status  != $new_status ) {
        $post->post_status = 'private';
        wp_update_post( $post );
    }
} 
//private post - interface
add_action( 'post_submitbox_misc_actions' , 'msis_29_change_visibility_metabox' );
function msis_29_change_visibility_metabox(){
    global $post;
    if ($post->post_type != 'msis_29')
        return;
        $message = __('<strong>Note:</strong> Publikowane ankiety są zawsze <strong>prywatne</strong>.');
        $post->post_password = '';
        $visibility = 'private';
        $visibility_trans = __('Private');

        global $_wp_admin_css_colors;
        global $admin_colors; // only needed if colors must be available in classes
        $admin_colors = $_wp_admin_css_colors;
    ?>
    <style type="text/css">
        .priv_pt_note {
            background-color: <?php $admin_colors; ?>
            border: 1px solid green;
            border-radius: 2px;
            margin: 4px;
            padding: 4px;
        }
    </style>
    <script type="text/javascript">
        (function($){
            try {
                $('#post-visibility-display').text('<?php echo $visibility_trans; ?>');
                $('#hidden-post-visibility').val('<?php echo $visibility; ?>');
            } catch(err){}
        }) (jQuery);
    </script>
    <div class="priv_pt_note">
        <?php echo $message; ?>
    </div>
    <?php
}

//***********        dotyczy zakładki 'pomoc'              ->koniec



?>