<?php
/**
 * CSVParserToHTML - CSVParserTest
 *
 * @since       27.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

use \enovinfo\CSVParserToHTML\Parsers\CSVParser as CSVParser;

class CSVParserTest extends \PHPUnit_Framework_TestCase
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
        $parser = new CSVParser(__DIR__ . '/../Imports', 'test_file');
        $this->assertInstanceOf('\enovinfo\CSVParserToHTML\Parsers\CSVParser', $parser);
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************/
    /********** TEST DATA **********/
    /*******************************/

    public function testData()
    {
        $parser = new CSVParser(__DIR__ . '/../Imports', 'test_file');
        $parser->parse();
        $data = $parser->getData();

        $this->assertTrue(is_array($data));
        $this->assertEquals(4, count($data));
    }

    /*********************************************************************************/
    /*********************************************************************************/
}
