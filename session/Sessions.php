<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

function isLoggedIn() {
    if ( empty( $_SESSION[ 'loggedIn' ] ) ) {
        return false;
    }
    return true;
}
    
function redirect( $url ) {
    header( "Location: " . HTTPHOSTNAME . "/" . $url );
}
