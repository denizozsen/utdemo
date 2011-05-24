<?php

echo "HIIIIIIIIIIIIIII";

set_include_path(get_include_path() . ':../../..');

require_once 'PHPUnit/Framework/TestCase.php';

//require_once 'includes/application_top.php';
require_once 'includes/functions/database.php';

// Set up db connection (note: this unit test is meant to run locally)
tep_db_connect('localdb', 'root', '', 'hoffmann-unittest');

require_once 'includes/classes/ShippingAddressUtil.php';

/**
 * ShippingAddressUtil test case.
 */
class ShippingAddressUtilTest extends PHPUnit_Framework_TestCase
{
    const TEST_CUSTOMER_NO        = '11111111';
    const TEST_CUSTOMER_DIM1      = 'TEST_DIM1';
    const TEST_CONTACT_NO         = '11111112';
    const TEST_OTHER_CONTACT1_NO  = '11111113';
    const TEST_OTHER_CONTACT2_NO  = '11111114';
    
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        
        // Set up constants to satisfy database.php
        define('SITE_MODE','DEV');
                
        // Init db to a known state
        $this->prepareDb();
    }
    
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO - reset db to clean state, if necessary
    }
    
    private function prepareDb()
    {
        // Ensure test customer exists and has correct data
//        tep_db_query(
//        	'INSERT INTO customer VALUES()
//        		ON DUPLICATE KEY UPDATE ');

        // TODO - Ensure test contact exists and has correct data
        // TODO - Ensure test ship_to_address exists and has correct data
    }
    
    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }
    
    /**
     * Tests ShippingAddressUtil::parseCodeContactDim()
     */
    public function testEncodeShippingAddressIdAndParseCodeContactDim()
    {
        $testResult =
        $testRow = tep_db_fetch_array();

        $this->encodeAndDecodeAndAssertEqual('MyDim1Code', 'WS1234567', 'ALT123');
    }
    
    /**
     * Tests ShippingAddressUtil::retrieveCustomerAddress()
     */
    public function testRetrieveCustomerAddress()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testRetrieveCustomerAddress()
        $this->markTestIncomplete(
        "retrieveCustomerAddress test not implemented");

//        ShippingAddressUtil::retrieveCustomerAddress(/* parameters */);
    }
    
    /**
     * Tests ShippingAddressUtil::retrieveShipToAddressById()
     */
    public function testRetrieveShipToAddressById()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testRetrieveShipToAddressById()
        $this->markTestIncomplete(
        "retrieveShipToAddressById test not implemented");

//        ShippingAddressUtil::retrieveShipToAddressById(/* parameters */);
    }
    
    /**
     * Tests ShippingAddressUtil::retrieveShipToAddress()
     */
    public function testRetrieveShipToAddress()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testRetrieveShipToAddress()
        $this->markTestIncomplete(
        "retrieveShipToAddress test not implemented");

//        ShippingAddressUtil::retrieveShipToAddress(/* parameters */);
    }
    
    /**
     * Tests ShippingAddressUtil::retrieveShipToAddressWithCountryDetails()
     */
    public function testRetrieveShipToAddressWithCountryDetails()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testRetrieveShipToAddressWithCountryDetails()
        $this->markTestIncomplete(
        "retrieveShipToAddressWithCountryDetails test not implemented");

//        ShippingAddressUtil::retrieveShipToAddressWithCountryDetails(/* parameters */);
    }
    
    /**
     * Tests ShippingAddressUtil::shipToAddressExists()
     */
    public function testShipToAddressExists()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testShipToAddressExists()
        $this->markTestIncomplete(
        "shipToAddressExists test not implemented");

//        ShippingAddressUtil::shipToAddressExists(/* parameters */);
    }
    
    /**
     * Tests ShippingAddressUtil::retrieveShipToAddressCount()
     */
    public function testRetrieveShipToAddressCount()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testRetrieveShipToAddressCount()
        $this->markTestIncomplete(
        "retrieveShipToAddressCount test not implemented");

//        ShippingAddressUtil::retrieveShipToAddressCount(/* parameters */);
    }
    
    /**
     * Tests ShippingAddressUtil::retrieveAllShipToAddresses()
     */
    public function testRetrieveAllShipToAddresses()
    {
        // TODO Auto-generated ShippingAddressUtilTest::testRetrieveAllShipToAddresses()
        $this->markTestIncomplete(
        "retrieveAllShipToAddresses test not implemented");

//        ShippingAddressUtil::retrieveAllShipToAddresses(/* parameters */);
    }
    
/////////////////////////////////////////////////

    //
    // Utility functions
    //

    private function encodeAndDecodeAndAssertEqual($originalDim1, $originalContactNo, $originalCode)
    {
        // Encode
        $encoded = ShippingAddressUtil::encodeShippingAddressId(
            $originalDim1, $originalContactNo, $originalCode);

        // Decode
        list($decodedCode, $decodedContactNo, $decodedDim1) =
            ShippingAddressUtil::parseCodeContactDim($encoded);

        // Check that decoded values are the same as the original ones
        $this->assertEquals($originalCode, $decodedCode);
        $this->assertEquals($originalContactNo, $decodedContactNo);
        $this->assertEquals($originalDim1, $decodedDim1);
    }
}

