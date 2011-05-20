<?php

/**
 * Utility methods and constants related to Shipping Address functionsality.
 */
class ShippingAddressUtil
{
    const FLAG_MAIN                  =  1;
    const FLAG_ALT                   =  2;
    const FLAG_ALT_BY_ID             =  4;
    const FLAG_ALL_ALT               =  8;
    const FLAG_WITH_COUNTRY_DETAILS  = 16;
    
    const DEFAULT_ADDRESS_ID            = 'DEFAULT';
    const NEW_ADDRESS_ID                = 'address_new';
    const SHIPPING_ADDRESS_ID_SEPARATOR = '___&___';
    const SHIPPING_ADDRESS_FORMAT       = '%s___&___%s___&___%s';
    
    /**
     * Parses the code / contact no / global-dimension-1 from the given
     * shipping address ID, and returns them as an array, with the
     * elements ordered as mentioned above.
     *
     * @param unknown_type $shippingAddressId a shipping address ID
     */
    public static function parseCodeContactDim($shippingAddressId)
    {
        return explode(
            self::SHIPPING_ADDRESS_ID_SEPARATOR,
            $shippingAddressId);
    }
    
    /**
     * Encodes the given global-dimension-1, contact no and code as a
     * shipping address ID.
     *
     * @param unknown_type $globalDimension1 a global-dimension-1
     * @param unknown_type $contactNo a contact no
     * @param unknown_type $code a code
     */
    public static function encodeShippingAddressId($globalDimension1, $contactNo, $code)
    {
        return sprintf(self::SHIPPING_ADDRESS_FORMAT,
                       $code, $contactNo, $globalDimension1);
    }
        
