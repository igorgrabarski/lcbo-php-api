<?php

namespace igorgrabarski;

use DateTime;
use Dotenv\Dotenv;
use Exception;
use igorgrabarski\classes\Dataset;
use igorgrabarski\classes\Inventory;
use igorgrabarski\classes\Product;
use igorgrabarski\classes\Store;
use igorgrabarski\utils\CURLDownloader;
use igorgrabarski\utils\Downloadable;
use igorgrabarski\utils\FileGetContentsDownloader;

// When used as a stand-alone library(not within Laravel),
// uncomment 2 below lines to load variables from .env file
// $dotenv = new Dotenv( dirname( __DIR__ ) );
// $dotenv->load();

/**
 * Class LCBO
 *
 * @copyright LCBO http://www.lcbo.com/
 *
 * @package igorgrabarski
 */
class LCBO {


	/**
	 * @var Downloadable Loader instance
	 */
	private $loader;

	/**
	 * LCBO constructor.
	 * Instantiates a loader. CURLDownloader is preferable.
	 *
	 */
	public function __construct() {
		if ( function_exists( 'curl_init' ) ) {
			$this->loader = new CURLDownloader();
		} else {
			$this->loader = new FileGetContentsDownloader();
		}
	}


	/**
	 * @param int The page number you’d like to return.
	 * @param int The number of objects to include per page. The defaults is 50, and the maximum is 200.
	 *
	 * @param array $where . Allows multiple values. Separate them with a comma like this: where=one,two,three
	 *  Available values:
	 *  is_dead
	 *    has_wheelchair_accessability
	 *    has_bilingual_services
	 *    has_product_consultant
	 *    has_tasting_bar
	 *    has_beer_cold_room
	 *    has_special_occasion_permits
	 *    has_vintages_corner
	 *    has_parking
	 *    has_transit_access
	 *
	 * @param array $where_not . Allows multiple values. Separate them with a comma like this: where_not=one,two,three
	 *  Available values:
	 *  is_dead
	 *    has_wheelchair_accessability
	 *    has_bilingual_services
	 *    has_product_consultant
	 *    has_tasting_bar
	 *    has_beer_cold_room
	 *    has_special_occasion_permits
	 *    has_vintages_corner
	 *    has_parking
	 *    has_transit_access
	 *
	 * @param null $order . Sort the returned stores by one or more of the listed attributes.
	 * Ascending or descending order is specified by adding .asc or .desc to the end of the
	 * attribute name.
	 *  Available values:
	 *  distance_in_meters
	 *    inventory_volume_in_milliliters
	 *    id
	 *    products_count
	 *    inventory_count
	 *    inventory_price_in_cents
	 *
	 * @param null $query . Returns all stores that match the provided full-text search query,
	 * this is purely text-based, look to the lat, lon, and geo parameters for geographical queries.
	 *
	 * @param null $product_id . Returns only stores that have inventory for the specified product.
	 *
	 * @param null $lat
	 * @param null $lon . Returns all stores starting from closest to the specified geographical point.
	 * Adds distance_in_meters attribute to the returned store objects, and defaults to ordering
	 * them by distance_in_meters.asc.
	 *
	 * @param null $geo . Geocodes the provided value, and if successful, returns all stores
	 * in the same manner as above. Subject to aggressive rate-limiting, use lat and lon
	 * whenever possible. Google Maps JavaScript API is excellent for geocoding client-side.
	 *
	 * @return array Array of Store objects.
	 */
	public function getStores(
		$page = 1,
		$per_page = 50,
		$where = null,
		$where_not = null,
		$order = null,
		$query = null,
		$product_id = null,
		$lat = null,
		$lon = null,
		$geo = null
	) {

		$url = getenv( 'URL_STORES' );
		$url .= '?access_key=';
		$url .= getenv( 'API_KEY' );
		$url .= is_null( $page ) || ! is_numeric( $page ) ? '' : ( '&page=' . $page );
		$url .= is_null( $per_page ) || ( $per_page < 50 && $per_page > 200 ) ? '' : ( '&per_page=' . $per_page );
		$url .= is_null( $where_not ) || count( $where ) == 0 ? '' : ( '&where=' . join( ',', $where ) );
		$url .= is_null( $where_not ) || count( $where_not ) == 0 ? '' : ( '&where_not=' . join( ',', $where_not ) );
		$url .= is_null( $order ) ? '' : ( '&order=' . join( ',', $order ) );
		$url .= is_null( $query ) ? '' : ( '&q=' . $query );
		$url .= is_null( $product_id ) ? '' : ( '&product_id=' . $product_id );
		$url .= is_null( $lat ) ? '' : ( '&lat=' . $lat );
		$url .= is_null( $lon ) ? '' : ( '&lon=' . $lon );
		$url .= is_null( $geo ) ? '' : ( '&geo=' . $geo );


		try {
			$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

			$stores = array();

			foreach ( $resultsRaw->result as $result ) {
				array_push( $stores, $this->getStore( null, $result ) );
			}

			return $stores;

		} catch ( Exception $exc ) {
			echo $exc->getMessage();
		}

	}

