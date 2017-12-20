<?php


require dirname( __DIR__ ) . '/vendor/autoload.php';


use igorgrabarski\LCBO;

$lcbo = new LCBO();

 $stores = $lcbo->getStores();

 var_dump($stores[0]);