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

use \enovinfo\CSVParserToHTML\Helpers\TemplateHelper as TemplateHelper;

class MainController
{
    
    /********************************/
    /********** PROPERTIES **********/
    /********************************/
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /*******************************/
    /********** CONSTRUCT **********/
    /*******************************/

    public function __construct()
    {
        $this->_displayMainView();
    }
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /***************************************/
    /********** DISPLAY MAIN VIEW **********/
    /***************************************/

    private function _displayMainView()
    {
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
}
