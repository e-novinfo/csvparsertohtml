<?php
/**
 * CSVParserToHTML - TemplateHelper
 *
 * @since       26.04.2017
 *
 * @version     1.0.0.0
 *
 * @author      e-novinfo
 * @copyright   e-novinfo 2017
 */

namespace enovinfo\CSVParserToHTML\Helpers;

class TemplateHelper
{
    
    /********************************/
    /********** PROPERTIES **********/
    /********************************/

    /**
     * @var string $folder where the template to load is
     * @var string $file the filename of the template to load
     * @var array $values array of values for replacing each tag on the template (the key for each value is its corresponding tag)
     */

    protected $folder;
    protected $file;
    protected $values = array();
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /*******************************/
    /********** CONSTRUCT **********/
    /*******************************/

    /**
     * @param string $folder where the template to load is
     * @param string $file the filename of the template to load
     */

    public function __construct($folder = null, $file)
    {
        $this->_setValues($folder, $file);
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
     * @param string $folder where the template to load is
     * @param string $file the filename of the template to load
     */

    private function _setValues($folder, $file)
    {
        $this->_setFolder($folder);
        $this->_setFile($file);
    }

    /**********/
    /********** FOLDER **********/
    /**********/

    /**
     * @param string $folder where the template to load is
     */

     private function _setFolder($folder)
     {
         if (!empty($folder)) {
             $this->folder = $folder;
         } else {
             $this->folder = __DIR__ . '/../../views/';
         }
     }

    /**********/
    /********** FILE **********/
    /**********/

    /**
     * @param string $file the filename of the template to load
     */

    private function _setFile($file)
    {
        $this->file = $file;
    }

    /**********/
    /********** DATA **********/
    /**********/

    /**
     * @param string $key the name of the tag to replace
     * @param string $value the value to replace
     */

    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /****************************/
    /********** OUTPUT **********/
    /****************************/

    /**
     * @return string
     */

    public function output()
    {
        $filePath = __DIR__ . '/../../views/' . $this->file;

        if (!file_exists($filePath)) {
            return "Error loading template file ($this->file).<br />";
        }

        $output = file_get_contents($filePath);
        
        foreach ($this->values as $key => $value) {
            $tagToReplace = "[@$key]";
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }

    /*********************************************************************************/
    /*********************************************************************************/
        
    /***************************/
    /********** MERGE **********/
    /***************************/

    /**
     * @param array $templates an array of Template objects to merge
     * @param string $separator the string that is used between each Template object
     * @return string
     */

    public static function merge($templates, $separator = "\n")
    {
        $output = "";
        
        foreach ($templates as $template) {
            $content = (get_class($template) !== "enovinfo\CSVParserToHTML\Helpers\TemplateHelper") ? "Error, incorrect type - expected Template." : $template->output();
            $output .= $content . $separator;
        }
        
        return $output;
    }
}
