<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once ( __DIR__ . '/../configs/application_config.php' );
require_once ( __DIR__ . '/../classes/User.php' );

if ( !$_POST ) {
    $smarty->assign( 'loggedin', false );
    $smarty->display( 'auth\register.tpl' );
    exit();
}

empty( $_POST['firstname'] ) && reply( 401, "no first name set", true );
empty( $_POST['lastname'] ) && reply( 401, "no lastname set", true );
empty( $_POST['emailaddress'] ) && reply( 401, "no email set", true );
empty( $_POST['password'] ) && reply( 401, "no password set", true );

$uncryptedPassword = filter_input( INPUT_POST, 'password' );
$options = [
    'cost' => 12,
];
$password = password_hash( $uncryptedPassword, PASSWORD_BCRYPT, $options);
$data = [
    'firstname' => filter_input( INPUT_POST, 'firstname' ),
    'lastname'  => filter_input( INPUT_POST, 'firstname' ),
    'emailaddress' => filter_input( INPUT_POST, 'emailaddress' ),
    'password' => $password,
];
$user = new User();
$newUser = $user->create( $data );
if ( $newUser[ 'code' ] !== 200 ) {
    $smarty->assign( 'loggedin', false );
    $smarty->display( 'auth\error.tpl' );
    exit();
}
$smarty->assign( 'message', "You have been registered!" );
$smarty->assign( 'loggedin', false );
$smarty->display( 'auth\login.tpl' );
exit();
