<?php
/**
 * CSVParserToHTML - TemplateHelperTest
 *
 * @since       26.04.2017
 *
 * @version     1.0.0.0
 * @author      e-novinfo
 * @copyright   e-novinfo 2016
 */

use \enovinfo\CSVParserToHTML\Helpers\TemplateHelper as TemplateHelper;

class TemplateHelperTest extends \PHPUnit_Framework_TestCase
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

    public function testHelperInstantiation()
    {
        $templateHelper = new TemplateHelper('foo');
        $this->assertInstanceOf('\enovinfo\CSVParserToHTML\Helpers\TemplateHelper', $templateHelper);
    }
    
    /*********************************************************************************/
    /*********************************************************************************/

    /*********************************/
    /********** TEST OUTPUT **********/
    /*********************************/

    public function testHelperOutput()
    {
        $templateHelper = new TemplateHelper('simple-content.tpl');
        $templateHelper->set('content', 'foo');
        $output = $templateHelper->output();
        $this->assertEquals('foo', $output);
    }
    
    /*********************************************************************************/
    /*********************************************************************************/

    /*********************************/
    /********** TEST OUTPUT **********/
    /*********************************/

    public function testHelperFailedOutput()
    {
        $file = getcwd() . '/views/foo.tpl';

        $templateHelper = new TemplateHelper('foo.tpl');
        $templateHelper->set('content', 'foo');
        $output = $templateHelper->output();
        $this->assertEquals("Error loading template file (". $file .").<br />", $output);
    }
    
    /*********************************************************************************/
    /*********************************************************************************/

    /********************************/
    /********** TEST MERGE **********/
    /********************************/

    public function testHelperMerge()
    {
        $templateHelper = new TemplateHelper('simple-content.tpl');
        $templateHelper->set('content', 'foo');

        $templateHelper2 = new TemplateHelper('simple-content.tpl');
        $templateHelper2->set('content', 'foo2');

        $templates = array($templateHelper, $templateHelper2);

        $final = "";
        $final .= "foo";
        $final .= "\n";
        $final .= "foo2";
        $final .= "\n";

        $multi = TemplateHelper::merge($templates);
        $main = new TemplateHelper('simple-content.tpl');
        $main->set('content', $multi);
        $output = $main->output();

        $this->assertEquals($final, $output);
    }
}
