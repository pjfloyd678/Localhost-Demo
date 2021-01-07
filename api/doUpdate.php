<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../classes/dbConnect.php';

$response = [
    'code' => 501,
    'message' => 'Wrong protocol provided'
];
if (!$_POST) {
    echo json_encode($response);
    exit();
}
$id   = filter_input(INPUT_POST, 'id');
$text = filter_input(INPUT_POST, 'text');
$url  = filter_input(INPUT_POST, 'url');
if ($id === '' || $text === '' || $url === '') {
    $response['code'] = 502;
    $response['message'] = 'Error. invalid data provided.';
    echo json_encode($response);
    exit();
}
$dbConnect = new dbConnect();
$updateData = array(
    'webisteID' => $id,
    'websiteText' => $text,
    'websiteURL' => $url,
);
$result = (array) $dbConnect->updateAll($id, $updateData );
if (!$result) {
    $response['code'] = 503;
    $response['message'] = "Error saving record";
    echo json_encode($response);
    exit();
}
$response[ 'code' ] = 200;
$response[ 'message' ] = "Data updated!";
echo json_encode( $response );
exit();
