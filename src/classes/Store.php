<?php

namespace igorgrabarski\classes;
use igorgrabarski\utils\Metadata;


/**
 * The store object represents a physical LCBO location.
 * @package igorgrabarski\classes
 */
class Store {

	private $address_line_1;

	private $address_line_2;

	private $city;

	private $fax;

	private $has_beer_cold_room;

	private $has_bilingual_services;

	private $has_parking;

	private $has_product_consultant;

	private $has_special_occasion_permits;

	private $has_tasting_bar;

	private $has_transit_access;

	private $has_vintages_corner;

	private $has_wheelchair_accessability;

	private $id;

	private $inventory_count;

	private $inventory_price_in_cents;

	private $inventory_volume_in_milliliters;

	private $is_dead;

	private $latitude;

	private $longitude;

	private $name;

	private $postal_code;

	private $products_count;

	private $close;

	private $open;

	private $tags;

	private $telephone;

	private $updated_at;

	private $sunday_open;

	private $sunday_close;

	private $monday_open;

	private $monday_close;

	private $tuesday_open;

	private $tuesday_close;

	private $wednesday_open;

	private $wednesday_close;

	private $thursday_open;

	private $thursday_close;

	private $friday_open;

	private $friday_close;

	private $saturday_open;

	private $saturday_close;


	/**
	 * @return string Street address
	 */
	public function getAddressLine1() {
		return $this->address_line_1;
	}

	/**
	 * @param string $address_line_1
	 *
	 */
	public function setAddressLine1( $address_line_1 ) {
		$this->address_line_1 = $address_line_1;
	}

	/**
	 * @return string Secondary address information (Not all stores)
	 */
	public function getAddressLine2() {
		return $this->address_line_2;
	}

	/**
	 * @param string $address_line_2
	 *
	 */
	public function setAddressLine2( $address_line_2 ) {
		$this->address_line_2 = $address_line_2;
	}

	/**
	 * @return string City the store is in
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param string $city
	 *
	 */
	public function setCity( $city ) {
		$this->city = $city;
	}

	/**
	 * @return string Fax number (not all stores have one)
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * @param string $fax
	 *
	 */
	public function setFax( $fax ) {
		$this->fax = $fax;
	}

	/**
	 * @return bool True if the store has a walk-in beer fridge
	 */
	public function getHasBeerColdRoom() {
		return $this->has_beer_cold_room;
	}

	/**
	 * @param bool $has_beer_cold_room
	 *
	 */
	public function setHasBeerColdRoom( $has_beer_cold_room ) {
		$this->has_beer_cold_room = $has_beer_cold_room;
	}

	/**
	 * @return bool True if the store has bilingual services
	 */
	public function getHasBilingualServices() {
		return $this->has_bilingual_services;
	}

	/**
	 * @param bool $has_bilingual_services
	 *
	 */
	public function setHasBilingualServices( $has_bilingual_services ) {
		$this->has_bilingual_services = $has_bilingual_services;
	}

	/**
	 * @return bool True if the store has a parking lot
	 */
	public function getHasParking() {
		return $this->has_parking;
	}

	/**
	 * @param bool $has_parking
	 *
	 */
	public function setHasParking( $has_parking ) {
		$this->has_parking = $has_parking;
	}

	/**
	 * @return bool True if the store has a product consultant on staff
	 */
	public function getHasProductConsultant() {
		return $this->has_product_consultant;
	}

	/**
	 * @param bool $has_product_consultant
	 *
	 */
	public function setHasProductConsultant( $has_product_consultant ) {
		$this->has_product_consultant = $has_product_consultant;
	}

	/**
	 * @return bool True if the store can issue special occasion permits
	 */
	public function getHasSpecialOccasionPermits() {
		return $this->has_special_occasion_permits;
	}

	/**
	 * @param mixed $has_special_occasion_permits
	 *
	 */
	public function setHasSpecialOccasionPermits( $has_special_occasion_permits ) {
		$this->has_special_occasion_permits = $has_special_occasion_permits;
	}

	/**
	 * @return bool True if the store has a tasting bar
	 */
	public function getHasTastingBar() {
		return $this->has_tasting_bar;
	}

	/**
	 * @param mixed $has_tasting_bar
	 *
	 */
	public function setHasTastingBar( $has_tasting_bar ) {
		$this->has_tasting_bar = $has_tasting_bar;
	}

