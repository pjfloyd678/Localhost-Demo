<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Description of db
 *
 * @author peter.floyd
 */
class dbConnect {
    
    static $DBNAME    = "test";
    static $USER      = "root";
    static $PASSWORD  = "hgttg42";
    static $HOST      = "localhost";
    static $PORT      = 3306;
    static $TABLENAME = "sites";
    
    private static function connect() {
        $mysqli = new mysqli(self::$HOST, self::$USER, self::$PASSWORD, self::$DBNAME, self::$PORT);
        
        if ($mysqli->connect_error) {
            die("Connection Failed: " . $conn->connect_errno);
        }
        return $mysqli;
    }
    
    private static function executeQuery($query) {
        $dataSet = [
            'code' => 0,
            'response' => []
        ];
        
        $connect = self::connect();
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
        
        $query = "select * from " . self::$TABLENAME . " ORDER BY websiteSort ASC";
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function getRowByID($id) {
        $query = "select * from " . self::$TABLENAME . " where websiteID=" . $id;
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function getRowByWhere($field, $value) {
        $query = "select * from " . self::$TABLENAME . " where " . $field . "=" . $value;
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function getLinks() {
        $query = "SELECT * from " . self::$TABLENAME . " ORDER BY websiteSort ASC";
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function getMax() {
        $query = "SELECT MAX(websiteSort) as max from " . self::$TABLENAME;
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function saveData($text, $url) {
        $encodedURL = urlencode($url);
        $query = "INSERT INTO " . self::$TABLENAME . " (`websiteID`, `websiteText`, `websiteURL`) VALUES (NULL, \"" . $text . "\", \"" . $encodedURL . "\")";
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function deleteData($id) {
        $query = "DELETE FROM " . self::$TABLENAME . " WHERE `websiteID` = " . $id;
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public static function updateData($id, $field, $value) {
        $query = "UPDATE " . self::$TABLENAME . " SET `" . $field . "` = '" . $value . "' WHERE `websiteID` = " . $id;
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
    
    public function updateAll( $id, $data ) {
        $websiteText = $data[ 'websiteText' ];
        $websiteURL  = urlencode( $data[ 'websiteURL' ] ); 
        $set = "SET `websiteText` = '" . $websiteText . "', `websiteURL` = '" . $websiteURL . "'";
        $query = "UPDATE " . self::$TABLENAME . " $set WHERE `websiteID` = $id";
        $dataSet = self::executeQuery($query);
        return $dataSet;
    }
}
