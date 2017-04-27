<?php
/**
 * CSVParserToHTML - MainParserTest
 *
 * @since       27.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

use \enovinfo\CSVParserToHTML\Parsers\MainParser as MainParser;

class MainParserTest extends \PHPUnit_Framework_TestCase
{
    /***************************/
    /********** SETUP **********/
    /***************************/

    public function setUp()
    {
    }
    
    /*********************************************************************************/
    /*********************************************************************************/

    /****************************************/
    /********** TEST INSTANTIATION **********/
    /****************************************/

    public function testControllerInstantiation()
    {
        $parser = new MainParser(__DIR__ . '/../Imports', 'test_file');
        $this->assertInstanceOf('\enovinfo\CSVParserToHTML\Parsers\MainParser', $parser);
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************/
    /********** TEST DATA **********/
    /*******************************/

    public function testData()
    {
        $parser = new MainParser(__DIR__ . '/../Imports', 'test_file');
        $data = $parser->parse();

        $this->assertTrue(is_array($data));
        $this->assertEquals(4, count($data));

    }

    /*********************************************************************************/
    /*********************************************************************************/
}
