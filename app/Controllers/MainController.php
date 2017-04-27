<?php
/**
 * CSVParserToHTML - MainController
 *
 * @since       25.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

namespace enovinfo\CSVParserToHTML\Controllers;

use \enovinfo\CSVParserToHTML\Parsers\MainParser as MainParser;
use \enovinfo\CSVParserToHTML\Helpers\TemplateHelper as TemplateHelper;

class MainController
{
    
    /********************************/
    /********** PROPERTIES **********/
    /********************************/

    /**
     * @param string $folder
     * @param string $fileName
     */

    private $folder;
    private $fileName;
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /*******************************/
    /********** CONSTRUCT **********/
    /*******************************/

    /**
     * @param string $folder
     * @param string $fileName
     */

    public function __construct($folder = null, $fileName = null)
    {
        $this->_setValues($folder, $fileName);
        $this->_displayMainView();
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*****************************/
    /********** SETTERS **********/
    /*****************************/

    /**********/
    /********** SET VALUES **********/
    /**********/

    /**
     * @param string $folder
     * @param string $fileName
     */

    private function _setValues($folder, $fileName)
    {
        $this->_setFolder($folder);
        $this->_setFileName($fileName);
    }

    /**********/
    /********** FOLDER **********/
    /**********/

    /**
     * @param string $folder
     */

    private function _setFolder($folder)
    {
        if (!empty($folder)) {
            $this->folder = $folder;
        } else {
            $this->folder = __DIR__ . '/../../imports';
        }
    }

    /**********/
    /********** FILENAME **********/
    /**********/

    /**
     * @param string $fileName
     */

    private function _setFileName($fileName)
    {
        if (!empty($fileName)) {
            $this->fileName = $fileName;
        } else {
            $this->fileName = 'test_file';
        }
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /***************************************/
    /********** DISPLAY MAIN VIEW **********/
    /***************************************/

    private function _displayMainView()
    {
        $this->_parseData();

        $data = array();

        for ($i = 0; $i <= 10; $i++) {
            $theData = array();
            $theData['id'] = uniqid();
            $theData['type'] = 'foo' . $i % 2;

            for ($j = 1; $j < 11; $j++) {
                $theData['data_'.$j] = uniqid();
            }

            $theData['other_data'] = uniqid();

            array_push($data, $theData);
        }

        $rowTemplates = array();

        foreach ($data as $item) {
            $row = new TemplateHelper('main-table-row.tpl');

            foreach ($item as $key => $value) {
                $row->set($key, $value);
            }

            $rowTemplates[] = $row;
        }

        $rowsContent = TemplateHelper::merge($rowTemplates);

        $mainTable = new TemplateHelper('main-table.tpl');
        $mainTable->set('content', $rowsContent);

        $layout = new TemplateHelper('layout.tpl');
        $layout->set('content', $mainTable->output());

        echo $layout->output();
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /********************************/
    /********** PARSE DATA **********/
    /********************************/

    private function _parseData()
    {
        $parser = new MainParser($this->folder, $this->fileName);
        $data = $parser->parse();
    }
}
