<?php

require_once( 'myClass.php' );

/**
 * [Description FooTest]
 */
class FooTest
{
    public static $my_static = 'foo';
    
    /**
     * staticValue
     *
     * @return void
     */
    public function staticValue() {
        print "inside FooTest::staticValue" . PHP_EOL;
        return self::$my_static;
    }
}

/**
 * Bar
 */
class Bar extends FooTest
{
    public function fooStatic() {
        print "Inside Bar::fooStatic" . PHP_EOL;
        return parent::$my_static;
    }

    public static function get() {
        print "Inside Bar::get" . PHP_EOL;
        return parent::$my_static;
    }
}

$my = new MyClass();

print FooTest::$my_static . PHP_EOL;

$foo = new FooTest();
print $foo->staticValue() . PHP_EOL;
//print $foo->my_static . PHP_EOL;      // Undefined "Property" my_static 

print "Outside: " . $foo::$my_static . PHP_EOL;
$classname = 'FooTest';
print "Outside: $classname - " . $classname::$my_static . PHP_EOL;

print "Outside: Access FooTest using Bar: " . Bar::$my_static . PHP_EOL;
$bar = new Bar();
print $bar->fooStatic() . PHP_EOL;
print Bar::get() . PHP_EOL;
