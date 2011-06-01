<?php

require_once 'classes/util/VarProfile.php';

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * VarProfile unit tests.
 */
class VarProfileTest extends PHPUnit_Framework_TestCase
{
    ///////////   bool   /////////////
    
    public function testBool_numElements()
    {
        $var = true;
        $intProf = new VarProfile($var);
        $this->assertEquals(1, $intProf->getTotalNumElements());
    }
    
    public function testBool_ownSize()
    {
        $var = true;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(0, $intProf->getOwnSize());
        $this->assertLessThan(10, $intProf->getOwnSize());
    }
    
    public function testBool_totalSize()
    {
        $var = true;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(0,  $intProf->getTotalSize());
        $this->assertLessThan(10, $intProf->getTotalSize());
    }
    
    public function testBool_children()
    {
        $var = true;
        $intProf = new VarProfile($var);
        $this->assertNotNull($intProf->getChildren());
        $this->assertEquals(0, count($intProf->getChildren()));
    }
    
    
    ///////////   int   /////////////
    
    public function testInteger_numElements()
    {
        $var = 3;
        $intProf = new VarProfile($var);
        $this->assertEquals(1, $intProf->getTotalNumElements());
    }
    
    public function testInteger_ownSize()
    {
        $var = 3;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(0, $intProf->getOwnSize());
        $this->assertLessThan(10, $intProf->getOwnSize());
    }
    
    public function testInteger_totalSize()
    {
        $var = 3;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(0,  $intProf->getTotalSize());
        $this->assertLessThan(10, $intProf->getTotalSize());
    }
    
    public function testInteger_children()
    {
        $var = 3;
        $intProf = new VarProfile($var);
        $this->assertNotNull($intProf->getChildren());
        $this->assertEquals(0, count($intProf->getChildren()));
    }
    
    
    ///////////   very large int => gets converted to larger data type: float   /////////////
    
    public function testLargeInt_numElements()
    {
        $var = 5000000000;
        $intProf = new VarProfile($var);
        $this->assertEquals(1, $intProf->getTotalNumElements());
    }
    
    public function testLargeInt_ownSize()
    {
        $var = 5000000000;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(6, $intProf->getOwnSize());
        $this->assertLessThan(20, $intProf->getOwnSize());
    }
    
    public function testLargeInt_totalSize()
    {
        $var = 5000000000;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(6,  $intProf->getTotalSize());
        $this->assertLessThan(20, $intProf->getTotalSize());
    }
    
    public function testLargeInt_children()
    {
        $var = 5000000000;
        $intProf = new VarProfile($var);
        $this->assertNotNull($intProf->getChildren());
        $this->assertEquals(0, count($intProf->getChildren()));
    }
    
    
    ///////////   float   /////////////
    
    public function testFloat_numElements()
    {
        $var = 5.5;
        $intProf = new VarProfile($var);
        $this->assertEquals(1, $intProf->getTotalNumElements());
    }
    
    public function testFloat_ownSize()
    {
        $var = 5.5;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(6, $intProf->getOwnSize());
        $this->assertLessThan(20, $intProf->getOwnSize());
    }
    
    public function testFloat_totalSize()
    {
        $var = 5.5;
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(6,  $intProf->getTotalSize());
        $this->assertLessThan(20, $intProf->getTotalSize());
    }
    
    public function testFloat_children()
    {
        $var = 5.5;
        $intProf = new VarProfile($var);
        $this->assertNotNull($intProf->getChildren());
        $this->assertEquals(0, count($intProf->getChildren()));
    }
    
    
    ///////////   string   /////////////
    
    public function testString_numElements()
    {
        $var = 'my string';
        $intProf = new VarProfile($var);
        $this->assertEquals(1, $intProf->getTotalNumElements());
    }
    
    public function testString_ownSize()
    {
        $var = 'my string';
        $intProf = new VarProfile($var);
        $this->assertEquals(strlen($var), $intProf->getOwnSize());
    }
    
    public function testString_totalSize()
    {
        $var = 'my string';
        $intProf = new VarProfile($var);
        $this->assertEquals(strlen($var), $intProf->getTotalSize());
    }
    
    public function testString_children()
    {
        $var = 'my string';
        $intProf = new VarProfile($var);
        $this->assertNotNull($intProf->getChildren());
        $this->assertEquals(0, count($intProf->getChildren()));
    }
    

    ///////////   empty array   /////////////
    
    public function testEmptyArray_numElements()
    {
        $var = array();
        $intProf = new VarProfile($var);
        $this->assertEquals(1, $intProf->getTotalNumElements());
    }
    
    public function testEmptyArray_ownSize()
    {
        $var = array();
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(0, $intProf->getOwnSize());
        $this->assertLessThan(10, $intProf->getOwnSize());
    }
    
    public function testEmptyArray_totalSize()
    {
        $var = array();
        $intProf = new VarProfile($var);
        $this->assertGreaterThan(0, $intProf->getTotalSize());
        $this->assertLessThan(10, $intProf->getTotalSize());
    }
    
    public function testEmptyArray_children()
    {
        $var = array();
        $intProf = new VarProfile($var);
        $this->assertNotNull($intProf->getChildren());
        $this->assertEquals(0, count($intProf->getChildren()));
    }
    

    ///////////   TODO - array with one element   /////////////
    

    ///////////   TODO - array with hundred elements   /////////////
    

    ///////////   TODO - array with one level of nesting   /////////////
    
    
    ///////////   TODO - array with two levels of nesting   /////////////
    
    
    ///////////   getName()   /////////////
        
    public function testGetName_scalar_noNameGiven()
    {
        $var = 3;
        $prof = new VarProfile($var);
        $this->assertNotNull($prof->getName());
    }
    
    public function testGetName_scalar_nameGiven()
    {
        $name = 'A Name';
        $var = 3;
        $prof = new VarProfile($var, $name);
        $this->assertEquals($name, $prof->getName());
    }
}

