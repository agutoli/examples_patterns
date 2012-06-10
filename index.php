<?php

include 'MobileStore.php';
include 'Factory/MobileFactory.php';
include 'Factory/MobileFactory/Samsung.php';
include 'Factory/MobileFactory/Nokia.php';
include 'Factory/MobileFactory/Motorola.php';

$store = new MobileStore();
$store->Buy('samsung');
$store->Buy('nokia');
$store->Buy('motorola');



