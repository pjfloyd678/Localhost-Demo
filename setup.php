<?php

require_once('./smarty/libs/Smarty.class.php');
require_once('./classes/dbConnect.php');
require_once('./classes/Setup.php');

$smarty = new Smarty();
if ( ! $_POST ) {
    $smarty->assign( 'title', "Localhost Links" );
    $smarty->assign( 'loggedin', false );
    $smarty->display( 'install.tpl' );
    exit();
}

$dbname    = filter_input( INPUT_POST, "dbname" );
$username  = filter_input( INPUT_POST, "username" );
$password  = filter_input( INPUT_POST, "password" );
$hostname  = filter_input( INPUT_POST, "hostname" );
$dbport    = filter_input( INPUT_POST, "port" );
$tablename = filter_input( INPUT_POST, "tablename" );
$httphost  = filter_input( INPUT_POST, "httphost" );
$email     = filter_input( INPUT_POST, "email" );
$sitepass  = filter_input( INPUT_POST, "sitepass" );

$setup = new Setup();
$arrayData = array();
$arrayData[ 'dbname' ]    = $dbname;
$arrayData[ 'username' ]  = $username;
$arrayData[ 'password' ]  = $password;
$arrayData[ 'hostname' ]  = $hostname;
$arrayData[ 'dbport' ]    = $dbport;
$arrayData[ 'tablename' ] = $tablename;

$success = false;
$setup->setData( $arrayData );
$setup->saveXMLFile();
if ( $setup->updateApplicationConfig( $httphost ) ) {
    if ( $setup->updateSQLfile( __DIR__ . "/data/create_tables.sql" ) ) {
        if ( $setup->executeSQL() ) {
            if ( $setup->addUser( $email, $sitepass ) ) {
                $success = true;
            }
        }
    }
}
$smarty->assign( 'title', "Localhost Links" );
$smarty->assign( 'loggedin', false );
$smarty->display( 'installsuccess.tpl' );
