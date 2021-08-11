<?php

define( "DBFILENAME", __DIR__ . "\..\configs\dbconfig.xml" );
require_once __DIR__ . '/../auth/PasswordHash.php';

/**
 * Description of db
 *
 * @author peter.floyd
 */
class dbConnect {
    
    public $dbname;
    public $username;
    public $password;
    public $hostname;
    public $dbport;
    public $tablename;

    public $pdodb;
    
    static $userTable = "user";
    
    public function __construct() {
        if ( ! $this->readConfig( DBFILENAME ) ) {
            die("Could not read config");
        }
    }
    
    private function connect( $connectToDB = true ) {
        if ( $connectToDB ) {
            $mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->dbname, (int) $this->dbport);
        } else {
            $mysqli = new mysqli( $this->hostname, $this->username, $this->password );
        }
        if ($mysqli->connect_error) {
            die('Connect Error (' . $mysqli->connect_errno . ') '
                    . $mysqli->connect_error);
        }
        return $mysqli;
    }
    
    private function pdo_connect() {
        try {
            $pdodb = new PDO( "mysql:host=" . $this->hostname . ";dbname=" . $this->dbname, $this->username, $this->password );
            return $pdodb;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function doQuery( $query ) {
        $result = $this->executeQuery( $query );
        if ( $result[ 'code' ] === 200 ) {
            return true;
        }
        return false;
    }
    
    public function executeQuery( $query ) {
        $dataSet = [
            'code' => 0,
            'response' => []
        ];
        
        $pdb     = $this->pdo_connect();
        $query   = $pdb->prepare( $query );
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if ( $query->errorCode() !== "00000" ) {
            if ( $query->errorCode() !== "HY000" ) {
                $dataSet = $this->reply( $query->errorCode(), $query->errorInfo() );
            } else {
                $dataSet = $this->reply( 200, true );
            }
        } else {
            if ( $query->rowCount() > 0 || count( $results ) > 0 ) {
                $dataSet = $this->reply( 200, $results );
            } else {
                $dataSet = $this->reply( 200, true );
            }
        }
        return $dataSet;
    }

    public function getUser( $id ) {
        $query = "select * from " . self::$userTable . " where id=$id";
        $dataSet = $this->executeQuery( $query );
        return $dataSet;
    }

    public function getUserByEmail( $email ) {

        $pdb        = $this->pdo_connect();
        $checkQuery ="SELECT * FROM " . self::$userTable . " where (emailaddress=:email)";
        $query      = $pdb -> prepare($checkQuery);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $results    = $query->fetchAll(PDO::FETCH_ASSOC);
        if ( $query->rowCount() > 0 || count( $results ) > 0 ) {
            $dataSet = $this->reply( 200, $results );
        } else {
            $dataSet = $this->reply( 200, array() );
        }
        return $dataSet;
    }

    public function doLogin( $emailAddress, $password ) {
        $passHash   = new PasswordHash( 8, false );
        $pdb        = $this->pdo_connect();
        $hashedPass = $passHash->HashPassword( $password );
        
        $checkQuery ="SELECT * FROM " . self::$userTable . " where (emailaddress=:email) and (password=:hpass)";
        $query      = $pdb -> prepare( $checkQuery );
        $query->bindParam(':email',$emailAddress, PDO::PARAM_STR);
        $query->bindParam(':hpass',$hashedPass,   PDO::PARAM_STR);
        $query->execute();
        $dataSet    = [];
        $results    = $query->fetchAll( PDO::FETCH_OBJ );
        if( $query->rowCount() > 0 ) {
            $res    = $query->fetch();
            if ( !$passHash->CheckPassword( $password, $res[ 'password' ] ) ) {
                $dataSet = $this->reply( 200, array() );
            } else {
                $dataSet = $this->reply( 200, $res );
            }
        }
        return $dataSet;
    }
    
    public function createUser( $data ) {
        $passHash   = new PasswordHash( 8, false );
        $pdb        = $this->pdo_connect();
        $db         = $this->connect();
        $email      = $data[ 'emailaddress' ];
        $password   = $passHash->HashPassword( $data[ 'password' ] );
        $firstname  = $data[ 'firstname' ];
        $lastname   = $data[ 'lastname' ];

        $checkQuery = "SELECT * FROM " . self::$userTable . " where (emailaddress=:email)";
        $query      = $pdb -> prepare($checkQuery);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->execute();
        $results    = $query->fetchAll(PDO::FETCH_ASSOC);
        if ( $query->rowCount() > 0 || count( $results ) > 0 ) {
            $dataSet = $this->reply( 400, "User exists" );
            return $dataSet;
        }
        try {
            $sql   = "INSERT INTO " . self::$userTable . " ( emailaddress, password, firstname, lastname ) VALUES( :email, :password, :firstname, :lastname )";
            $query = $pdb->prepare($sql);
            $query->bindParam(':email',     $email, PDO::PARAM_STR );
            $query->bindParam(':password',  $password, PDO::PARAM_STR );
            $query->bindParam(':firstname', $firstname, PDO::PARAM_STR );
            $query->bindParam(':lastname',  $lastname, PDO::PARAM_STR );
            $query->execute();
        } catch (PDOException $e) {
            $dataSet = $this->reply( $e->getCode(), $e->getMessage() );
            return $dataSet;
        }
        
        $lastInsertId = $pdb->lastInsertId();
        if ( !$lastInsertId ) {
            $dataSet = $this->reply( 401, "Error creating account" );
            return $dataSet;
        }
        $getQuery ="SELECT * FROM " . self::$userTable . " where id = $lastInsertId";
        $dataSet = $this->executeQuery( $getQuery );
        return $dataSet;
    }
    
    public function deleteUser( $id ) {

        $db         = $this->connect();
        $checkQuery = "SELECT * FROM " . self::$userTable . " where id = $id";
        $result     = $db->query( $checkQuery, MYSQLI_ASSOC );
        if( is_array( $result ) && count( $result ) == 0 ) {
            return false;
        }
        $query      = "delete from " . self::$userTable . " where id = $id";
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }

    public function getAllUsers() {
        $sql = "select * from " . self::$userTable;
        $dataSet = $this->executeQuery( $sql );
        return $dataSet;
    }

    public function getAllRows() {
        
        $query = "select * from " . $this->tablename . " ORDER BY websiteSort ASC";
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function getRowByID($id) {
        $query = "select * from " . $this->tablename . " where websiteID=" . $id;
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function getRowByWhere($field, $value) {
        $query = "select * from " . $this->tablename . " where " . $field . "=" . $value;
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function getLinks() {
        $query = "SELECT * from " . $this->tablename . " ORDER BY websiteSort ASC";
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function getMax() {
        $query = "SELECT MAX(websiteSort) as max from " . $this->tablename;
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function saveData($text, $url) {
        $encodedURL = urlencode($url);
        $query = "INSERT INTO " . $this->tablename . " (`websiteID`, `websiteText`, `websiteURL`) VALUES (NULL, \"" . $text . "\", \"" . $encodedURL . "\")";
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function deleteData($id) {
        $query = "DELETE FROM " . $this->tablename . " WHERE `websiteID` = " . $id;
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function updateData($id, $field, $value) {
        $query = "UPDATE " . $this->tablename . " SET `" . $field . "` = '" . $value . "' WHERE `websiteID` = " . $id;
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function updateAll( $id, $data ) {
        $websiteText = $data[ 'websiteText' ];
        $websiteURL  = urlencode( $data[ 'websiteURL' ] ); 
        $set = "SET `websiteText` = '" . $websiteText . "', `websiteURL` = '" . $websiteURL . "'";
        $query = "UPDATE " . $this->tablename . " $set WHERE `websiteID` = $id";
        $dataSet = $this->executeQuery($query);
        return $dataSet;
    }
    
    public function readConfig( $filename ) {
        if ( !file_exists( $filename ) ) {
            return false;
        }
        $xml=simplexml_load_file( $filename );
        $this->dbname = $xml->dbname;
        $this->username = $xml->username;
        $this->password = $xml->password;
        $this->hostname = $xml->host;
        $this->dbport = $xml->port;
        $this->tablename = $xml->tablename;
        return true;
    }

    private function reply( $code, $response, $json = false ) {
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
}
