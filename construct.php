<?php

/**
 * myClass
 * @param String $securityKey Please provide the correct security key
 * @param Integer Provide the session ID
 */
class myClass {
    
    /**
     * sessionID
     * @var Integer This is the session ID
     */
    private $sessionID;
    
    /**
     * __construct
     *
     * @param  String $securityKey
     * @param  Integer $soi
     * @return void
     */
    public function __construct( $securityKey, $soi = -1 )
    {
        if ( $securityKey !== "password" ) {
            //throw new Exception( "Invalid Security Key!", 400 );
            print( "Invalid Security Key!" . PHP_EOL );
        } else {
            if ( $soi > 0 ) {
                $this->sessionID = $soi;
            } else {
                $this->sessionID = -1;
            }
        }
    }
    
    /**
     * reset
     * @return void
     */
    public function reset() {
        $this->sessionID = -1;
    }
    
    /**
     * setSessionID
     *
     * @param  Integer $soi
     * @return void
     */
    public function setSessionID( $soi ) {
        if ( $this->sessionID > 0 ) {
            //throw new Exception( "Session Key Already Set! Please reset first, if needed!", 401 );
            print( "Session Key Already Set! Please reset first, if needed!" . PHP_EOL );
        } else {
            if ( $soi > 0 ) {
                $this->sessionID = $soi;
            } else {
                $this->sessionID = -1;
            }
        }
    }


    /**
     * @return Integer
     */
    public function getSessionID() {
        if ( $this->sessionID < 0 ) {
            //throw new Exception( "Session Key Already Set! Please reset first, if needed!", 402 );
            print ( 'SessionID has not been set! ' . PHP_EOL );
        }
        return $this->sessionID;
    }
}

// $my = new myClass(); This will error. No parameters provided.
try {
    $my = new myClass( "password" ); // This will work but sessionID will equal -1
} catch( Exception $e ) {
    $e->getMessage();
}
$my->setSessionID( 10001 ); // Will work. Session ID is equal to -1. This will set it
print ( 'SessionID = ' . $my->getSessionID()  . PHP_EOL );
print( PHP_EOL );

try {
    $my2 = new myClass( "password", 10001 ); // This will work
} catch( Exception $e ) {
    $e->getMessage();
}
$my2->setSessionID( 20001 ); // This will throw an error
print ( 'SessionID = ' . $my2->getSessionID()  . PHP_EOL );
$my2->reset();
$my2->setSessionID( 20001 ); // This will work!
print ( 'SessionID = ' . $my2->getSessionID()  . PHP_EOL );
print( PHP_EOL );

try {
    $my3 = new myClass( "newpassword", 10001 );
} catch( Exception $e ) {
    $e->getMessage();
}
if (isset( $my3 ) ) { // not set if exception. set is not.
    $my3->setSessionID( 20001 ); // error if exception is executed. Works if not
    print ( 'SessionID = ' . $my3->getSessionID()  . PHP_EOL );
}
print( PHP_EOL );
