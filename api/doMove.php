<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../db/dbConnect.php';

$response = [
    'code' => 501,
    'message' => 'Wrong protocol provided'
];
if (!$_POST) {
    echo json_encode($response);
    exit();
}
$id = (is_null(filter_input(INPUT_POST, 'id')) ? '': filter_input(INPUT_POST, 'id'));
$sort = (is_null(filter_input(INPUT_POST, 'sort')) ? '': filter_input(INPUT_POST, 'sort'));
$direction = (is_null(filter_input(INPUT_POST, 'direction')) ? '': filter_input(INPUT_POST, 'direction'));
if ($id === '' || $sort === '' || $direction === '') {
    $response['code'] = 502;
    $response['message'] = 'Error. Blank data provided.';
    echo json_encode($response);
    exit();
}

//All data is here --> continue!
$originalSort = intval($sort);
//Connect to DB

if ($direction === "UP") {
    $checkSort = $originalSort - 10;
} else {
    $checkSort = $originalSort + 10;    
}
$oldQuery = (array) getRowByWhere("websiteSort", $checkSort);
if (intval($oldQuery['code']) !== 200) {
    $response['code'] = $oldQuery['code'];
    $response['message'] = "Error occurred with initial query.";
    echo json_encode($response);
    exit();
}
$oldID = intval($oldQuery['response'][0]['websiteID']);

//Get the original record that will be replaced
$oldResult = (array) updateData($oldID, "websiteSort", $sort);
if (intval($oldResult['code']) !== 200) {
    $response['code'] = $oldQuery['code'];
    $response['message'] = "Error occurred with initial switch.";
    echo json_encode($response);
    exit();
}
//Do the final update
$result = (array) updateData($id, "websiteSort", $checkSort);
if (intval($result['code']) !== 200) {
    $response['code'] = $oldQuery['code'];
    $response['message'] = "Error occurred with final switch.";
    echo json_encode($response);
    exit();
}
echo json_encode($result);
exit();
