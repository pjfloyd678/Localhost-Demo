<?php

/**
 * This is the User Class
 * It takes care of user login, logout, register and other administrative tasks
 * @author pfloyd
 */

require_once __DIR__ . '/../configs/application_config.php';
require_once __DIR__ . '/../db/dbConnect.php';

class User {
    
    public function get( $id = 0 ) {
        if ( $id > 0 ) {
            return getUser( $id );
        } else {
            return getAllUsers();
        }
    }

    public function getByEmail( $emailAddress ) {
        $result = getUserByEmail( $emailAddress );
        return $result;
    }

    public function login( $emailAddress, $password ) {
        $result = doLogin( $emailAddress, $password );
        return $result;
    }

    public function getAll() {
        $result = getAllUsers();
        return $result;
    }
    
    public function update( $id, $updateData ) {
        $result = updateAll( $id, $updateData );
        return $result;
    }

    public function create( $data ) {
        $user = createUser( $data );
        return $user;
    }
    
    public function delete( $id ) {
        $result = deleteUser( $id );
        return $result;
    }
}
