<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';
$smarty->assign( "loggedin", $_SESSION[ 'loggedIn' ] );
$smarty->display('xml/add.tpl');
