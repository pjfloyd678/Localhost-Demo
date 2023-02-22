<?php

    class ClassAutoloader {
        public function __construct() {
            spl_autoload_register(array($this, 'loader'));
        }
        private function loader($className) {
            echo 'Trying to load ', $className, ' via ', __METHOD__, "()<br/>\n";
            include $className . '.php';
        }
    }

    $autoloader = new ClassAutoloader();

    $obj1 = new Class1();
    $obj1->myFunction( "CLASS1 rocks!" );
    $obj2 = new Class2();
    $obj2->myFunction( "CLASS2 is Da Bomb!");
    
