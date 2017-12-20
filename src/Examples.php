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

//$products = $lcbo->getProducts();
//
//print_r($products);

//$product = $lcbo->getProduct(311787);
//
//print_r($product);

//$inventory = $lcbo->getInventory(329, 518415);
//
//print_r($inventory);

//$inventories = $lcbo->getInventories();
//
//print_r($inventories);

//$dataset = $lcbo->getDataset(2419);
//
//print_r($dataset);

//$datasets = $lcbo->getDatasets();
//
//print_r($datasets);