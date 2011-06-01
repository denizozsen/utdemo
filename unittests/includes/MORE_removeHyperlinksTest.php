<?php

require_once 'PHPUnit/Framework/TestCase.php';

require_once 'includes/utilities.php';

/**
 * removeHyperlinks() test case.
 */
class MORE_removeHyperlinksTest extends PHPUnit_Framework_TestCase
{
    public function testRemoveHyperlinks()
    {
        $result =
            removeHyperlinks('The following is a <a href="www.google.com">hyperlink</a>');
          $this->assertEquals('The following is a hyperlink', $result);
    }
    
    public function testRemoveHyperlinks_withSpaces()
    {
        $result =
            removeHyperlinks('The following is a <a onclick="return confirm(\'Are you sure?\');" href="www.google.com">hyperlink</a>');
          $this->assertEquals('The following is a hyperlink', $result);
    }
}
