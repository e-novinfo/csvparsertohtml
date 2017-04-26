<?php
/**
 * CSVParserToHTML - MainControllerTest
 *
 * @since       26.04.2017
 *
 * @version     1.0.0.0
 * @author      e-novinfo
 * @copyright   e-novinfo 2016
 */

use \enovinfo\CSVParserToHTML\Controllers\MainController as MainController ;

class MainControllerTest extends \PHPUnit_Framework_TestCase
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
        $mainController = new MainController();
        $this->assertInstanceOf('\enovinfo\CSVParserToHTML\Controllers\MainController', $mainController);
    }
    
    /*********************************************************************************/
    /*********************************************************************************/
}
