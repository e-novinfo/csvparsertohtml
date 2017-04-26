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
     * @var string $file the filename of the template to load
     * @var array $values array of values for replacing each tag on the template (the key for each value is its corresponding tag)
     */

    protected $file;
    protected $values = array();
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /*******************************/
    /********** CONSTRUCT **********/
    /*******************************/

    /**
     * @param string $file the filename of the template to load
     */

    public function __construct($file)
    {
        $this->file = $file;
    }
    
    /*********************************************************************************/
    /*********************************************************************************/
        
    /*************************/
    /********** SET **********/
    /*************************/

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
        $filePath = getcwd() . '/views/' . $this->file;

        if (!file_exists($filePath)) {
            return "Error loading template file ($filePath).<br />";
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
