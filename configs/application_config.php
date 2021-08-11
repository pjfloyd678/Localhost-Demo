<?php

define( "SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] );
define( "CODE_DIR", dirname( $_SERVER['DOCUMENT_ROOT'] ) );
define( "SITE_TOP", dirname( CODE_DIR ) );
define( "CONFIG_DIR", SITE_ROOT . '/configs' );
define( "TEMPLATES_DIR", SITE_ROOT.'/templates' );
define( "TEMPLATES_ADMIN_DIR", SITE_ROOT.'/templates/_admin' );
define( "TEMP_DIR", SITE_TOP . '/dynamic/templates_c/' );
define( "HTDOCS_PATH", SITE_ROOT.'/' );
define( "HTTPHOSTNAME", 'http://localhost' );
define( "DBCONFGFILE" , CONFIG_DIR . "/dbconfig.xml" );

require_once( __DIR__ . '/../smarty/libs/Smarty.class.php' );
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/dbConnect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Sessions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/smarty/libs/Smarty.class.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$smarty = new Smarty();
$smarty->setTemplateDir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/templates/' );
$smarty->setConfigDir( $_SERVER[ 'DOCUMENT_ROOT' ] . '/configs/' );

$dbConnect = new DBConnect( DBCONFGFILE );

function smartyDisplay( $t, $s=NULL ) {
    global $smarty;
    if ( is_null( $s ) ) {
	$s = $smarty;
    }
    $s->display( $t );
}

$smarty = new Smarty;
$smarty->debugging = false;
$smarty->caching = false;		// I think this is the default
$smarty->cache_lifetime = 0;
$smarty->compile_check = true;
$smarty->force_compile = false;
$smarty->compile_dir = TEMP_DIR;
$smarty->template_dir = TEMPLATES_DIR;

function display( $code, $response, $json = false ) {
    $data = [
        'code' => $code,
        'response' => $response,
    ];
    if ( $json ) {
        echo json_encode( $data );
        exit(0);
    }
    return $data;
}
