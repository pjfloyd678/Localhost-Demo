<?php
ini_set( 'display_errors',         1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

include_once '../db/dbConnect.php';

$response = [
    'code' => 501,
    'message' => 'Wrong protocol provided'
];
if ( !$_GET ) {
    echo json_encode( $response );
    exit();
}
$raw = filter_input( INPUT_GET, 'order' );
$sub = trim( $raw, "[" );
$sub = trim( $sub, "]" );
$order = explode(",", $sub );
$success = TRUE;
$ctr = 1;
foreach ( $order as $item => $value) {
    $result = updateData( strval($value), 'websiteSort', ( $ctr * 10 ) );
    if ( $result[ 'response' ] !== TRUE ) {
        if ( count( $result[ 'response' ] ) > 0 ) {
            $success = FALSE;
            break;
        }
    }
    $ctr++;
}
if ( $success ) {
    $response[ 'code' ]    = 200;
    $response[ 'message' ] = 'Order Saved';
} else {
    $response[ 'code' ]    = 500;
    $response[ 'message' ] = 'Error Saving Data';
}
echo json_encode( $response );
exit(0);
