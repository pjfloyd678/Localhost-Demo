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
$text = filter_input(INPUT_POST, 'text');
$url = filter_input(INPUT_POST, 'url');
if ($text === '' || $url === '') {
    $response['code'] = 502;
    $response['message'] = 'Error. Blank data provided.';
    echo json_encode($response);
    exit();
}
$dbConnect = new dbConnect( DBFILENAME );
$result = (array) $dbConnect->saveData($text, $url);
if (!$result) {
    $response['code'] = 503;
    $response['message'] = "Error saving record";
    echo json_encode($response);
    exit();
}
$queryNewRecord = (array) $dbConnect->getRowByWhere("websiteSort", 0);
if (!$queryNewRecord) {
    $response['code'] = 504;
    $response['message'] = "Error getting post record";
    echo json_encode($response);
    exit();
}

$queryMax = (array) $dbConnect->getMax();
if (!$queryMax) {
    $response['code'] = 504;
    $response['message'] = "Error getting max";
    echo json_encode($response);
    exit();
}
$max = intval($queryMax['response'][0]['max']);
$id = $queryNewRecord['response'][0]['websiteID'];

$updateRecord = (array) $dbConnect->updateData($id, "websiteSort", ($max+10));
if (!$updateRecord) {
    $response['code'] = 505;
    $response['message'] = "Error completing final query";
    echo json_encode($response);
    exit();
}
echo json_encode($updateRecord);
exit();
