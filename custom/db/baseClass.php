<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of baseClass
 *
 * @author tony
 */
namespace custom\db;

abstract class baseClass {
    protected $_db;
      
     public function  __construct() {
        $this->_db = \Slim\Slim::getInstance()->db;
    }
}
?>
