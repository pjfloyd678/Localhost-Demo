<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';

$result = (array) $dbConnect->getLinks();

$smarty->assign( "loggedin", $_SESSION[ 'loggedIn' ] );
$smarty->assign( "links", $result[ 'response' ] );
$smarty->display('index.tpl');
