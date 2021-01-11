<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once('../smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->setTemplateDir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/templates/' );
$smarty->setConfigDir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/configs/' );
$smarty->display('recaptcha.tpl');
