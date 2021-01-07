<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once('./smarty/libs/Smarty.class.php');
require_once './classes/dbConnect.php';
$smarty = new Smarty();
$dbConnect = new DBConnect();
$result = (array) $dbConnect->getLinks();
$smarty->assign( "links", $result[ 'response' ] );
$smarty->display('index.tpl');
