<?php
function isLoggedIn() {
    if ( empty( $_SESSION[ 'loggedIn' ] ) ) {
        return false;
    }
    return true;
}
    
function redirect( $url ) {
    header( "Location: " . HTTPHOSTNAME . "/" . $url );
}
