<?php

class Class1 {
    public function myFunction(String $for_out) {
        echo ( "From " . __FUNCTION__ . ": " . $for_out . "<br/>" . PHP_EOL );
    }
}
