<?php

define( "DBFILENAME", __DIR__ . "\..\configs\dbconfig.xml" );

require_once __DIR__ . '/../auth/PasswordHash.php';
include 'sql.php';

$dbname = "";
$username = "";
$password = "";
$hostname = "";
$dbport = "";
$tablename = "";

$pdodb = "";
    
$userTable = "user";
    
if ( ! readConfig( DBFILENAME ) ) {
    die("Could not read config");
}
