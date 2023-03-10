<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once __DIR__ . '/../configs/application_config.php';
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/PasswordHash.php';

if ( ! session_status() ) {
    session_start();
}

$cUser = new User();
$passHash = new PasswordHash( 8, false );

if ( !empty( $_POST ) ) {
    $e    = filter_input( INPUT_POST, "emailaddress" );
    $p    = filter_input( INPUT_POST, "password" );
    $data = $cUser->getByEmail( $e );
    if ( isset( $data[ 'response' ][ 0 ] ) ) {
        $r    = $data[ 'response' ][ 0 ];
        if ( empty( $r ) === 0 ) {
            // Invalid User - Error!
            echo "Invalid User - Bad Email!";
            die(1);
        }
        $user = $data[ 'response' ][ 0 ];
        if ( $user[ 'emailaddress' ] === $e ) {
            $check = $passHash->CheckPassword( $p, $user[ 'password' ] );
            if ( !$check ) {
                // Invalid Password - Error
                echo "Invalid User - Bad Password!";
                die(1);
            }
            // Valid Email and Password - Continue
            $_SESSION[ 'loggedIn' ] = true;
            $token = uniqid();
            $_SESSION[ 'token' ]    = $token;
            redirect("index.php");
            exit();
        }
    } else {
        echo "Invalid User - User not found";
        die(1);
    }
}
echo "Cannot process - No Post Data";
die(1);
