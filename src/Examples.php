<?php


// Add composer's autoloader
require dirname( __DIR__ ) . '/vendor/autoload.php';

use igorgrabarski\LCBO;

// Add your API_KEY in .env file!!!

// Create instance of LCBO class
$lcbo = new LCBO();

//// Get all stores
//$stores = $lcbo->getStores();
//print_r($stores);
//
//// Get particular store by id
//$store = $lcbo->getStore(31);
//print_r($store);

// Get all products
//$products = $lcbo->getProducts();
//print_r($products);

//// Get particular product by id
//$product = $lcbo->getProduct(311787);
//print_r($product);

//// Get inventory by store_id and product_id
//$inventory = $lcbo->getInventory(329, 518415);
//print_r($inventory);
//
//// Get all inventories
//$inventories = $lcbo->getInventories();
//print_r($inventories);
//
//// Get dataset by id
//$dataset = $lcbo->getDataset(2419);
//print_r($dataset);
//
//// Get all datasets
//$datasets = $lcbo->getDatasets();
//print_r($datasets);