<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';

if ( ! session_status() ) {
    session_start();
}

$_SESSION = array();
if ( session_status() ) {
    session_destroy();
}
$smarty->assign( 'loggedin', false );
redirect("index.php");
