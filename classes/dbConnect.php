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
    
    public function __construct( $filename ) {
        if ( ! $this->readConfig( $filename ) ) {
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