	/**
	 * @param $id ID of the store.
	 * @param string Optional parameter - result from the getStores() method.
	 *
	 * @return Store Instance of Store.
	 */
	public function getStore( $id, $result = null ) {

		// If we pass $id, e.g. we use this method independently
		// to retrieve the single store object.
		if ( ! is_null( $id ) ) {
			$url = getenv( 'URL_STORE' );
			$url .= is_null( $id ) || ! is_numeric( $id ) ? 1 : $id;
			$url .= '?access_key=';
			$url .= getenv( 'API_KEY' );

			try {
				$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

				$result = $resultsRaw->result;

			} catch ( Exception $exc ) {
				echo $exc->getMessage();
			}
		}

		// Otherwise, we use the $result value, provided by getStores() method.
		$store = new Store();
		$store->setAddressLine1( isset( $result->address_line_1 ) ? $result->address_line_1 : null );
		$store->setAddressLine2( isset( $result->address_line_2 ) ? $result->address_line_2 : null );
		$store->setCity( isset( $result->city ) ? $result->city : null );
		$store->setFax( isset( $result->fax ) ? $result->fax : null );
		$store->setHasBeerColdRoom( isset( $result->has_beer_cold_room ) ? $result->has_beer_cold_room : null );
		$store->setHasBilingualServices( isset( $result->has_bilingual_services ) ? $result->has_bilingual_services : null );
		$store->setHasParking( isset( $result->has_parking ) ? $result->has_parking : null );
		$store->setHasProductConsultant( isset( $result->has_product_consultant ) ? $result->has_product_consultant : null );
		$store->setHasSpecialOccasionPermits( isset( $result->has_special_occasion_permits ) ? $result->has_special_occasion_permits : null );
		$store->setHasTastingBar( isset( $result->has_tasting_bar ) ? $result->has_tasting_bar : null );
		$store->setHasTransitAccess( isset( $result->has_transit_access ) ? $result->has_transit_access : null );
		$store->setHasVintagesCorner( isset( $result->has_vintages_corner ) ? $result->has_vintages_corner : null );
		$store->setHasWheelchairAccessability( isset( $result->has_wheelchair_accessability ) ? $result->has_wheelchair_accessability : null );
		$store->setId( isset( $result->id ) ? $result->id : null );
		$store->setInventoryCount( isset( $result->inventory_count ) ? $result->inventory_count : null );
		$store->setInventoryPriceInCents( isset( $result->inventory_price_in_cents ) ? $result->inventory_price_in_cents : null );
		$store->setInventoryVolumeInMilliliters( isset( $result->inventory_volume_in_milliliters ) ? $result->inventory_volume_in_milliliters : null );
		$store->setIsDead( isset( $result->is_dead ) ? $result->is_dead : null );
		$store->setLatitude( isset( $result->latitude ) ? $result->latitude : null );
		$store->setLongitude( isset( $result->longitude ) ? $result->longitude : null );
		$store->setName( isset( $result->name ) ? $result->name : null );
		$store->setPostalCode( isset( $result->postal_code ) ? $result->postal_code : null );
		$store->setProductsCount( isset( $result->products_count ) ? $result->products_count : null );
		$store->setTags( isset( $result->tags ) ? $result->tags : null );
		$store->setTelephone( isset( $result->telephone ) ? $result->telephone : null );
		$store->setUpdatedAt( isset( $result->updated_at ) ? new DateTime( $result->updated_at ) : null );
		$store->setSundayOpen( isset( $result->sunday_open ) ? $result->monday_open : null );
		$store->setSundayClose( isset( $result->sunday_close ) ? $result->monday_close : null );
		$store->setMondayOpen( isset( $result->monday_open ) ? $result->monday_open : null );
		$store->setMondayClose( isset( $result->monday_close ) ? $result->monday_close : null );
		$store->setTuesdayOpen( isset( $result->tuesday_open ) ? $result->tuesday_open : null );
		$store->setTuesdayClose( isset( $result->tuesday_close ) ? $result->tuesday_close : null );
		$store->setWednesdayOpen( isset( $result->wednesday_open ) ? $result->wednesday_open : null );
		$store->setWednesdayClose( isset( $result->wednesday_close ) ? $result->wednesday_close : null );
		$store->setThursdayOpen( isset( $result->thursday_open ) ? $result->thursday_open : null );
		$store->setThursdayClose( isset( $result->thursday_close ) ? $result->thursday_close : null );
		$store->setFridayOpen( isset( $result->friday_open ) ? $result->friday_open : null );
		$store->setFridayClose( isset( $result->friday_close ) ? $result->friday_close : null );
		$store->setSaturdayOpen( isset( $result->saturday_open ) ? $result->saturday_open : null );
		$store->setSaturdayClose( isset( $result->saturday_close ) ? $result->saturday_close : null );

		return $store;
	}

