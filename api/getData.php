<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../db/dbConnect.php';

$result = (array) getLinks();
echo json_encode($result);
exit();
