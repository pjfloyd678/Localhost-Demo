<?php

ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once ( __DIR__ . '/../configs/application_config.php' );
require_once ( __DIR__ . '/../classes/User.php' );

/**
 * reply( $code, $msg )
 * This function echo/returns the JSON data back to the calling site
 * @param Integer $code This is the code that was generated.
 * @param String $msg This is the message that we generated.
 * @return String JSON Data back to the calling site.
 */
function reply( $code, $msg ) {
    $data = array();
    $data[ 'code' ] = $code;
    $data[ 'response' ] = $msg;
    echo json_encode( $data );
    exit();
}

empty( $_GET['emailaddress'] ) && reply( 401, "no email set" );

$data = filter_input( INPUT_GET, 'emailaddress' );
$user = new User();
$result = $user->getByEmail( $data );
$return = true;
if ( empty( $result[ 'response' ] ) ) {
    $return = false;
}
echo json_encode( $return );
