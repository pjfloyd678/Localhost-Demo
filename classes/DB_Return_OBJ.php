<?php

/**
 * DB_Return_OBJ Class
 */
class DB_Return_OBJ {
    private $result;
    private $data;
    private $code;
    private $message;
    private $fatal;
    /**
     * __construct()
     */
    function __construct()
    {
        $this->result  = FALSE;
        $this->data    = [];
        $this->code    = 0;
        $this->message = [];
        $this->fatal   = FALSE;
    }
    /**
     * set( $result, $code, $message )
     * @param Boolean $result
     * @param Integer $code
     * @param String $message
     * @return void
     */
    public function set( $result, $data = [], $code = 0, $message = [], $fatal = FALSE ) {
        $this->result  = $result;
        $this->data    = $data;
        $this->code    = $code;
        $this->message = $message;
        $this->fatal   = $fatal;
    }
    /**
     * setResult( $result )
     * @param Boolean $result
     * @return void
     */
    public function setResult( $result ){
        $this->result = $result;
    }
    /**
     * setData( $data )
     * @param Array $data
     * @return void
     */
    public function setData( $data ) {
        $this->data = $data;
    }
    /**
     * setCode( $code )
     * @param Integer $code
     * @return void
     */
    public function setCode( $code ) {
        $this->code = $code;
    }
    /**
     * setMessage( $message )
     * @param String $message
     * @return void
     */
    public function setMessage( $message ){
        $this->message[] = $message;
    }

    public function setFatal( $fatal ){
        $this->fatal = $fatal;
    }
    /**
     * get()
     * @return Array This is an array of result data
     */
    public function get() {
        $arr_result = [
            'result'  => $this->result,
            'data'    => $this->data,
            'code'    => $this->code,
            'message' => $this->message,
            'fatal'   => $this->fatal,
        ];
        return $arr_result;
    }
}
