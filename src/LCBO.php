<?php

namespace igorgrabarski;

use DateTime;
use Dotenv\Dotenv;
use Exception;
use igorgrabarski\classes\Product;
use igorgrabarski\classes\Store;
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


	private $downloader;

	/**
	 * LCBO constructor.
	 *
	 */
	public function __construct() {
		if ( function_exists( 'curl_init' ) ) {
			$this->loader = new CURLDownloader();
		} else {
			$this->loader = new FileGetContentsDownloader();
		}
	}


	public function getStores(
		$page = 1,
		$per_page = 50,
		$where = array(),
		$where_not = array(),
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
		$url .= ! is_numeric( $page ) ? '' : ( '&page=' . $page );
		$url .= ( $per_page < 50 && $per_page > 200 ) ? '' : ( '&per_page=' . $per_page );
		$url .= count( $where ) == 0 ? '' : ( '&where=' . join( ',', $where ) );
		$url .= count( $where_not ) == 0 ? '' : ( '&where_not=' . join( ',', $where_not ) );
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

	public function getStore( $id, $result = null ) {

		// If we pass $id, e.g. we use this method independently
		// to retrieve the single store object.
		if ( !is_null( $id ) ) {
			$url = getenv( 'URL_STORE' );
			$url .= $id;
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

	public function getProducts(
		$page = 1,
		$per_page = 50,
		$where = array(),
		$where_not = array(),
		$order = null,
		$query = null,
		$store_id = null
	) {

		$url = getenv( 'URL_PRODUCTS' );
		$url .= '?access_key=';
		$url .= getenv( 'API_KEY' );
		$url .= ! is_numeric( $page ) ? '' : ( '&page=' . $page );
		$url .= ( $per_page < 50 && $per_page > 200 ) ? '' : ( '&per_page=' . $per_page );
		$url .= count( $where ) == 0 ? '' : ( '&where=' . join( ',', $where ) );
		$url .= count( $where_not ) == 0 ? '' : ( '&where_not=' . join( ',', $where_not ) );
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

	public function getProduct($id, $result = null ) {
		if ( !is_null( $id ) ) {
			$url = getenv( 'URL_PRODUCT' );
			$url .= $id;
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

	public function getInventories() {

	}

	public function getInventory() {

	}

	public function getDatasets() {

	}

	public function getDataset() {

	}
}








