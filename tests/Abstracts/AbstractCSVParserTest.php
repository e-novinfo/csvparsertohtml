<?php
/**
 * CSVParserToHTML - AbstractCSVParserTest
 *
 * @since       27.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

use \enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser as AbstractCSVParser;

class AbstractCSVParserTest extends \PHPUnit_Framework_TestCase
{
    /***************************/
    /********** SETUP **********/
    /***************************/

    public function setUp()
    {
    }
    
    /*********************************************************************************/
    /*********************************************************************************/

    /*************************************************/
    /********** TEST CONCRETE INSTANCIATION **********/
    /*************************************************/

    public function testConcreteInstanciation()
    {

        $abstractClass = '\enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser';

        $testData = array(
            'folder' => 'tests/Imports',
            'file' => 'test_file'
        );

        $mock = $this->getMockBuilder($abstractClass)
            ->setConstructorArgs(array($testData['folder'], $testData['file']))
            ->getMockForAbstractClass();

        $this->assertInstanceOf('\enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser', $mock);
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************************/
    /********** TEST CONCRETE METHODS **********/
    /*******************************************/

    public function testConcreteMethods()
    {

        $abstractClass = '\enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser';

        $testData = array(
            'folder' => 'tests/Imports',
            'file' => 'test_file'
        );

        $methods = array(
            'getFile',
            'getSize'
        );

        $mock = $this->getMockBuilder($abstractClass)
            ->setConstructorArgs(array($testData['folder'], $testData['file']))
            ->setMethods()
            ->getMockForAbstractClass();

        $this->assertNotEmpty($mock->getFile());
        $this->assertNotEmpty($mock->getSize());
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*************************************/
    /********** TEST EMPTY FILE **********/
    /*************************************/

    /**
     * @expectedException \Exception
     */

    public function testEmptyFile()
    {

        $abstractClass = '\enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser';

        $testData = array(
            'folder' => 'tests/Imports',
            'file' => 'empty_file'
        );

        $methods = array(
            'getFile',
            'getSize'
        );

        $mock = $this->getMockBuilder($abstractClass)
            ->setConstructorArgs(array($testData['folder'], $testData['file']))
            ->setMethods()
            ->getMockForAbstractClass();

        $this->assertNotEmpty($mock->getFile());
        $this->assertEmpty($mock->getSize());
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /********************************************/
    /********** TEST NON EXISTING FILE **********/
    /********************************************/

    /**
     * @expectedException \Exception
     */

    public function testNonExistingFile()
    {

        $abstractClass = '\enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser';

        $testData = array(
            'folder' => 'tests/Imports',
            'file' => 'non_existing_file'
        );

        $methods = array(
            'getFile',
            'getSize'
        );

        $mock = $this->getMockBuilder($abstractClass)
            ->setConstructorArgs(array($testData['folder'], $testData['file']))
            ->setMethods()
            ->getMockForAbstractClass();
    }

}
