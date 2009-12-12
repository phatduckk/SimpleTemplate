<?php

/**
 * Ghetto little template example for a dude who commented on my blog
 * 
 * @author Arin Sarkissian <arin@rspot.net>
 */

class SimpleTemplate
{
    /**
     * Path to the "template" php file to render. 
     * Must be in your include_path
     *
     * @var string
     */
    private $templatePath;
    
    /**
     * Path to the "header" php file to render. 
     * Must be in your include_path
     *
     * @var string
     */    
    public $header = null;
    
    /**
     * Path to the "footer" php file to render. 
     * Must be in your include_path
     *
     * @var string
     */    
    public $footer = null;
    
    /**
     * Associative array of data which will act as the variable to the
     * rendered template.
     *
     * The keys will be the variable name & the values will be the values ;-)
     *
     * @var array
     */
    private $templateData = array();
    
    /**
     * Constructor
     *
     * @param string $templatePath Path to php file template
     * @param mixed  $templateData Variable to the template as an assoc array
     * @param string $header       Path to header file
     * @param mixed  $footer Value Path to footer file
     *
     * @return void
     */    
    public function __construct($templatePath, array $templateData = array(), $header = null, $footer = null)
    {
        $this->templatePath = $templatePath;
        $this->templateData = $templateData;
        $this->header       = $header;
        $this->footer       = $footer;        
    }
    
    /**
     * Add a new variable to $this->templateData
     *
     * not a fan of magic methods - but, eh this is just an example
     *
     * @param string $name  Name of the variable to add
     * @param mixed  $value Value of the variable to add     
     */
    public function __set($name, $value)
    {
        $this->templateData[$name] = $value;
    }
    
    /**
     * Get a variable from $this->templateData
     *
     * not a fan of magic methods - but, eh this is just an example     
     *
     * @param string $name Name of the variable to fetch
     *
     * @return mixed
     */
    public function __get($name)
    {
        return (isset($this->templateData[$name]))
            ? $this->templateData[$name]
            : null;
    }    
    
    /**
     * Render the template.
     *
     * If $__returnOutput__ == false the output will be sent to stdout. Otherwise
     * we collect it in a buffer and return it as a string.
     *
     * PS: the whacky, over-underscored name for $__returnOutput__ is to avoid
     * variable name collissions with extract()
     *
     * @param bool $__returnOutput__ Whether you want the function to return the
     *  value of the template or output it 
     *
     * @return void|string String if $__returnOutput__ else void
     */    
    public function render($__returnOutput__ = false)
    {
        // turn on output buffering if we're returning the output instead of spitting it out
        if ($__returnOutput__) {
            ob_start();
        }
        
        // extract the stuff in $this->templateData into local vars
        extract($this->templateData, EXTR_SKIP);
        
        // render header if we have one
        if ($this->header !== null) {
            require($this->header);
        }
        
        // render the template
        require($this->templatePath);

        // render footer if we have one        
        if ($this->footer !== null) {
            require($this->footer);
        }

        // return buffer contents if $__returnOutput__
        if ($__returnOutput__) {
            return ob_get_clean();
        }                
    }
    
    /**
     * A shortcut to calling <code>$template->render(true);</code>
     *
     * This is useful for stuff like:
     *
     * <code>
     *   echo new Template('/some/path/phpFile.php', array('foo' => 'bar'));
     * </code>
     * 
     * @return string The output of the template
     */
    public function __toString()
    {
        return $this->render(true);
    }
    
    /**
     * Include another template. All the data from this template's
     * $this->templateData var will be sent over there (but not as a reference)
     *
     * @return string The output of the included template
     */
    public function inc($includeTemplatePath, $header = null, $footer = null)
    {
        $class = get_class($this); // in case someone renames this and actually uses it
        echo new $class($includeTemplatePath, $this->templateData, $header, $footer);
    }    
}

?>