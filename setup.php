<?php

require_once('./smarty/libs/Smarty.class.php');
require_once('./classes/dbConnect.php');
require_once('./classes/Setup.php');

$smarty = new Smarty();
if ( ! $_POST ) {
    $smarty->assign( 'loggedin', false );
    $smarty->display( 'setup.tpl' );
    exit();
}

$dbname    = filter_input( INPUT_POST, "dbname");
$username  = filter_input( INPUT_POST, "username");
$password  = filter_input( INPUT_POST, "password");
$hostname  = filter_input( INPUT_POST, "hostname");
$dbport    = filter_input( INPUT_POST, "port");
$tablename = filter_input( INPUT_POST, "tablename");

$setup = new Setup();
$arrayData = array();
$arrayData[ 'dbname' ] = $dbname;
$arrayData[ 'username' ] = $username;
$arrayData[ 'password' ] = $password;
$arrayData[ 'hostname' ] = $hostname;
$arrayData[ 'dbport' ] = $dbport;
$arrayData[ 'tablename' ] = $tablename;
$setup->setData( $arrayData );
$setup->saveXMLFile();

