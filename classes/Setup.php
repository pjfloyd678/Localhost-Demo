<?php

class Setup {
    
    private $dbname = "";
    private $username = "";
    private $password = "";
    private $hostname = "";
    private $dbport = 0;
    private $tablename = "";
    
    public function __construct() {
        
    }
    
    public static function setData( $arrayData ) {
        $this->dbname    = $arrayData[ 'dbname' ];
        $this->username  = $arrayData[ 'username' ];
        $this->password  = $arrayData[ 'password' ];
        $this->hostname  = $arrayData[ 'hostname' ];
        $this->dbport    = $arrayData[ 'dbport' ];
        $this->tablename = $arrayData[ 'tablename' ];
    }

    /**
     * saveXMLFile()
     * @todo Create new XML file.
     * @return Boolean Was the file saved?
     */
    public static function saveXMLFile() {
        return true;
    }
    
    /**
     * updateSQLfile( $sqlFilename )
     * @todo Open SQL File
     * @todo Update variables
     * @param String $sqlFilename Name of the SQL file
     * @return boolean
     */
    public static function updateSQLfile( $sqlFilename ) {
        return true;
    }
}
