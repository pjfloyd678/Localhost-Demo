<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$data = filter_input( INPUT_POST, 'action' );
if ( !isset( $data ) ) {
    $data = null;
};

switch ($data) {
    case 'init':
        $_SESSION[ 'display' ] = 1;
        break;
    
    case 'post':
        $_SESSION[ 'display' ] = 0;
        break;
    
    default:
        $_SESSION[ 'display' ] = 1;
        break;
}
echo ( $_SESSION[ 'display' ] );
