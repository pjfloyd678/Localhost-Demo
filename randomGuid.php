<?php
function uniqueGuid( $size = 16 ) {
    if ( $size !== 16 && $size !== 32 ) {
        echo( 'Size must be either 16 or 32' );
        die( -1 );
    }
    //generate $size number of bits
    //$data = openssl_random_pseudo_bytes( $size ); // for php 5
    $data = random_bytes( $size ); // for php 7

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

$myGuid = uniqueGuid();
echo $myGuid . PHP_EOL;

$newGuid = uniqueGuid( 32 );
echo $newGuid . PHP_EOL;

$guid = uniqueGuid( 32 );
echo $guid . PHP_EOL;
