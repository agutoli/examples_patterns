<?php

//dependence
include 'Factory/MobileFactory.php';

class MobileStore 
{
    private $MobileFactory = Null;

    public function __construct() 
    {
        $this->MobileFactory = new MobileFactory();
    }

    public function Buy($brand) 
    {
        $this->MobileFactory->Create( $brand );
    }
}

?>
