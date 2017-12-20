<?php


require dirname( __DIR__ ) . '/vendor/autoload.php';


use igorgrabarski\classes\Store;
use igorgrabarski\LCBO;

$lcbo = new LCBO();

 $stores = $lcbo->getStores();

 print_r($stores);

//$store = $lcbo->getStore(31);
//
//print_r($store);

