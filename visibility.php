<?php
/**
 * Define MyClass
 */
class MyClass
{
    public $public = 'MyClass::Public';
    protected $protected = 'MyClass::Protected';
    private $private = 'MyClass::Private';

    function printClassVariables()
    {
        echo "inside MyClass printClassVariables". PHP_EOL;
        echo $this->public. PHP_EOL;
        echo $this->protected. PHP_EOL;
        echo $this->private. PHP_EOL;
        $this->protectedClassVariables();
    }
    
    protected function protectedClassVariables() 
    {
        echo "inside MyClass protectedClassVariables". PHP_EOL;
        echo $this->public. PHP_EOL;
    }
}

$obj = new MyClass();
echo $obj->public. PHP_EOL; // Works
//echo $obj->protected. PHP_EOL; // Fatal Error
//echo $obj->private. PHP_EOL; // Fatal Error
$obj->printClassVariables(); // Shows Public, Protected and Private

/**
 * Define OtherClass
 */
class OtherClass extends MyClass
{
    // We can redeclare the public and protected properties, but not private
    public $public = 'OtherClass::Public2';
    protected $protected = 'OtherClass::Protected2';

    function printClassVariables()
    {
        echo "inside OtherClass printClassVariables". PHP_EOL;
        echo $this->public. PHP_EOL;
        echo $this->protected. PHP_EOL;
        //echo $this->private. PHP_EOL;
        $this->protectedClassVariables();
    }
    
    function printParent()
    {
        echo "inside OtherClass printParent". PHP_EOL;
        echo parent::printClassVariables(). PHP_EOL;
        echo $this->protectedClassVariables();
        
    }
}
echo PHP_EOL;
$obj2 = new OtherClass();
echo $obj2->public. PHP_EOL; // Works
//echo $obj2->protected. PHP_EOL; // Fatal Error
//echo $obj2->private. PHP_EOL; // Undefined
$obj2->printClassVariables(); // Shows Public2, Protected2, Undefined
echo PHP_EOL;
$obj2->printParent();
