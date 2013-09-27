<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

namespace custom;

class Translator {
    
    private $_log;
    private $_path;
    private $_defaultLanguage;
    private $_selectedLang;
    /**
     * 
     * @param string $path path to dir with language files
     * @param type $log
     */
    public function __construct($path, $log="") {
       // $this->_log = log;
        if(is_dir($path)){
            //format path TODO make sure this is operating system friendly.
            $path = rtrim($path, '/').'/';
            $this->_path = $path;
        }else{
            throw new \RuntimeException("$path not found");
        }
    }
    
    /**
     * 
     * @param string $lang
     */
    public function setDefaultLanguage($lang){
        $this->_defaultLanguage = $lang;
    }
    
    public function setLang($lang) {
        $this->_selectedLang = $lang;
    }
    
    public function getLang() {
        return $this->_selectedLang;
    }
    
    public function getDefaultLang() {
        return $this->_defaultLanguage;
    }
    
    //TODO - make the translator work with adapters eg one for text translations in files or xml / database / array(already written
    //check the zf translation adapters for tips
    public function translate($text){
        if(!is_string($text)){
            throw new \RuntimeException("The translator only accepts strings. Object of type {gettype($text)} supplied.");
        }
        //if a language is selected and the lang is not the same as the default lang - translate it otherwise do nothing
        if(isset($this->_selectedLang)&&($this->_selectedLang != $this->_defaultLanguage)){
            include_once $this->_path.$this->_selectedLang.'.php';
            if(array_key_exists($text, $translations)){
                return $translations[$text];
            }
        }
        return $text;
    }
}

?>
