<?php

namespace igorgrabarski;

use DateTime;
use Dotenv\Dotenv;
use Exception;
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

	public function getProducts() {

	}

	public function getProduct() {

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








