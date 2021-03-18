<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/smarty/libs/Smarty.class.php' );

define( "SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] );
define( "CODE_DIR", dirname( $_SERVER['DOCUMENT_ROOT'] ) );
define( "SITE_TOP", dirname( CODE_DIR ) );
define( "CONFIG_DIR", SITE_ROOT . '/configs' );
define( "TEMPLATES_DIR", SITE_ROOT.'/templates' );
define( "TEMPLATES_ADMIN_DIR", SITE_ROOT.'/templates/_admin' );
define( "TEMP_DIR", SITE_TOP . '/dynamic/templates_c/' );
define( "HTDOCS_PATH", SITE_ROOT.'/' );

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
