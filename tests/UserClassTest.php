<?php

use PHPUnit\Framework\TestCase;

require_once (__DIR__ . '\..\classes\User.php');

class UserClassTest extends TestCase {
    
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
            $found = [];
            if ( !empty( $found ) ) {
                foreach( $result2 as $user ) {
                    var_dump( $user );
                    if ( $user[ 'emailaddress' ] === $data[ 'emailaddress' ] ) {
                        array_push( $found, $user );
                    }
                }
            }
            $this->assertEmpty( $found, "Test user still exists!" );
        }
    }
}
