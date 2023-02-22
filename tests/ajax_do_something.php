<?php

include_once( "../classes/DB_Return_OBJ.php" );

$return_obj = new DB_Return_OBJ();
$pharma_type = filter_input( INPUT_POST, 'pharma_type' );
if ( isset( $pharma_type ) ) {
    $return_obj->set(
        true,
        [ 'result' => $pharma_type ],
        0,
        $pharma_type
    );
} else {
    $return_obj->set(
        false,
        [],
        -1,
        "No Data Provided!"
    );
}
$return_data = $return_obj->get();
$jsonData = json_encode( $return_data );
sleep( 1 );
echo $jsonData;