	/**
	 * @return bool True if the store is accessible by public transit
	 */
	public function getHasTransitAccess() {
		return $this->has_transit_access;
	}

	/**
	 * @param mixed $has_transit_access
	 *
	 */
	public function setHasTransitAccess( $has_transit_access ) {
		$this->has_transit_access = $has_transit_access;
	}

	/**
	 * @return bool True if the store has a Vintages area
	 */
	public function getHasVintagesCorner() {
		return $this->has_vintages_corner;
	}

	/**
	 * @param mixed $has_vintages_corner
	 *
	 */
	public function setHasVintagesCorner( $has_vintages_corner ) {
		$this->has_vintages_corner = $has_vintages_corner;
	}

	/**
	 * @return bool True if the store can be entered via wheelchair
	 */
	public function getHasWheelchairAccessability() {
		return $this->has_wheelchair_accessability;
	}

	/**
	 * @param bool $has_wheelchair_accessability
	 *
	 */
	public function setHasWheelchairAccessability( $has_wheelchair_accessability ) {
		$this->has_wheelchair_accessability = $has_wheelchair_accessability;
	}

	/**
	 * @return int LCBO store number
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 *
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return int Total inventory units at the store
	 */
	public function getInventoryCount() {
		return $this->inventory_count;
	}

	/**
	 * @param int $inventory_count
	 *
	 */
	public function setInventoryCount( $inventory_count ) {
		$this->inventory_count = $inventory_count;
	}

	/**
	 * @return int Total retail value of all products at the store
	 */
	public function getInventoryPriceInCents() {
		return $this->inventory_price_in_cents;
	}

	/**
	 * @param mixed $inventory_price_in_cents
	 *
	 */
	public function setInventoryPriceInCents( $inventory_price_in_cents ) {
		$this->inventory_price_in_cents = $inventory_price_in_cents;
	}

	/**
	 * @return int Total volume of all products at the store
	 */
	public function getInventoryVolumeInMilliliters() {
		return $this->inventory_volume_in_milliliters;
	}

	/**
	 * @param mixed $inventory_volume_in_milliliters
	 *
	 */
	public function setInventoryVolumeInMilliliters( $inventory_volume_in_milliliters ) {
		$this->inventory_volume_in_milliliters = $inventory_volume_in_milliliters;
	}

	/**
	 * @return bool When a store is removed it is marked as “dead”
	 */
	public function getisDead() {
		return $this->is_dead;
	}

	/**
	 * @param bool $is_dead
	 *
	 */
	public function setIsDead( $is_dead ) {
		$this->is_dead = $is_dead;
	}

	/**
	 * @return float Reported latitude
	 */
	public function getLatitude() {
		return $this->latitude;
	}

	/**
	 * @param float $latitude
	 *
	 */
	public function setLatitude( $latitude ) {
		$this->latitude = $latitude;
	}

	/**
	 * @return float Reported longitude
	 */
	public function getLongitude() {
		return $this->longitude;
	}

	/**
	 * @param float $longitude
	 *
	 */
	public function setLongitude( $longitude ) {
		$this->longitude = $longitude;
	}

	/**
	 * @return string Official LCBO store name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 *
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return string Postal code
	 */
	public function getPostalCode() {
		return $this->postal_code;
	}

	/**
	 * @param string $postal_code
	 *
	 */
	public function setPostalCode( $postal_code ) {
		$this->postal_code = $postal_code;
	}

	/**
	 * @return int Total unique products at the store
	 */
	public function getProductsCount() {
		return $this->products_count;
	}

	/**
	 * @param int $products_count
	 *
	 */
	public function setProductsCount( $products_count ) {
		$this->products_count = $products_count;
	}

	/**
	 * @return int Minutes since midnight that the store closes
	 */
	public function getClose() {
		return $this->close;
	}

	/**
	 * @param int $close
	 *
	 */
	public function setClose( $close ) {
		$this->close = $close;
	}

	/**
	 * @return int Minutes since midnight that the store opens
	 */
	public function getOpen() {
		return $this->open;
	}

	/**
	 * @param int $open
	 *
	 */
	public function setOpen( $open ) {
		$this->open = $open;
	}

	/**
	 * @return string A string of tags that reflect the store
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * @param string $tags
	 *
	 */
	public function setTags( $tags ) {
		$this->tags = $tags;
	}

	/**
	 * @return string Telephone number
	 */
	public function getTelephone() {
		return $this->telephone;
	}

