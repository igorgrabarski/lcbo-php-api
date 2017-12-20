<?php

namespace igorgrabarski;

use Dotenv\Dotenv;
use Exception;
use igorgrabarski\utils\CURLDownloader;
use igorgrabarski\utils\FileGetContentsDownloader;

// Composer autoloader
require dirname( __DIR__ ) . '/vendor/autoload.php';
//
$dotenv = new Dotenv( dirname( __DIR__ ) );
$dotenv->load();

/**
 * Class LCBO
 * @package igorgrabarski
 */
class LCBO {


	public function getStores(){

	}

	public function getStore(){

	}

	public function getProducts(){

	}

	public function getProduct(){

	}

	public function getInventories(){

	}

	public function getInventory(){

	}

	public function getDatasets(){

	}

	public function getDataset(){

	}
}













/*try{
	if(function_exists('curl_init')){
		$loader = new CURLDownloader(null);
	}
	else {
		$loader = new FileGetContentsDownloader();
	}

	echo $loader->downloadRaw(getenv( 'URL_STORES' ) .
	                          '?access_key=' .
	                          getenv( 'API_KEY' ) );
}
catch (Exception $exc){
	echo $exc->getMessage();
}*/