	/**
	 * @param int The page number you’d like to return.
	 * @param int The number of objects to include per page. The defaults is 50, and the maximum is 200.
	 *
	 * @param array $where . Allows multiple values. Separate them with a comma like this: where=one,two,three
	 *  Available values:
	 *  is_dead
	 *    has_wheelchair_accessability
	 *    has_bilingual_services
	 *    has_product_consultant
	 *    has_tasting_bar
	 *    has_beer_cold_room
	 *    has_special_occasion_permits
	 *    has_vintages_corner
	 *    has_parking
	 *    has_transit_access
	 *
	 * @param array $where_not . Allows multiple values. Separate them with a comma like this: where_not=one,two,three
	 *  Available values:
	 *  is_dead
	 *    has_wheelchair_accessability
	 *    has_bilingual_services
	 *    has_product_consultant
	 *    has_tasting_bar
	 *    has_beer_cold_room
	 *    has_special_occasion_permits
	 *    has_vintages_corner
	 *    has_parking
	 *    has_transit_access
	 *
	 * @param array $order . Sort the returned stores by one or more of the listed attributes.
	 * Ascending or descending order is specified by adding .asc or .desc to the end of the
	 * attribute name.
	 *  Available values:
	 *  distance_in_meters
	 *    inventory_volume_in_milliliters
	 *    id
	 *    products_count
	 *    inventory_count
	 *    inventory_price_in_cents
	 *
	 * @param null $query . Returns all stores that match the provided full-text search query,
	 * this is purely text-based, look to the lat, lon, and geo parameters for geographical queries.
	 *
	 * @param null $store_id . ID of store
	 *
	 * @return array Array of Product objects.
	 */
	public function getProducts(
		$page = 1,
		$per_page = 50,
		$where = null,
		$where_not = null,
		$order = null,
		$query = null,
		$store_id = null
	) {

		$url = getenv( 'URL_PRODUCTS' );
		$url .= '?access_key=';
		$url .= getenv( 'API_KEY' );
		$url .= is_null( $page ) || ! is_numeric( $page ) ? '' : ( '&page=' . $page );
		$url .= is_null( $per_page ) || ( $per_page < 50 && $per_page > 200 ) ? '' : ( '&per_page=' . $per_page );
		$url .= is_null( $where ) || count( $where ) == 0 ? '' : ( '&where=' . join( ',', $where ) );
		$url .= is_null( $where_not ) || count( $where_not ) == 0 ? '' : ( '&where_not=' . join( ',', $where_not ) );
		$url .= is_null( $order ) ? '' : ( '&order=' . join( ',', $order ) );
		$url .= is_null( $query ) ? '' : ( '&q=' . $query );
		$url .= is_null( $store_id ) ? '' : ( '&store_id=' . $store_id );

		try {
			$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

			$products = array();

			foreach ( $resultsRaw->result as $result ) {
				array_push( $products, $this->getProduct( null, $result ) );
			}

			return $products;

		} catch ( Exception $exc ) {
			echo $exc->getMessage();
		}

	}

