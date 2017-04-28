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
        $data = $this->_parseData();

        $viewData = $this->_generateView($data);

        $mainTable = new TemplateHelper('main-table.tpl');
        $mainTable->set('thead', $viewData['header']);
        $mainTable->set('tfoot', $viewData['footer']);
        $mainTable->set('tbody', $viewData['content']);

        $layout = new TemplateHelper('layout.tpl');
        $layout->set('content', $mainTable->output());

        echo $layout->output();
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /********************************/
    /********** PARSE DATA **********/
    /********************************/

    /**
     * @return array
     */

    private function _parseData()
    {
        $array = array();

        $parser = new MainParser($this->folder, $this->fileName);
        $parser->parse();

        $array['header'] = $parser->getHeaders();
        $array['data'] = $parser->getData();

        return $array;
    }
    
    /*********************************************************************************/
    /*********************************************************************************/

    /***********************************/
    /********** GENERATE VIEW **********/
    /***********************************/

    /**
     * @param array $data data to use
     * @return array
     */

    private function _generateView($data)
    {
        $array = array();

        $array['header'] = $this->_displayHeader($data['header']);
        $array['footer'] = $this->_displayFooter($data['header']);
        $array['content'] = $this->_displayContent($data['data']);

        return $array;
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /************************************/
    /********** DISPLAY HEADER **********/
    /************************************/

    /**
     * @param array $headers data to use
     * @return object
     */

    private function _displayHeader($headers)
    {
        if (!empty($headers)) {
            $thTemplates = array();

            foreach ($headers as $h => $header) {
                $th = new TemplateHelper('main-table-header.tpl');
                $th->set('data', $header);
                $thTemplates[] = $th;
            }

            $headerTh = TemplateHelper::merge($thTemplates);

            $headerRow = new TemplateHelper('main-table-row.tpl');
            $headerRow->set('cells', $headerTh);

            return $headerRow->output();
        }
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /************************************/
    /********** DISPLAY FOOTER **********/
    /************************************/

    /**
     * @param array $headers data to use
     * @return object
     */

    private function _displayFooter($headers)
    {
        if (!empty($headers)) {
            $tdTemplates = array();

            foreach ($headers as $h => $header) {
                $td = new TemplateHelper('main-table-cell.tpl');
                $td->set('data', $header);
                $tdTemplates[] = $td;
            }

            $headerTd = TemplateHelper::merge($tdTemplates);

            $footerRow = new TemplateHelper('main-table-row.tpl');
            $footerRow->set('cells', $headerTd);

            return $footerRow->output();
        }
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /*************************************/
    /********** DISPLAY CONTENT **********/
    /*************************************/

    /**
     * @param array $content data to use
     * @return object
     */

    private function _displayContent($content)
    {
        if (!empty($content)) {
            $trTemplates = array();

            foreach ($content as $d => $data) {
                $tdTemplates = array();

                foreach ($data as $i => $item) {
                    $td = new TemplateHelper('main-table-cell.tpl');
                    $td->set('data', $item);
                    $tdTemplates[] = $td;
                }

                $rowTd = TemplateHelper::merge($tdTemplates);

                $tr = new TemplateHelper('main-table-row.tpl');
                $tr->set('cells', $rowTd);
                $trTemplates[] = $tr;
            }

            $row = TemplateHelper::merge($trTemplates);

            return $row;
        }
    }
}