	/**
	 * @param string $telephone
	 *
	 */
	public function setTelephone( $telephone ) {
		$this->telephone = $telephone;
	}

	/**
	 * @return \DateTime Time that the store information was updated
	 */
	public function getUpdatedAt() {
		return $this->updated_at;
	}

	/**
	 * @param \DateTime $updated_at
	 *
	 */
	public function setUpdatedAt( $updated_at ) {
		$this->updated_at = $updated_at;
	}

	/**
	 * @return mixed
	 */
	public function getSundayOpen() {
		return $this->sunday_open;
	}

	/**
	 * @param mixed $sunday_open
	 */
	public function setSundayOpen( $sunday_open ) {
		$this->sunday_open = $sunday_open;
	}

	/**
	 * @return mixed
	 */
	public function getSundayClose() {
		return $this->sunday_close;
	}

	/**
	 * @param mixed $sunday_close
	 */
	public function setSundayClose( $sunday_close ) {
		$this->sunday_close = $sunday_close;
	}

	/**
	 * @return mixed
	 */
	public function getMondayOpen() {
		return $this->monday_open;
	}

	/**
	 * @param mixed $monday_open
	 */
	public function setMondayOpen( $monday_open ) {
		$this->monday_open = $monday_open;
	}

	/**
	 * @return mixed
	 */
	public function getMondayClose() {
		return $this->monday_close;
	}

	/**
	 * @param mixed $monday_close
	 */
	public function setMondayClose( $monday_close ) {
		$this->monday_close = $monday_close;
	}

	/**
	 * @return mixed
	 */
	public function getTuesdayOpen() {
		return $this->tuesday_open;
	}

	/**
	 * @param mixed $tuesday_open
	 */
	public function setTuesdayOpen( $tuesday_open ) {
		$this->tuesday_open = $tuesday_open;
	}

	/**
	 * @return mixed
	 */
	public function getTuesdayClose() {
		return $this->tuesday_close;
	}

	/**
	 * @param mixed $tuesday_close
	 */
	public function setTuesdayClose( $tuesday_close ) {
		$this->tuesday_close = $tuesday_close;
	}

	/**
	 * @return mixed
	 */
	public function getWednesdayOpen() {
		return $this->wednesday_open;
	}

	/**
	 * @param mixed $wednesday_open
	 */
	public function setWednesdayOpen( $wednesday_open ) {
		$this->wednesday_open = $wednesday_open;
	}

	/**
	 * @return mixed
	 */
	public function getWednesdayClose() {
		return $this->wednesday_close;
	}

	/**
	 * @param mixed $wednesday_close
	 */
	public function setWednesdayClose( $wednesday_close ) {
		$this->wednesday_close = $wednesday_close;
	}

	/**
	 * @return mixed
	 */
	public function getThursdayOpen() {
		return $this->thursday_open;
	}

	/**
	 * @param mixed $thursday_open
	 */
	public function setThursdayOpen( $thursday_open ) {
		$this->thursday_open = $thursday_open;
	}

	/**
	 * @return mixed
	 */
	public function getThursdayClose() {
		return $this->thursday_close;
	}

	/**
	 * @param mixed $thursday_close
	 */
	public function setThursdayClose( $thursday_close ) {
		$this->thursday_close = $thursday_close;
	}

	/**
	 * @return mixed
	 */
	public function getFridayOpen() {
		return $this->friday_open;
	}

	/**
	 * @param mixed $friday_open
	 */
	public function setFridayOpen( $friday_open ) {
		$this->friday_open = $friday_open;
	}

	/**
	 * @return mixed
	 */
	public function getFridayClose() {
		return $this->friday_close;
	}

	/**
	 * @param mixed $friday_close
	 */
	public function setFridayClose( $friday_close ) {
		$this->friday_close = $friday_close;
	}

	/**
	 * @return mixed
	 */
	public function getSaturdayOpen() {
		return $this->saturday_open;
	}

	/**
	 * @param mixed $saturday_open
	 */
	public function setSaturdayOpen( $saturday_open ) {
		$this->saturday_open = $saturday_open;
	}

	/**
	 * @return mixed
	 */
	public function getSaturdayClose() {
		return $this->saturday_close;
	}

	/**
	 * @param mixed $saturday_close
	 */
	public function setSaturdayClose( $saturday_close ) {
		$this->saturday_close = $saturday_close;
	}
}