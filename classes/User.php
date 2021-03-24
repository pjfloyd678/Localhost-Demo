<?php

/**
 * This is the User Class
 * It takes care of user login, logout, register and other administrative tasks
 * @author pfloyd
 */

require_once __DIR__ . '/../configs/application_config.php';
require_once __DIR__ . '/../classes/dbConnect.php';

class User {
    
    public function get( $id = 0 ) {
        $db = new dbConnect();
        if ( $id > 0 ) {
            return $db->getUser( $id );
        } else {
            return $db->getAllUsers();
        }
    }

    public function getByEmail( $emailAddress ) {
        $db     = new dbConnect();
        $result = $db->getUserByEmail( $emailAddress );
        return $result;
    }

    public function login( $emailAddress, $password ) {
        $db     = new dbConnect();
        $result = $db->doLogin( $emailAddress, $password );
        return $result;
    }

    public function getAll() {
        $db = new dbConnect();
        $result = $db->getAllUsers();
        return $result;
    }
    
    public function update( $id, $updateData ) {
        $db = new dbConnect();
        $result = $db->updateAll( $id, $updateData );
        return $result;
    }

    public function create( $data ) {
        $db = new dbConnect();
        $user = $db->createUser( $data );
        return $user;
    }
    
    public function delete( $id ) {
        $db = new dbConnect();
        $result = $db->deleteUser( $id );
        return $result;
    }
}