    /**
     * Answers whether an alternative contact address entry exists for the
     * given contact no / code.
     *
     * @param string $contactNo a contact no
     * @param string $code a code
     */
    public static function alternativeContactAddressExists($contactNo, $code)
    {
		$countResult = tep_db_fetch_array(tep_db_query(
			"SELECT COUNT(1) AS total
				FROM contact_alt_address
				WHERE contact_no = '{$contactNo}'
					AND code = '{$code}'"));
        
		return (intval($countResult['total']) == 1);
    }
    
    /**
     * Retrieves the number of alternative contact address records for the
     * given contact no.
     *
     * @param string $contactNo a contact number
     */
    public static function retrieveAlternativeContactAddressCount($contactNo)
    {
        $count = tep_db_fetch_array(tep_db_query(
        	"SELECT COUNT(1) as count
        		FROM contact_alt_address
        		WHERE contact_no = '{$contactNo}'"));
        return intval($count['count']);
    }
    
    /**
     * Retrieves contact address(es), based on the given arguments.
     *
     * @param integer $flags combination of constants starting with FLAG_,
     *                       separated using binary OR, i.e. the | operator
     * @param string  $contactNoOrAddrId a contact no, or alt contact
     *                address id (optional), depending on the flags
     * @param string  $code an alternative contact address code (optional)
     */
    public static function retrieveContactAddress($flags, $contactNoOrAddrId = null, $code = null)
    {
        if ( is_null($flags) || !is_int($flags) ) {
            throw new Exception("Must specify at least one (integer-valued) flag. Specified: {$flags}");
        }
        
        // Make it possible to add to the SELECT, FROM and WHERE parts of queries
        $selectSuffix = '';
        $fromSuffix   = '';
        $whereSuffix  = '';
        
        // TODO - retrieveContactAddress(): does FLAG_WITH_COUNTRY_DETAILS actually return the required country details?
        // FLAG_WITH_COUNTRY_DETAILS: extend query to contain country details
        if ( ($flags & self::FLAG_WITH_COUNTRY_DETAILS) != 0 ) {
            $selectSuffix = '';
            $fromSuffix = 'INNER JOIN countries c
            	ON ((addr.country_code COLLATE latin1_danish_ci) = c.countries_iso_code_2)';
            $whereSuffix = '';
        }
        
        // FLAG_MAIN: return main addresses for the given contact no
        if ( ($flags & self::FLAG_MAIN) != 0 ) {

            if (null == $contactNoOrAddrId) {
                throw new Exception('Must specify contact number, when using FLAG_MAIN');
            }
            
            return tep_db_fetch_array(tep_db_query(
            	"SELECT name AS first_name, name_2 as last_name,
                    			address AS street_address, city, post_code,
                    			country_code
                                {$selectSuffix}
            		FROM contact addr {$fromSuffix}
            		WHERE addr.no = '{$contactNoOrAddrId}' {$whereSuffix}"));
            
        }
        
        // FLAG_ALL_ALT: return all alt addresses for the given contact no
        if ( ($flags & self::FLAG_ALL_ALT) != 0 ) {
            
            if (null == $contactNoOrAddrId) {
                throw new Exception('Must specify contact number, when using FLAG_ALL_ALT');
            }
            
            $result = tep_db_query(
            	"SELECT code, company_name AS first_name, company_name_2 as last_name,
                    			address AS street_address, city, post_code,
                    			country_code
                                {$selectSuffix}
            		FROM contact_alt_address addr {$fromSuffix}
            		WHERE addr.contact_no = '{$contactNoOrAddrId}' {$whereSuffix}");
            $allAltAddresses = array();
            while($nextRow = tep_db_fetch_array($result)) {
                $allAltAddresses[] = $nextRow;
            }
            return $allAltAddresses;
            
        }
        
        // FLAG_ALT: return specific alt addresses for the given contact no
        if ( ($flags & self::FLAG_ALT) != 0 ) {
            
            if ( (null == $contactNoOrAddrId) || (null == $code) ) {
                throw new Exception('Must specify contact number and code, when using FLAG_ALT');
            }
            
            return tep_db_fetch_array(tep_db_query(
            	"SELECT code, company_name AS first_name, company_name_2 as last_name,
                    			address AS street_address, city, post_code,
                    			country_code
                    			 {$selectSuffix}
            		FROM contact_alt_address addr {$fromSuffix}
            		WHERE addr.contact_no = '{$contactNoOrAddrId}'
            			AND addr.code = '{$code}' {$whereSuffix}"));
            
        }
        
        // FLAG_ALT_BY_ID: return specific alt addresses for the given alt contact address id
        if ( ($flags & self::FLAG_ALT_BY_ID) != 0 ) {
            
            if ( (null == $contactNoOrAddrId) ) {
                throw new Exception('Must specify alt contact address id, when using FLAG_ALT_BY_ID');
            }
            
            list($code, $contactNo, $globalDimension1) =
                self::parseCodeContactDim($contactNoOrAddrId);
            return self::retrieveContactAddress(self::FLAG_ALT, $contactNo, $code);
            
        }
        
        throw new Exception("Invalid flags: {$flags}");
    }
    
    /**
     * Inserts a new entry into the contact_alt_address table and returns
     * the generated code for the new entry, or, if an equivalent entry
     * already exists, simply returns the code of that entry.
     *
     * @return the generated code for the new entry
     */
    public static function insertAlternativeContactAddress($newEntryArray)
    {
        // Build up query to select the code for a specific entry
        $selectCodeQuery =
        	"SELECT code
        		FROM contact_alt_address
        		WHERE contact_no            = '{$newEntryArray['contact_no']}'
                    AND company_name        = '{$newEntryArray['name']}'
                    AND company_name_2      = '{$newEntryArray['name_2']}'
                    AND address             = '{$newEntryArray['address']}'
                    AND city                = '{$newEntryArray['city']}'
                    AND country_code        = '{$newEntryArray['country_code']}'
                    AND post_code           = '{$newEntryArray['post_code']}'";
        
        // Check if entry with same data already exists, and if yes, do not
        // insert a new entry, but just return the code of the existing entry
        $existsResult = tep_db_query($selectCodeQuery);
        if (tep_db_num_rows($existsResult)) {
            $existsRow = tep_db_fetch_array($existsResult);
            return $existsRow['code'];
        }
        
        // Note: We use a SELECT to insert a new entry in order to be
        //       able to generate an available value for the code field,
        //       which is part of the primary key together with customer_no)
        tep_db_query(
        	"INSERT INTO contact_alt_address
        			(contact_no,
        			 code,
        			 company_name,
        			 company_name_2,
        			 address,
        			 city,
        			 country_code,
        			 post_code)
        		SELECT
        			'{$newEntryArray['contact_no']}',
        			IFNULL((MAX(CONVERT(code, SIGNED INTEGER))+1), 1),
        			'{$newEntryArray['name']}',
        			'{$newEntryArray['name_2']}',
        			'{$newEntryArray['address']}',
        			'{$newEntryArray['city']}',
        			'{$newEntryArray['country_code']}',
        			'{$newEntryArray['post_code']}'
        		FROM contact_alt_address
        		WHERE contact_no = '{$newEntryArray['contact_no']}'
        			AND CONVERT(code, SIGNED INTEGER) IS NOT NULL
        			AND CONVERT(code, SIGNED INTEGER) >= 0");
        
        // Fetch the code that was generated for the new entry (it was
        // generated as part of the above INSERT statement)
        $codeResult = tep_db_fetch_array(tep_db_query($selectCodeQuery));
        
        // Finally return the generated code
        return $codeResult['code'];
    }
    
    /**
     * Retrieves the address from the customer table, for the given
     * customer no.
     *
     * @param unknown_type $customerNo a customer no
     */
    public static function retrieveCustomerAddress($customerNo)
    {
        return tep_db_fetch_array(tep_db_query(
        	"SELECT name AS first_name, name_2 as last_name,
                			address AS street_address, city, post_code,
                			country_code
        		FROM customer
        		WHERE no = '{$customerNo}'"));
    }
    
    /**
     * Retrieves the ship-to-address entry corresponding to the given
     * shipping address id.
     *
     * @param string $shippingAddressId a shipping address id
     */
    public static function retrieveShipToAddressById($shippingAddressId)
    {
        list($code, $contactNo, $globalDimension1) =
            self::parseCodeContactDim($shippingAddressId);
        return self::retrieveShipToAddress($globalDimension1, $contactNo, $code);
    }
    
    /**
     * Retrieves the ship-to-address entry for the given
     * global-dimension-1 / contact no / code, as an array.
     *
     * @param unknown_type $globalDimension1 a global-dimension-1
     * @param unknown_type $contactNo a contact no
     * @param unknown_type $code a code
     */
    public static function retrieveShipToAddress($globalDimension1, $contactNo, $code)
    {
        return tep_db_fetch_array(tep_db_query(
	    	"SELECT name AS first_name, name_2 AS last_name,
	    			address as street_address, post_code,
	    			city, country_code, code, shortcut_dim_code_1,
	    			customer_no, contact_no
	    		FROM ship_to_address
	    		WHERE contact_no = '{$contactNo}'
	    			AND shortcut_dim_code_1 = '{$globalDimension1}'
	    			AND code = '{$code}'"));
    }
    
    /**
     * Retrieves the ship-to-address entry combined with the corresponding
     * country entry for the given global-dimension-1 / contact no / code,
     * as an array.
     *
     * @param unknown_type $globalDimension1 a global-dimension-1
     * @param unknown_type $contactNo a contact no
     * @param unknown_type $code a code
     */
    public static function retrieveShipToAddressWithCountryDetails($globalDimension1, $contactNo, $code)
    {
        return tep_db_fetch_array(tep_db_query(
            "SELECT name AS first_name, name_2 as last_name,
                	address AS street_address, city, post_code,
                	country_code, code, shortcut_dim_code_1,
	    			customer_no, contact_no
                FROM ship_to_address sta
                	INNER JOIN countries c
                		ON ((sta.country_code COLLATE latin1_danish_ci) = c.countries_iso_code_2)
	    		WHERE sta.contact_no = '{$contactNo}'
	    			AND sta.shortcut_dim_code_1 = '{$globalDimension1}'
	    			AND sta.code = '{$code}'"));
    }
    
    /**
     * Answers whether a ship-to-address entry exists for the given
     * global-dimension-1 / contact no / code.
     *
     * @param unknown_type $globalDimension1 a global-dimension-1
     * @param unknown_type $contactNo a contact no
     * @param unknown_type $code a code
     */
    public static function shipToAddressExists($globalDimension1, $contactNo, $code)
    {
		$countResult = tep_db_fetch_array(tep_db_query(
			"SELECT COUNT(1) AS total
				FROM ship_to_address
				WHERE contact_no = '{$contactNo}'
					AND shortcut_dim_code_1 = '{$globalDimension1}'
					AND code = '{$code}'"));
        
		return (intval($countResult['total']) == 1);
    }
    
    /**
     * Retrieves the number of ship-to-address records for the given
     * global-dimension-1 / contact no .
     *
     * @param unknown_type $globalDimension1 a global dimension 1 code
     * @param unknown_type $contactNo a contact number
     */
    public static function retrieveShipToAddressCount($globalDimension1, $contactNo)
    {
        $countResult = tep_db_fetch_array(tep_db_query(
        	"SELECT COUNT(1) AS num_existing_entries
        		FROM ship_to_address
        		WHERE contact_no = '{$contactNo}'
        			AND shortcut_dim_code_1 = '{$globalDimension1}'"));
        
        return intval($countResult['num_existing_entries']);
    }
    
    /**
     * Retrieves all ship-to-address entries for the given
     * global-dimension-1 / contact no, as an array of arrays.
     *
     * @param unknown_type $globalDimension1 a global-dimension-1
     * @param unknown_type $contactNo a contact no
     */
    public static function retrieveAllShipToAddresses($globalDimension1, $contactNo)
    {
        $queryResult = tep_db_query(
	    	"SELECT name AS first_name, name_2 AS last_name,
	    			address as street_address, post_code,
	    			city, country_code, code, shortcut_dim_code_1,
	    			customer_no, contact_no
	    		FROM ship_to_address
	    		WHERE contact_no = '{$contactNo}'
	    			AND shortcut_dim_code_1 = '{$globalDimension1}'");
        
        $allShipToAddresses = array();
        while($shipToAddress = tep_db_fetch_array($queryResult)) {
            $allShipToAddresses[] = $shipToAddress;
        }
        
        return $allShipToAddresses;
    }
    
    /**
     * Inserts a new entry into the ship_to_address table and returns the
     * generated code for the new entry, or, if an equivalent entry
     * already exists, simply returns the code of that entry..
     *
     * @return the generated code for the new entry
     */
    public static function insertNewShipToAddress($newEntryArray)
    {
        // Build up query to select the code for a specific entry
        $selectCodeQuery =
        	"SELECT code
        		FROM ship_to_address
        		WHERE customer_no           = '{$newEntryArray['customer_no']}'
                    AND name                = '{$newEntryArray['name']}'
                    AND name_2              = '{$newEntryArray['name_2']}'
                    AND address             = '{$newEntryArray['address']}'
                    AND city                = '{$newEntryArray['city']}'
                    AND country_code        = '{$newEntryArray['country_code']}'
                    AND post_code           = '{$newEntryArray['post_code']}'
                    AND contact_no          = '{$newEntryArray['contact_no']}'
                    AND shortcut_dim_code_1 = '{$newEntryArray['shortcut_dim_code_1']}'";
        
        // Check if entry with same data already exists, and if yes, do not
        // insert a new entry, but just return the code of the existing entry
        $existsResult = tep_db_query($selectCodeQuery);
        if (tep_db_num_rows($existsResult)) {
            $existsRow = tep_db_fetch_array($existsResult);
            return $existsRow['code'];
        }
        
        // Note: We use a SELECT to insert a new entry in order to be
        //       able to generate an available value for the code field,
        //       which is part of the primary key together with customer_no)
        $fields = implode(',', array_keys($newEntryArray));
        $values = "'" . implode("','", $newEntryArray) . "'";
        tep_db_query(
        	"INSERT INTO ship_to_address ({$fields}, code)
        		SELECT {$values}, IFNULL((MAX(CONVERT(CODE, SIGNED INTEGER))+1), 1)
        		FROM ship_to_address
        		WHERE CONVERT(CODE, SIGNED INTEGER) IS NOT NULL
        			AND CONVERT(CODE, SIGNED INTEGER) >= 0");
        
        // Fetch the code that was generated for the new entry (it was
        // generated as part of the above INSERT statement)
        $codeResult = tep_db_fetch_array(tep_db_query($selectCodeQuery));
        
        // Finally return the generated code
        return $codeResult['code'];
    }
}
