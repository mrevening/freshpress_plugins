<?php
//*************************
//Usuni�cie zb�dnych mo�liwo�ci u�ytkownik�w
//*************************

/*Pobranie roli administratora*/
$role = get_role( 'administrator' );
/*Sprawdzenie czy rola istnieje*/
if ( !empty ($role) ){
    /*Usuni�cie z roli mo�liwo�ci edit_post. */
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