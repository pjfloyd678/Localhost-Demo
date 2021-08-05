<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';

require_once '/data/php/include/coda.php';
aecphp::pkginc( 'coda' );
require_once 'coda/cCookies/cCookies.php';

include $_SERVER['DOCUMENT_ROOT'] . '/banner_left.php';
include $_SERVER['DOCUMENT_ROOT'] . '/banner.php';

$recipies = array(
    0 => array(
        'name' => "Easy Sugar Cookies",
        'url'  => "https://www.allrecipes.com/recipe/9870/easy-sugar-cookies/",
    ),
    1 => array(
        'name' => "Salted Chocolate Cookies",
        'url'  => "https://www.allrecipes.com/recipe/277919/salted-chocolate-cookies/",
    ),
    2 => array(
        'name' => "Chocolate Chocolate Chip Cookies III",
        'url'  => "https://www.allrecipes.com/recipe/10995/chocolate-chocolate-chip-cookies-iii/",
    ),
    3 => array(
        'name' => "Oatmeal Peanut Butter Cookies III",
        'url'  => "https://www.allrecipes.com/recipe/10759/oatmeal-peanut-butter-cookies-iii/",
    ),
);

$p = filter_input( INPUT_GET, "p" );
if ( isset( $p ) ) {
    $n = mt_rand(0, 3);
    $smarty->assign( "recipe", $recipies[ $n ] );
    $smarty->assign( "showrecipe", true ); 
} else {
    $smarty->assign( "recipe", array() );
    $smarty->assign( "showrecipe", false );
}
if ( isset( $_SESSION[ 'user_id' ] ) ) {
    $userID      = $_SESSION[ 'user_id' ];
    $results     = cCookies::read( $userID );
    $userInfo    = $results[ 'user_info' ];
    $preferences = $results[ 'preferences' ];
} else {
    $userInfo    = array();
    $preferences = array();
}

$smarty->assign( 'user_info', $userInfo );
$smarty->assign( 'preferences', $preferences );
smartyDisplay( 'cookies/index.tpl' );
