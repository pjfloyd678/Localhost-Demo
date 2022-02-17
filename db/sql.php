<?php

function connect( $connectToDB = true ) {
    global $hostname;
    global $username;
    global $password;
    global $dbname;
    global $dbport;
    if ( $connectToDB ) {
        $mysqli = new mysqli($hostname, $username, $password, $dbname, (int) $dbport);
    } else {
        $mysqli = new mysqli( $hostname, $username, $password );
    }
    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    return $mysqli;
}
    
function pdo_connect() {
    global $hostname;
    global $username;
    global $password;
    global $dbname;
    global $dbport;
    try {
        $pdodb = new PDO( "mysql:host=" . $hostname . ";dbname=" . $dbname, $username, $password );
        return $pdodb;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
}

function getUser( $id ) {
    global $userTable;
    $query = "select * from " . $userTable . " where id=$id";
    $dataSet = executeQuery( $query );
    return $dataSet;
}

function getUserByEmail( $email ) {
    global $userTable;
    $pdb        = pdo_connect();
    $checkQuery = "SELECT * FROM $userTable where (emailaddress=:email)";
    $query      = $pdb -> prepare($checkQuery);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $results    = $query->fetchAll(PDO::FETCH_ASSOC);
    if ( $query->rowCount() > 0 || count( $results ) > 0 ) {
        $dataSet = reply( 200, $results );
    } else {
        $dataSet = reply( 200, array() );
    }
    return $dataSet;
}

function doLogin( $emailAddress, $password ) {
    global $userTable;
    $passHash   = new PasswordHash( 8, false );
    $pdb        = pdo_connect();
    $hashedPass = $passHash->HashPassword( $password );
    
    $checkQuery ="SELECT * FROM " . $userTable . " where (emailaddress=:email)";
    $query      = $pdb -> prepare( $checkQuery );
    $query->bindParam(':email',$emailAddress, PDO::PARAM_STR);
    $query->execute();
    $dataSet    = [];
    if( $query->rowCount() > 0 ) {
        //$res    = $query->fetch();
        $res    = $query->fetchAll( PDO::FETCH_ASSOC );
        $dbPass = (string) $res[0][ 'password' ];
        if ( !$passHash->CheckPassword( $password, $dbPass ) ) {
            $dataSet = reply( 400, array() );
        } else {
            $dataSet = reply( 200, $res );
        }
    } else {
        $dataSet = reply( 400, "Password doesn't match!" );
    }
    return $dataSet;
}

function createUser( $data ) {
    global $userTable;
    $passHash   = new PasswordHash( 8, false );
    $pdb        = pdo_connect();
    $email      = $data[ 'emailaddress' ];
    $password   = $passHash->HashPassword( $data[ 'password' ] );
    $firstname  = $data[ 'firstname' ];
    $lastname   = $data[ 'lastname' ];

    $checkQuery = "SELECT * FROM " . $userTable . " where (emailaddress=:email)";
    $query      = $pdb -> prepare($checkQuery);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $results    = $query->fetchAll(PDO::FETCH_ASSOC);
    if ( $query->rowCount() > 0 || count( $results ) > 0 ) {
        $dataSet = reply( 400, "User exists" );
        return $dataSet;
    }
    try {
        $sql   = "INSERT INTO " . $userTable . " ( emailaddress, password, firstname, lastname ) VALUES( :email, :password, :firstname, :lastname )";
        $query = $pdb->prepare($sql);
        $query->bindParam(':email',     $email, PDO::PARAM_STR );
        $query->bindParam(':password',  $password, PDO::PARAM_STR );
        $query->bindParam(':firstname', $firstname, PDO::PARAM_STR );
        $query->bindParam(':lastname',  $lastname, PDO::PARAM_STR );
        $query->execute();
    } catch (PDOException $e) {
        $dataSet = reply( $e->getCode(), $e->getMessage() );
        return $dataSet;
    }
    
    $lastInsertId = $pdb->lastInsertId();
    if ( !$lastInsertId ) {
        $dataSet = reply( 401, "Error creating account" );
        return $dataSet;
    }
    $getQuery ="SELECT * FROM " . $userTable . " where id = $lastInsertId";
    $dataSet = executeQuery( $getQuery );
    return $dataSet;
}

function deleteUser( $id ) {
    global $userTable;
    $db         = connect();
    $checkQuery = "SELECT * FROM " . $userTable . " where id = $id";
    $result     = $db->query( $checkQuery, MYSQLI_ASSOC );
    if( is_array( $result ) && count( $result ) == 0 ) {
        return false;
    }
    $query      = "delete from " . $userTable . " where id = $id";
    $dataSet    = executeQuery($query);
    return $dataSet;
}

function getAllUsers() {
    global $userTable;
    $sql = "select * from " . $userTable;
    $dataSet = executeQuery( $sql );
    return $dataSet;
}

function getAllRows() {
    global $tablename;
    $query = "select * from " . $tablename . " ORDER BY websiteSort ASC";
    $dataSet = executeQuery($query);
    return $dataSet;
}

function getRowByID($id) {
    global $tablename;
    $query = "select * from " . $tablename . " where websiteID=" . $id;
    $dataSet = executeQuery($query);
    return $dataSet;
}

function getRowByWhere($field, $value) {
    global $tablename;
    $query = "select * from " . $tablename . " where " . $field . "=" . $value;
    $dataSet = executeQuery($query);
    return $dataSet;
}

function getLinks() {
    global $tablename;
    $query = "SELECT * from " . $tablename . " ORDER BY websiteSort ASC";
    $dataSet = executeQuery($query);
    return $dataSet;
}

function getMax() {
    global $tablename;
    $query = "SELECT MAX(websiteSort) as max from " . $tablename;
    $dataSet = executeQuery($query);
    return $dataSet;
}

function saveData($text, $url) {
    global $tablename;
    $encodedURL = urlencode($url);
    $query = "INSERT INTO " . $tablename . " (`websiteID`, `websiteText`, `websiteURL`) VALUES (NULL, \"" . $text . "\", \"" . $encodedURL . "\")";
    $dataSet = executeQuery($query);
    return $dataSet;
}

function deleteData($id) {
    global $tablename;
    $query = "DELETE FROM " . $tablename . " WHERE `websiteID` = " . $id;
    $dataSet = executeQuery($query);
    return $dataSet;
}

function updateData($id, $field, $value) {
    global $tablename;
    $query = "UPDATE " . $tablename . " SET `" . $field . "` = '" . $value . "' WHERE `websiteID` = " . $id;
    $dataSet = executeQuery($query);
    return $dataSet;
}

function updateAll( $id, $data ) {
    global $tablename;
    $websiteText = $data[ 'websiteText' ];
    $websiteURL  = urlencode( $data[ 'websiteURL' ] ); 
    $set = "SET `websiteText` = '" . $websiteText . "', `websiteURL` = '" . $websiteURL . "'";
    $query = "UPDATE " . $tablename . " $set WHERE `websiteID` = $id";
    $dataSet = executeQuery($query);
    return $dataSet;
}

///////////////// DB Functions

function doQuery( $query ) {
    $result = executeQuery( $query );
    if ( $result[ 'code' ] === 200 ) {
        return true;
    }
    return false;
}
    
function executeQuery( $query ) {
    $dataSet = [
        'code' => 0,
        'response' => []
    ];
    
    $pdb     = pdo_connect();
    $query   = $pdb->prepare( $query );
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    if ( $query->errorCode() !== "00000" ) {
        if ( $query->errorCode() !== "HY000" ) {
            $dataSet = reply( $query->errorCode(), $query->errorInfo() );
        } else {
            $dataSet = reply( 200, true );
        }
    } else {
        if ( $query->rowCount() > 0 || count( $results ) > 0 ) {
            $dataSet = reply( 200, $results );
        } else {
            $dataSet = reply( 200, true );
        }
    }
    return $dataSet;
}

///////////////// Config Functions

function readConfig( $filename ) {
    global $hostname;
    global $username;
    global $password;
    global $dbname;
    global $dbport;
    global $tablename;

    if ( !file_exists( $filename ) ) {
        return false;
    }
    $xml=simplexml_load_file( $filename );
    $dbname     = (String) $xml->dbname;
    $username   = (String) $xml->username;
    $password   = (String) $xml->password;
    $hostname   = (String) $xml->host;
    $dbport     = (String) $xml->port;
    $tablename  = (String) $xml->tablename;
    return true;
}

///////////////// General Functions

function reply( $code, $response, $json = false ) {
    $dataSet = [
        'code' => $code,
        'response' => $response,
    ];
    if ( $json ) {
        echo json_encode( $dataSet );
        exit;
    }
    return $dataSet;
}
