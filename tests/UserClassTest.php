<?php

use PHPUnit\Framework\TestCase;

require_once (__DIR__ . '\..\classes\User.php');

class UserClassTest extends TestCase {

    /**
     * testUser()
     * This tests adding a user.
     * @return void
     */
    public function testUser(): void {
        $user = new User();
        $data = [
            'emailaddress' => 'peterjfloyd+testing@gmail.com',
            'password' => 'dAY9&8aWX7^HRPwa',
            'firstname' => 'Peter',
            'lastname' => 'Floyd'
        ];

        $newUser = $user->create( $data );
        $this->assertEquals( 200, $newUser['code'], 'Create failed!' );

        if ( $newUser[ 'code' ] === 200 ) {
            $id = intval( $newUser[ 'response' ][ 0 ][ 'id' ] );
            $result1 = $user->delete( $id );
            $this->assertEquals( 200, $result1[ 'code'], "Delete failed!" );

            $result2 = $user->getAll();
            $users   = (array) $result2[ 'response' ];
            $found = [];
            if ( !empty( $users ) ) {
                foreach( $users as $user ) {
                    if ( $user[ 'emailaddress' ] === $data[ 'emailaddress' ] ) {
                        array_push( $found, $user );
                    }
                }
            }
            $this->assertEmpty( $found, "Test user still exists!" );
        }
    }

    /**
     * testUserPass()
     * This function tests the user password function.
     * @return void
     */
    public function testUserPass(): void {
        $user = new User();
        $data = [
            'emailaddress' => 'peterjfloyd+testingpass@gmail.com',
            'password' => 'dAY9&8aWX7^HRPwa',
            'firstname' => 'Peter',
            'lastname' => 'Floyd'
        ];

        $newUser = $user->create( $data );
        $this->assertEquals( 200, $newUser['code'], 'Create failed!' );

        if ( $newUser[ 'code' ] === 200 ) {
            $res = $user->login( $data[ 'emailaddress' ], $data[ 'password' ] );
            if ( $res[ 'code' ] === 200 ) {
                $arrCount = (array) $res[ 'response' ];
                $ct       = count( $arrCount );
                $this->assertEquals( 1, $ct, 'login failed - wrong count' );

                $id = intval( $res[ 'response' ][ 0 ][ 'id' ] );
                $result1 = $user->delete( $id );
                $this->assertEquals( 200, $result1[ 'code'], "Delete failed!" );
    
                $result2 = $user->getAll();
                $users   = (array) $result2[ 'response' ];
                $found = [];
                if ( !empty( $users ) ) {
                    foreach( $users as $user ) {
                        if ( $user[ 'emailaddress' ] === $data[ 'emailaddress' ] ) {
                            array_push( $found, $user );
                        }
                    }
                }
                $this->assertEmpty( $found, "Test user still exists!" );
            }
        }
    }
}
