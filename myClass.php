<?php

class myClass {
    private $ctr; 
    
    public function __construct() {
        $this->ctr = 1;
    }
    
    public function myPublicFunc() {
        echo 'myPublicFunc()<br/>';
        $this::myPSFunc();
    }
    public function myPSFunc() {
        $this->ctr = self::addCtr( $this->getCtr() );
        echo "inside myPSFunc - " . $this->getCtr() . "<br/>";
    }
        
    /**
     * getCtr
     *
     * @return void
     */
    public function getCtr() {
        return $this->ctr;
    }
    public function setCtr( $ctr ) {
        $this->ctr = $ctr;
    }
    
    public static function addCtr( $ctr ) {
        $ctr++;
        return $ctr;
    }
}

$c = new myClass();
$ctr = $c->getCtr();
echo "Outside - $ctr<br/>";
$c->setCtr( 10000 );
$ctr = $c->getCtr();
echo "Outside - $ctr<br/>";
$c->myPublicFunc();
$ctr = $c->getCtr();
echo "Outside - $ctr<br/>";
$c->myPSFunc();
