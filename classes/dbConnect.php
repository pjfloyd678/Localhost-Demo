<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define( "DBFILENAME", __DIR__ . "\..\configs\dbconfig.xml" );

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
    
    private function connect() {
        $mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->dbname, (int) $this->dbport);
        
        if ($mysqli->connect_error) {
            die("Connection Failed: " . $conn->connect_errno);
        }
        return $mysqli;
    }
    
    private function pdo_connect() {
        try {
            $pdodb = new PDO( "mysql:host=" . $this->hostname . ";dbname=test", $this->username, $this->password );
            return $pdodb;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    private function executeQuery($query) {
        $dataSet = [
            'code' => 0,
            'response' => []
        ];
        
        $connect = $this->connect();
        $dbCommand = mysqli_query($connect, $query);
        
        if (!$dbCommand) {
            var_dump(mysqli_errno($connect));
            var_dump(mysqli_error($connect));
            $dataSet['code'] = mysqli_errno($connect);
            $dataSet['response'] = mysqli_error($connect);
            $connect->close();
            return $dataSet;
        }
        if (is_array($dbCommand) || is_object($dbCommand)) {
            $result = mysqli_fetch_all($dbCommand, MYSQLI_ASSOC);
            $dbCommand->free();
        } else {
            $result = $dbCommand;
        }
        $dataSet['code'] = '200';
        $dataSet['response'] = $result;
        $connect->close();
        return $dataSet;
    }

    public function getUser( $id ) {
        $query = "select * from " . self::$userTable . " where id=$id";
        $dataSet = $this->executeQuery( $query );
        return $dataSet;
    }
    
    public function createUser( $data ) {
        $pdb        = $this->pdo_connect();
        $email      = $data[ 'emailaddress' ];
        $password   = password_hash($data['password'], PASSWORD_DEFAULT);
        $firstname  = $data[ 'firstname' ];
        $lastname   = $data[ 'lastname' ];

        $checkQuery ="SELECT * FROM " . self::$userTable . " where (emailaddress=:email)";
        $check      = $pdb -> prepare($checkQuery);
        $check->bindParam(':email',$email,PDO::PARAM_STR);
        $check->execute();
        $results    = $check->fetchAll(PDO::FETCH_ASSOC);
        if ( $check->rowCount() > 0 || count( $results ) > 0 ) {
            var_dump( "User exists" );
            return false;
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
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
        
        $lastInsertId = $pdb->lastInsertId();
        if ( !$lastInsertId ) {
            var_dump( "Error creating account" );
            return false;
        }
        $getQuery ="SELECT * FROM " . self::$userTable . " where (id=:id)";
        $query    = $pdb -> prepare( $getQuery );
        $query->bindParam( ':id', intval( $lastInsertId ), PDO::PARAM_INT );
        $query->execute();
        $user = $query->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
    
    public function deleteUser( $id ) {

        $db         = $this->connect();
        $checkQuery = "SELECT * FROM " . self::$userTable . " where id = $id";
        $result     = $db->query( $checkQuery, MYSQLI_ASSOC );
        if( is_array( $result ) && count( $result ) == 0 ) {
            return false;
        }
        $sql       = "delete from " . self::$userTable . " where id = $id";
        $delResult = $db->query( $sql );
        return $delResult;
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
}