	/**
	 * @param $id ID of the product
	 * @param string Optional result value from getProducts() method.
	 *
	 * @return Product Instance of Product
	 */
	public function getProduct( $id, $result = null ) {
		if ( ! is_null( $id ) ) {
			$url = getenv( 'URL_PRODUCT' );
			$url .= is_null($id) || !is_numeric($id) ? 1 : $id;
			$url .= '?access_key=';
			$url .= getenv( 'API_KEY' );

			try {
				$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

				$result = $resultsRaw->result;

			} catch ( Exception $exc ) {
				echo $exc->getMessage();
			}
		}

		$product = new Product();
		$product->setAlcoholContent( isset( $result->alcohol_content ) ? $result->alcohol_content : null );
		$product->setBonusRewardMiles( isset( $result->bonus_reward_miles ) ? $result->bonus_reward_miles : null );
		$product->setBonusRewardMilesEndsOn( isset( $result->bonus_reward_miles_ends_on ) ? $result->bonus_reward_miles_ends_on : null );
		$product->setDescription( isset( $result->description ) ? $result->description : null );
		$product->setHasBonusRewardMiles( isset( $result->has_bonus_reward_miles ) ? $result->has_bonus_reward_miles : null );
		$product->setHasLimitedTimeOffer( isset( $result->has_limited_time_offer ) ? $result->has_limited_time_offer : null );
		$product->setHasValueAddedPromotion( isset( $result->has_value_added_promotion ) ? $result->has_value_added_promotion : null );
		$product->setId( isset( $result->id ) ? $result->id : null );
		$product->setInventoryCount( isset( $result->inventory_count ) ? $result->inventory_count : null );
		$product->setInventoryPriceInCents( isset( $result->inventory_price_in_cents ) ? $result->inventory_price_in_cents : null );
		$product->setInventoryVolumeInMilliliters( isset( $result->inventory_volume_in_milliliters ) ? $result->inventory_volume_in_milliliters : null );
		$product->setIsDead( isset( $result->is_dead ) ? $result->is_dead : null );
		$product->setIsDiscontinued( isset( $result->is_discontinued ) ? $result->is_discontinued : null );
		$product->setIsKosher( isset( $result->is_kosher ) ? $result->is_kosher : null );
		$product->setIsSeasonal( isset( $result->is_seasonal ) ? $result->is_seasonal : null );
		$product->setIsVqa( isset( $result->is_vqa ) ? $result->is_vqa : null );
		$product->setIsOcb( isset( $result->is_ocb ) ? $result->is_ocb : null );
		$product->setLimitedTimeOfferEndsOn( isset( $result->limited_time_offer_ends_on ) ? $result->limited_time_offer_ends_on : null );
		$product->setLimitedTimeOfferSavingsInCents( isset( $result->limited_time_offer_savings_in_cents ) ? $result->limited_time_offer_savings_in_cents : null );
		$product->setName( isset( $result->name ) ? $result->name : null );
		$product->setOrigin( isset( $result->origin ) ? $result->origin : null );
		$product->setPackage( isset( $result->package ) ? $result->package : null );
		$product->setPackageUnitType( isset( $result->package_unit_type ) ? $result->package_unit_type : null );
		$product->setPackageUnitVolumeInMilliliters( isset( $result->package_unit_volume_in_milliliters ) ? $result->package_unit_volume_in_milliliters : null );
		$product->setPriceInCents( isset( $result->price_in_cents ) ? $result->price_in_cents : null );
		$product->setPricePerLiterInCents( isset( $result->price_per_liter_in_cents ) ? $result->price_per_liter_in_cents : null );
		$product->setPricePerLiterOfAlcoholInCents( isset( $result->price_per_liter_of_alcohol_in_cents ) ? $result->price_per_liter_of_alcohol_in_cents : null );
		$product->setPrimaryCategory( isset( $result->primary_category ) ? $result->primary_category : null );
		$product->setProducerName( isset( $result->producer_name ) ? $result->producer_name : null );
		$product->setRegularPriceInCents( isset( $result->regular_price_in_cents ) ? $result->regular_price_in_cents : null );
		$product->setReleasedOn( isset( $result->released_on ) ? $result->released_on : null );
		$product->setSecondaryCategory( isset( $result->secondary_category ) ? $result->secondary_category : null );
		$product->setServingSuggestion( isset( $result->serving_suggestion ) ? $result->serving_suggestion : null );
		$product->setStyle( isset( $result->style ) ? $result->style : null );
		$product->setTertiaryCategory( isset( $result->tertiary_category ) ? $result->tertiary_category : null );
		$product->setImageUrl( isset( $result->image_url ) ? $result->image_url : null );
		$product->setImageThumbUrl( isset( $result->image_thumb_url ) ? $result->image_thumb_url : null );
		$product->setStockType( isset( $result->stock_type ) ? $result->stock_type : null );
		$product->setSugarContent( isset( $result->sugar_content ) ? $result->sugar_content : null );
		$product->setSugarInGramsPerLiter( isset( $result->sugar_in_grams_per_liter ) ? $result->sugar_in_grams_per_liter : null );
		$product->setTags( isset( $result->tags ) ? $result->tags : null );
		$product->setTastingNote( isset( $result->tasting_note ) ? $result->tasting_note : null );
		$product->setTotalPackageUnits( isset( $result->total_package_units ) ? $result->total_package_units : null );
		$product->setUpdatedAt( isset( $result->updated_at ) ? $result->updated_at : null );
		$product->setValueAddedPromotionDescription( isset( $result->value_added_promotion_description ) ? $result->value_added_promotion_description : null );
		$product->setVarietal( isset( $result->varietal ) ? $result->varietal : null );
		$product->setVolumeInMilliliters( isset( $result->volume_in_milliliters ) ? $result->volume_in_milliliters : null );

		return $product;
	}

