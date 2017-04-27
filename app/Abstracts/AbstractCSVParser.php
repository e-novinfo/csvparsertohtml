<?php
/**
 * CSVParserToHTML - AbstractCSVParser
 *
 * @since       14.12.2016
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

namespace enovinfo\CSVParserToHTML\Abtracts;

use \Exception;

abstract class AbstractCSVParser
{
    /********************************/
    /********** PROPERTIES **********/
    /********************************/

    /**
     * @var string $delimiter
     * @var string $enclosure
     * @var string $fileExtension
     * @var string $fileName
     */

    protected $delimiter = ';';
    protected $enclosure = '"';
    protected $fileExtension = 'csv';
    protected $fileName;
    protected $filePath;
    protected $folder = 'imports';
    protected $file = false;
    protected $size = 0;
    
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
        $this->_prepareFile();
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*****************************/
    /********** GETTERS **********/
    /*****************************/

    /**********/
    /********** FILE **********/
    /**********/

    /**
     * @return $file
     */

    public function getFile()
    {
        return $this->file;
    }

    /**********/
    /********** SIZE **********/
    /**********/

    /**
     * @return int
     */

    public function getSize()
    {
        return $this->size;
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
        $this->_setFilePath();
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
    /********** FILE PATH **********/
    /**********/

    private function _setFilePath()
    {
        $this->filePath = $this->folder . '/' . $this->fileName . '.' . $this->fileExtension;
    }

    /**********/
    /********** FILE **********/
    /**********/

    /**
     * @param $file
     */

    private function _setFile($file)
    {
        $this->file = $file;
    }

    /**********/
    /********** SIZE **********/
    /**********/

    /**
     * @param $size
     */

    private function _setSize($size)
    {
        $this->size = $size;
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /**********************************/
    /********** PREPARE FILE **********/
    /**********************************/

    private function _prepareFile()
    {
        try {
            if ($this->_loadFile()) {
                $file = $this->_openFile();

                if ($file) {
                    $this->_setFile($file);

                    $size = $this->_checkSize();

                    if (!empty($size)) {
                        $this->_setSize($size);
                    }
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            exit;
        }
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************/
    /********** LOAD FILE **********/
    /*******************************/

    /**
     * @return Bool
     */

    private function _loadFile()
    {
        if (!file_exists($this->filePath) || !is_file($this->filePath)) {
            throw new \Exception("$this->fileName not found. Make sure you specified the correct path.");
            return false;
        }

        return true;
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************/
    /********** OPEN FILE **********/
    /*******************************/

    /**
     * @return Mixed
     */

    private function _openFile()
    {
        $file = fopen($this->filePath, "r");

        if (!$file) {
            throw new \Exception("Error opening data file");
            return false;
        }

        return $file;
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /********************************/
    /********** CHECK SIZE **********/
    /********************************/

    /**
     * @return Mixed
     */

    private function _checkSize()
    {
        $size = filesize($this->filePath);
            
        if (!$size) {
            throw new \Exception("File is empty");
            return false;
        }

        return $size;
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /********************************/
    /********** CLOSE FILE **********/
    /********************************/

    /**
     * @return Bool
     */

    protected function _closeFile()
    {
        return fclose($this->file);
    }

    /*********************************************************************************/
    /*********************************************************************************/

    /***************************************/
    /********** ITERATE OVER ROWS **********/
    /***************************************/

    abstract protected function _iterateOverRows();

    /*********************************************************************************/
    /*********************************************************************************/

    /******************************/
    /********** GET ROWS **********/
    /******************************/

    abstract protected function _getRows();

    /*********************************************************************************/
    /*********************************************************************************/

    /*******************************/
    /********** PUSH DATA **********/
    /*******************************/

    /**
     * @param array $row
     */

    abstract protected function _pushData($row);
}
