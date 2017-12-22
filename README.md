### PHP wrapper for [official LCBO API](https://lcboapi.com)

#### Installation:
* Install dependencies: `composer install`
* Get API_KEY from [here](https://lcboapi.com/manager/keys)
* Add your API_KEY to `vendor/igorgrabarski/lcbo-php-api/.env.example` file.
* Rename `vendor/igorgrabarski/lcbo-php-api/.env.example`
file to `vendor/igorgrabarski/lcbo-php-api/.env`

#### Usage
* Add composer's autoloader to your file:
    `require dirname( __DIR__ ) . '/vendor/autoload.php';`
* Create an instance of LCBO class:
    `$lcbo = new igorgrabarski\LCBO();`
* Available methods:
  - $lcbo->getStores($params);
  - $lcbo->getStore($id);
  - $lcbo->getProducts($params);
  - $lcbo->getProduct($id);
  - $lcbo->getInventories($params);
  - $lcbo->getInventory($store_id, $product_id);
  - $lcbo->getDatasets($params);
  - $lcbo->getDataset($id);
  
* Get additional information [here](https://lcboapi.com/docs/v1).