	/**
	 * @param int The page number you’d like to return.
	 * @param int The number of objects to include per page. The defaults is 50, and the maximum is 200.
	 *
	 * @param array $where . Allows multiple values. Separate them with a comma like this: where=one,two,three
	 *  Available values:
	 *  is_dead
	 *    has_wheelchair_accessability
	 *    has_bilingual_services
	 *    has_product_consultant
	 *    has_tasting_bar
	 *    has_beer_cold_room
	 *    has_special_occasion_permits
	 *    has_vintages_corner
	 *    has_parking
	 *    has_transit_access
	 *
	 * @param array $where_not . Allows multiple values. Separate them with a comma like this: where_not=one,two,three
	 *  Available values:
	 *  is_dead
	 *    has_wheelchair_accessability
	 *    has_bilingual_services
	 *    has_product_consultant
	 *    has_tasting_bar
	 *    has_beer_cold_room
	 *    has_special_occasion_permits
	 *    has_vintages_corner
	 *    has_parking
	 *    has_transit_access
	 *
	 * @param null $order . Sort the returned stores by one or more of the listed attributes.
	 * Ascending or descending order is specified by adding .asc or .desc to the end of the
	 * attribute name.
	 *  Available values:
	 *  distance_in_meters
	 *    inventory_volume_in_milliliters
	 *    id
	 *    products_count
	 *    inventory_count
	 *    inventory_price_in_cents
	 *
	 * @param null $query . Returns all stores that match the provided full-text search query,
	 * this is purely text-based, look to the lat, lon, and geo parameters for geographical queries.
	 *
	 * @param null $product_id . Returns only stores that have inventory for the specified product.
	 *
	 * @param null $store_id . ID of the store.
	 *
	 * @return array Array of Inventory objects.
	 */
	public function getInventories(
		$page = 1,
		$per_page = 50,
		$where = null,
		$where_not = null,
		$order = null,
		$query = null,
		$store_id = null,
		$product_id = null
	) {

		$url = getenv( 'URL_INVENTORIES' );
		$url .= '?access_key=';
		$url .= getenv( 'API_KEY' );
		$url .= is_null( $page ) || ! is_numeric( $page ) ? '' : ( '&page=' . $page );
		$url .= is_null( $per_page ) || ( $per_page < 50 && $per_page > 200 ) ? '' : ( '&per_page=' . $per_page );
		$url .= is_null( $where ) || count( $where ) == 0 ? '' : ( '&where=' . join( ',', $where ) );
		$url .= is_null( $where_not ) || count( $where_not ) == 0 ? '' : ( '&where_not=' . join( ',', $where_not ) );
		$url .= is_null( $order ) ? '' : ( '&order=' . join( ',', $order ) );
		$url .= is_null( $query ) ? '' : ( '&q=' . $query );
		$url .= is_null( $store_id ) ? '' : ( '&store_id=' . $store_id );
		$url .= is_null( $product_id ) ? '' : ( '&product_id=' . $product_id );

		try {
			$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

			$inventories = array();

			foreach ( $resultsRaw->result as $result ) {
				array_push( $inventories, $this->getInventory( null, null, $result ) );
			}

			return $inventories;

		} catch ( Exception $exc ) {
			echo $exc->getMessage();
		}
	}

