<?php
/**
 * CSVParserToHTML - MainParser
 *
 * @since       27.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

namespace enovinfo\CSVParserToHTML\Parsers;

use \enovinfo\CSVParserToHTML\Interfaces\Parser as Parser;

class MainParser implements Parser
{
    
    /********************************/
    /********** PROPERTIES **********/
    /********************************/

    /**
     * @param Parser $parser
     * @param string $folder
     * @param string $fileName
     */

    private $parser;
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

    public function __construct($folder, $fileName)
    {
        $this->_setValues($folder, $fileName);
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*****************************/
    /********** GETTERS **********/
    /*****************************/
            
    /**********/
    /********** HEADERS **********/
    /**********/

    /**
     * @return array
     */
    
    public function getHeaders()
    {
        return $this->parser->getHeaders();
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /**********/
    /********** DATA **********/
    /**********/

    /**
     * @return array
     */
    
    public function getData()
    {
        return $this->parser->getData();
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
        $this->_setParser();
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
        $this->fileName = $fileName;
    }

    /**********/
    /********** PARSER **********/
    /**********/

    private function _setParser()
    {
        $this->parser = new CSVParser($this->folder, $this->fileName);
    }
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /***************************/
    /********** PARSE **********/
    /***************************/

    /**
     * @return array
     */

    public function parse()
    {
        $this->parser->parse();
        return $this->parser->getData();
    }

    /*********************************************************************************/
    /*********************************************************************************/
}
