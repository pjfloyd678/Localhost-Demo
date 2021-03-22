<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';
require_once '../classes/Sessions.php';
session_start();
if ( !empty( $_POST ) ) {
    $u = filter_input( INPUT_POST, "emailaddress" );
    $p = filter_input( INPUT_POST, "password" );
    if ( $u === "peterjfloyd@gmail.com" && $p === "v7%scHJwC%z#SnV%" ) {
        $_SESSION[ 'loggedIn' ] = true;
        Sessions::redirect("index.php");
        exit();
    }
}
echo "Cannot process - No Post Data";
die(1);