	/**
	 * @param $store_id ID of the store
	 * @param $product_id ID of the product
	 * @param null $result Optional value from getInventories() method.
	 *
	 * @return Inventory Instance of Inventory.
	 */
	public function getInventory( $store_id, $product_id, $result = null ) {
		if ( ! is_null( $store_id ) && ! is_null( $product_id ) ) {
			$url = getenv( 'URL_INVENTORY_1' );
			$url .= is_null($store_id) || !is_numeric($store_id) ? 1 : $store_id;
			$url .= getenv( 'URL_INVENTORY_2' );
			$url .= is_null($product_id) || !is_numeric($product_id) ? 1 : $product_id;
			$url .= getenv( 'URL_INVENTORY_3' );
			$url .= '?access_key=';
			$url .= getenv( 'API_KEY' );

			try {
				$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

				$result = $resultsRaw->result;

			} catch ( Exception $exc ) {
				echo $exc->getMessage();
			}
		}

		$inventory = new Inventory();
		$inventory->setProductId( isset( $result->product_id ) ? $result->product_id : null );
		$inventory->setStoreId( isset( $result->store_id ) ? $result->store_id : null );
		$inventory->setIsDead( isset( $result->is_dead ) ? $result->is_dead : null );
		$inventory->setQuantity( isset( $result->quantity ) ? $result->quantity : null );
		$inventory->setUpdatedOn( isset( $result->updated_on ) ? $result->updated_on : null );
		$inventory->setUpdatedAt( isset( $result->updated_at ) ? $result->updated_at : null );

		return $inventory;
	}

