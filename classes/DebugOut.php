<?php

class Debug_Out {

    /**
     * debugOut( $result, $heading = "DEBUG OUTPUT" )
     *
     * @param Array $result This is the values that need to be outputted
     * @param [type] $heading (Optional) This is the heading
     * @return void
     */
    public static function printToScreen( $result, $heading = "DEBUG OUTPUT" ) {
		if ( defined( 'DEBUG' ) && DEBUG ) {
            echo( "<h3>" . $heading . "</h3>" . PHP_EOL );
            echo( "<pre>" );
            print_r( $result );
            echo( "</pre>" . PHP_EOL );
        }
    }
}
