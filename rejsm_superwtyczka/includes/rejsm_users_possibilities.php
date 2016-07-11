<?php
//*************************
//Usunięcie zbędnych możliwości użytkowników
//*************************

/*Pobranie roli administratora*/
$role = get_role( 'administrator' );
/*Sprawdzenie czy rola istnieje*/
if ( !empty ($role) ){
    /*Usunięcie z roli możliwości edit_post. */
    //$role->remove_cap( 'edit_posts' );
    $role->add_cap('edit_badanie');
    $role->add_cap('edit_badania');
    $role->add_cap('edit_other_badania');
    $role->add_cap('publish_badania');
    $role->add_cap('read_badania');
    $role->add_cap('read_private_badania');
    $role->add_cap('delete_badania');

}
?>