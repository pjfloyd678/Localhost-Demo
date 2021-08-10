<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/User.php';

class Setup {
    
    private $dbname = "";
    private $username = "";
    private $password = "";
    private $hostname = "";
    private $dbport = 0;
    private $tablename = "";

    public function __construct() {
        
    }
    
    public function setData( $arrayData ) {
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
    public function saveXMLFile() {

        $dom                = new DOMDocument();
        $dom->encoding      = 'utf-8';
        $dom->xmlVersion    = '1.0';
        $dom->formatOutput  = true;
        $xml_file_name      = 'dbconfig.xml';

        $root = $dom->createElement( "root" );
        $dom->appendChild( $root );

        $child_node_dbname = $dom->createElement( 'dbname', $this->dbname );
        $root->appendChild( $child_node_dbname );

        $child_node_username = $dom->createElement( 'username', $this->username );
        $root->appendChild( $child_node_username );

        $child_node_password = $dom->createElement( 'password', $this->password );
        $root->appendChild( $child_node_password );

        $child_node_hostname = $dom->createElement( 'host', $this->hostname );
        $root->appendChild( $child_node_hostname );

        $child_node_port = $dom->createElement( 'port', $this->dbport );
        $root->appendChild( $child_node_port );

        $child_node_tablename = $dom->createElement( 'tablename', $this->tablename );
        $root->appendChild( $child_node_tablename );

        $result = $dom->save( __DIR__ . "/../configs/" . $xml_file_name );

        return true;
    }

    public function updateApplicationConfig( $httpHost ) {
        // Open File
        $defaultFile = __DIR__ . "/../configs/application_config_default.php";
        $contents = file( $defaultFile );
        // Replace text in file
        $findThis = '[[HTTPHOST]]';
        $contents = str_replace( $findThis, $httpHost, $contents );
        // Write new application_config.php file
        $newFile = __DIR__ . "/../configs/application_config.php";
        $fp = fopen( $newFile, 'w' );
        foreach( $contents as $line ) {
            fwrite( $fp, $line );
        }
        fclose( $fp );

        if ( file_exists( $newFile ) ) {
            return true;
        }
        return false;
    }
    
    /**
     * updateSQLfile( $sqlFilename )
     * @todo Open SQL File
     * @todo Update variables
     * @param String $sqlFilename Name of the SQL file
     * @return boolean
     */
    public function updateSQLfile( $sqlFilename ) {

        require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';

        // Open File
        $defaultFile = __DIR__ . "/../data/create_tables_default.sql";
        $contents = file( $defaultFile );
        // Replace text in file
        $findDB = '[[DBNAME]]';
        $contents = str_replace( $findDB, $this->dbname, $contents );
        $findTable = '[[TABLENAME]]';
        $contents = str_replace( $findTable, $this->tablename, $contents );
        // Write new application_config.php file
        $newFile = __DIR__ . "/../data/create_tables.sql";
        $fp = fopen( $newFile, 'w' );
        foreach( $contents as $line ) {
            fwrite( $fp, $line );
        }
        fclose( $fp );

        return true;
    }

    public function executeSQL() {
        $sqlFile = __DIR__ . "/../data/create_tables.sql";
        $result = $this->run_sql_file( $sqlFile );
        if ( (int) $result[ 'success' ] > 7 ) {
            return true;
        }
    }

    private function run_sql_file( $location ) {

        require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';

        // Connect to DB
        $dbConnect = new dbConnect( DBCONFGFILE, false );

        //load file
        $commands = file_get_contents( $location );
    
        //delete comments
        $lines = explode( "\n", $commands );
        $commands = '';
        foreach( $lines as $line ) {
            $line = trim( $line );
            if( $line && !$this->startsWith( $line,'--' ) ) {
                $commands .= $line . "\n";
            }
        }
    
        //convert to array
        $commands = explode( ";", $commands );
    
        //run commands
        $total = $success = 0;
        foreach( $commands as $command ) {
            if( trim( $command ) ) {
                $success += ( $dbConnect->doQuery( $command, false ) === false ? 0 : 1 );
                $total += 1;
            }
        }
    
        //return number of successful queries and total number of queries found
        return array(
            "success" => $success,
            "total" => $total
        );
    }
    
    // Here's a startsWith function
    private function startsWith($haystack, $needle){
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    public function addUser( $username, $password ) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/configs/application_config.php';
        $data = [
            'emailaddress' => $username,
            'password'     => $password,
            'firstname'    => '',
            'lastname'     => '',
        ];
        // Connect to DB
        $dbConnect = new dbConnect( DBCONFGFILE );
        $result = $dbConnect->createUser( $data );
        if ( $result[ 'code' ] === 200 ) {
            return true;
        }
        return false;
    }
}