	/**
	 * @param int $page . The page number you’d like to return.
	 *
	 * @param int $per_page . The number of objects to include per page.
	 * The defaults is 20, and the maximum is 50.
	 *
	 * @param null $order . Sort the returned datasets by one or more of the listed attributes.
	 * Ascending or descending order is specified by adding .asc or .desc to the end of
	 * the attribute name.
	 *  Available values:
	 *  id
	 *    created_at
	 *    total_products
	 *    total_stores
	 *    total_inventories
	 *    total_product_inventory_count
	 *    total_product_inventory_volume_in_milliliters
	 *    total_product_inventory_price_in_cents
	 *
	 * @return array Array of Dataset objects.
	 */
	public function getDatasets(
		$page = 1,
		$per_page = 50,
		$order = null
	) {

		$url = getenv( 'URL_DATASETS' );
		$url .= '?access_key=';
		$url .= getenv( 'API_KEY' );
		$url .= is_null( $page ) || ! is_numeric( $page ) ? '' : ( '&page=' . $page );
		$url .= is_null( $per_page ) || ( $per_page < 50 && $per_page > 200 ) ? '' : ( '&per_page=' . $per_page );
		$url .= is_null( $order ) ? '' : ( '&order=' . join( ',', $order ) );

		try {
			$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

			$datasets = array();

			foreach ( $resultsRaw->result as $result ) {
				array_push( $datasets, $this->getDataset( null, $result ) );
			}

			return $datasets;

		} catch ( Exception $exc ) {
			echo $exc->getMessage();
		}

	}


	/**
	 * @param $id ID of the dataset.
	 * @param null $result . Optional result value from getDatasets() method.
	 *
	 * @return Dataset. Instance of Dataset.
	 */
	public function getDataset( $id, $result = null ) {
		if ( ! is_null( $id ) ) {
			$url = getenv( 'URL_DATASET' );
			$url .= is_null($id) || !is_numeric($id) ? 1 : $id;
			$url .= '?access_key=';
			$url .= getenv( 'API_KEY' );

			try {
				$resultsRaw = json_decode( $this->loader->downloadRaw( $url ) );

				$result = $resultsRaw->result;

			} catch ( Exception $exc ) {
				echo $exc->getMessage();
			}
		}

		$dataset = new Dataset();
		$dataset->setId( isset( $result->id ) ? $result->id : null );
		$dataset->setTotalProducts( isset( $result->total_products ) ? $result->total_products : null );
		$dataset->setTotalStores( isset( $result->total_stores ) ? $result->total_stores : null );
		$dataset->setTotalInventories( isset( $result->total_inventories ) ? $result->total_inventories : null );
		$dataset->setTotalProductInventoryCount( isset( $result->total_product_inventory_count ) ? $result->total_product_inventory_count : null );
		$dataset->setTotalProductInventoryVolumeInMilliliters( isset( $result->total_product_inventory_volume_in_milliliters ) ? $result->total_product_inventory_volume_in_milliliters : null );
		$dataset->setTotalProductInventoryPriceInCents( isset( $result->total_product_inventory_price_in_cents ) ? $result->total_product_inventory_price_in_cents : null );
		$dataset->setCreatedAt( isset( $result->created_at ) ? $result->created_at : null );
		$dataset->setProductIds( isset( $result->product_ids ) ? $result->product_ids : null );
		$dataset->setStoreIds( isset( $result->store_ids ) ? $result->store_ids : null );
		$dataset->setAddedProductIds( isset( $result->added_product_ids ) ? $result->added_product_ids : null );
		$dataset->setAddedStoreIds( isset( $result->added_store_ids ) ? $result->added_store_ids : null );
		$dataset->setRemovedProductIds( isset( $result->removed_product_ids ) ? $result->removed_product_ids : null );
		$dataset->setRemovedStoreIds( isset( $result->removed_store_ids ) ? $result->removed_store_ids : null );
		$dataset->setCsvDump( isset( $result->csv_dump ) ? $result->csv_dump : null );

		return $dataset;
	}
}
