<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//interface 
include 'MobileFactory/MobileInterface.php';

class MobileFactory {
    
    public function Create($brand)
    {
         //class name
        $className = ucwords($brand);
        $filename  = "MobileFactory/{$className}.php";
        
        //autoload
        if ( ! class_exists($className)) {
            try {
                include $filename;
            } catch(Exception $e) {
                throw new Exception('class not found');
            }
        }
        
        //instance of class 
        $mobile = new $className;       
 
        if ( ! $mobile instanceof MobileInterface ) {
            throw new Exception('class must be of type "MobileInterface"');
        }

        return $mobile;
    }
}

?>
