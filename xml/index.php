<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/dbConnect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Sessions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smarty/libs/Smarty.class.php';

session_start();

$smarty = new Smarty();
$smarty->setTemplateDir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/templates/' );
$smarty->setConfigDir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/configs/' );

$dbFilename = __DIR__ . '\configs\dbconfig.xml';
$dbConnect = new DBConnect( $dbFilename );

if ( empty( $_SESSION ) || !Sessions::isLoggedIn() ) {
    $smarty->assign( 'loggedin', false );
    $smarty->display( 'auth/login.tpl' );
    exit();
}

$result = (array) $dbConnect->getLinks();
$smarty->assign( "loggedin", $_SESSION[ 'loggedIn' ] );

$smarty->display('xml/xml.tpl');
