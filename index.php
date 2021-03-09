<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once('./smarty/libs/Smarty.class.php');
require_once './classes/dbConnect.php';
$smarty = new Smarty();
$dbFilename = __DIR__ . '\configs\dbconfig.xml';
$dbConnect = new DBConnect( $dbFilename );
$result = (array) $dbConnect->getLinks();
$smarty->assign( "links", $result[ 'response' ] );
$smarty->display('index.tpl');
