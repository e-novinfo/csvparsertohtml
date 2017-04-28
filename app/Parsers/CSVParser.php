<?php
/**
 * CSVParserToHTML - CSVParser
 *
 * @since       27.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

namespace enovinfo\CSVParserToHTML\Parsers;

use \enovinfo\CSVParserToHTML\Abtracts\AbstractCSVParser as AbstractCSVParser;
use \enovinfo\CSVParserToHTML\Interfaces\Parser as Parser;

class CSVParser extends AbstractCSVParser
{
    
    /********************************/
    /********** PROPERTIES **********/
    /********************************/

    /**
     * @var array $headers
     * @var array $data
     */

    private $headers = array();
    private $data = array();

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
        parent::__construct($folder, $fileName);
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
        return $this->headers;
    }

    /**********/
    /********** DATA **********/
    /**********/

    /**
     * @return array
     */

    public function getData()
    {
        return $this->data;
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /***************************/
    /********** PARSE **********/
    /***************************/

    public function parse()
    {
        $this->_iterateOverRows();
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************************/
    /********** CHECK IF ROW IS EMPTY **********/
    /******************************************/

    /**
     * @param array $row
     */

    private function _checkIfRowIsEmpty($row)
    {
        $emptyRow = ($row === array(null));
        $emptyRowWithDelimiters = (array_filter($row) === array());

        $isEmpty = false;
        
        if ($emptyRow) {
            $isEmpty = true;
            return $isEmpty;
        } elseif ($emptyRowWithDelimiters) {
            $isEmpty = true;
            return $isEmpty;
        }
        return $isEmpty;
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*********************************************************************************/
    /*********************************************************************************/

    /*********************************/
    /********** SET HEADERS **********/
    /*********************************/

    /**
     * @param array $row
     */

    private function _setHeaders($row)
    {
        $this->headers = $row;
    }

    /***************************************/
    /********** ITERATE OVER ROWS **********/
    /***************************************/

    protected function _iterateOverRows()
    {
        $i = 0;

        while (($row = $this->_getRows()) !== false) {
            if (!$this->_checkIfRowIsEmpty($row)) {
                if ($i === 0) {
                    $this->_setHeaders($row);
                } else {
                    $this->_pushData($row);
                }
            }

            $i++;
        }

        $this->_closeFile();
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /******************************/
    /********** GET ROWS **********/
    /******************************/

    protected function _getRows()
    {
        return fgetcsv($this->file, 0, $this->delimiter);
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************/
    /********** PUSH DATA **********/
    /*******************************/

    /**
     * @param array $row
     */

    protected function _pushData($row)
    {
        array_push($this->data, $row);
    }
}
