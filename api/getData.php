<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../classes/dbConnect.php';

$dbConnect = new dbConnect();
$result = (array) $dbConnect->getLinks();
echo json_encode($result);
exit();
