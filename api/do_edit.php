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
$id = filter_input(INPUT_POST, 'id');
if ($id === '') {
    $response['code'] = 502;
    $response['message'] = 'Error. Blank data provided.';
    echo json_encode($response);
    exit();
}
$dbConnect = new dbConnect();
$result = (array) $dbConnect->deleteData($id); 
echo json_encode($result);
exit();
