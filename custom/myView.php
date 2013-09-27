<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of myView
 *
 * @author tony
 */
namespace custom; 

class myView extends \Slim\View{
     /** @var string */
    protected $layout;
    
    /** @var \custom\Translator */
    public $translator;

    /** @var array */
    protected $layoutData = array();

    /**
     * @param string $layout Pathname of layout script
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    /**
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function setLayoutData($data)
    {
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Cannot append view data. Expected array argument.');
        }

        $this->layoutData = $data;
    }

    /**
     * @param array $data
     * @throws \InvalidArgumentException
     */
    public function appendLayoutData($data)
    {
        if (!is_array($data)) {
            throw new \InvalidArgumentException('Cannot append view data. Expected array argument.');
        }

        $this->layoutData = array_merge($this->layoutData, $data);
    }
    
    /**
     * 
     * @param \custom\Translator $translator  set the translator object the view uses to translate content
     */
    public function setTranslator(\custom\Translator $translator) {
        $this->translator = $translator;
    }
    
    /**
     * 
     * @param string $param the string to be translated
     * @return string  the translated text
     * @throws \RuntimeException item to be translated must be a string
     */
    public function tr($param) {
        if(!isset($this->translator)){
            throw new \RuntimeException('No translator object defined in view.');
        }
        return $this->translator->translate($param);
    }

    /**
     * Render template
     *
     * @param  string $template Pathname of template file relative to templates directory
     * @return string
     */
    public function render($template)
    {
        if ($this->layout){
            $content = parent::render($template);

            $this->appendLayoutData(array('content' => $content));
            $this->setData($this->layoutData);

            $template = $this->layout;
            $this->layout = null; // allows correct partial render in view, like "< echo $this->render('path to parial view script');"

            return parent::render($template);
        } else {
            return parent::render($template);
        }
    }
}
