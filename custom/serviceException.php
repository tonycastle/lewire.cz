<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServiceException
 *
 * @author tony
 */
namespace custom;

class serviceException extends \Exception{
    //0 is off
    //1 is on
    private  $reporting = 1;

    public function __construct($errorArray){
        if($this->reporting == 0){
            echo "Sorry there was a problem and your request could not be completed.";
        }else{
           print_r($errorArray);
        }
    }
}
?>
