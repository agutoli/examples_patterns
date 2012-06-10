<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MobileFactory {
    
    private $Mobile;
    
    public function Create($brand)
    {
        switch ($brand) {
            case 'samsung':
                $this->Mobile = new Samsung();
                break;
            case 'nokia':
                $this->Mobile = new Nokia();
                break;
            case 'motorola':
                $this->Mobile = new Motorola();
                break;
            default:
                throw new Exception('Class does not exist!');
        }
    }
}

?>
