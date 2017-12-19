<?php

namespace igorgrabarski\classes;


/**
 * Datasets represent snapshots of all stores, products, and inventories at a given time.
 * They are created once per day and contain information such as the IDs of stores and products
 * that were added and removed since the previous dataset.
 * @package igorgrabarski\classes
 */
class Dataset {

	private $id;

	private $total_products;

	private $total_stores;

	private $total_inventories;

	private $total_product_inventory_count;

	private $total_product_inventory_volume_in_milliliters;

	private $total_product_inventory_price_in_cents;

	private $created_at;

	private $product_ids;

	private $store_ids;

	private $added_product_ids;

	private $added_store_ids;

	private $removed_product_ids;

	private $removed_store_ids;

	private $csv_dump;

	/**
	 * @return int Dataset identifier
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}

	/**
	 * @return int Total unique retail products across all stores
	 */
	public function getTotalProducts() {
		return $this->total_products;
	}

	/**
	 * @param int $total_products
	 */
	public function setTotalProducts( $total_products ) {
		$this->total_products = $total_products;
	}

	/**
	 * @return int Total stores
	 */
	public function getTotalStores() {
		return $this->total_stores;
	}

	/**
	 * @param int $total_stores
	 */
	public function setTotalStores( $total_stores ) {
		$this->total_stores = $total_stores;
	}

	/**
	 * @return int Total inventory items across all stores
	 */
	public function getTotalInventories() {
		return $this->total_inventories;
	}

	/**
	 * @param int $total_inventories
	 */
	public function setTotalInventories( $total_inventories ) {
		$this->total_inventories = $total_inventories;
	}

	/**
	 * @return int Total product units across all stores
	 */
	public function getTotalProductInventoryCount() {
		return $this->total_product_inventory_count;
	}

	/**
	 * @param int $total_product_inventory_count
	 */
	public function setTotalProductInventoryCount( $total_product_inventory_count ) {
		$this->total_product_inventory_count = $total_product_inventory_count;
	}

	/**
	 * @return int Total volume of all product units across all stores
	 */
	public function getTotalProductInventoryVolumeInMilliliters() {
		return $this->total_product_inventory_volume_in_milliliters;
	}

	/**
	 * @param int $total_product_inventory_volume_in_milliliters
	 */
	public function setTotalProductInventoryVolumeInMilliliters( $total_product_inventory_volume_in_milliliters ) {
		$this->total_product_inventory_volume_in_milliliters = $total_product_inventory_volume_in_milliliters;
	}

	/**
	 * @return int Total retail value of all product units across all stores
	 */
	public function getTotalProductInventoryPriceInCents() {
		return $this->total_product_inventory_price_in_cents;
	}

	/**
	 * @param int $total_product_inventory_price_in_cents
	 */
	public function setTotalProductInventoryPriceInCents( $total_product_inventory_price_in_cents ) {
		$this->total_product_inventory_price_in_cents = $total_product_inventory_price_in_cents;
	}

	/**
	 * @return \DateTime The time the dataset was created
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}

	/**
	 * @param \DateTime $created_at
	 */
	public function setCreatedAt( $created_at ) {
		$this->created_at = $created_at;
	}

	/**
	 * @return array List of all active product IDs at the time the dataset was created
	 */
	public function getProductIds() {
		return $this->product_ids;
	}

	/**
	 * @param array $product_ids
	 */
	public function setProductIds( $product_ids ) {
		$this->product_ids = $product_ids;
	}

	/**
	 * @return array List of all active store IDs at the time the dataset was created
	 */
	public function getStoreIds() {
		return $this->store_ids;
	}

	/**
	 * @param array $store_ids
	 */
	public function setStoreIds( $store_ids ) {
		$this->store_ids = $store_ids;
	}

	/**
	 * @return array List of product IDs that were added since the previous update
	 */
	public function getAddedProductIds() {
		return $this->added_product_ids;
	}

	/**
	 * @param array $added_product_ids
	 */
	public function setAddedProductIds( $added_product_ids ) {
		$this->added_product_ids = $added_product_ids;
	}

	/**
	 * @return array List of store IDs that were added since the previous update
	 */
	public function getAddedStoreIds() {
		return $this->added_store_ids;
	}

	/**
	 * @param array $added_store_ids
	 */
	public function setAddedStoreIds( $added_store_ids ) {
		$this->added_store_ids = $added_store_ids;
	}

	/**
	 * @return array List of product IDs that were removed since the previous update
	 */
	public function getRemovedProductIds() {
		return $this->removed_product_ids;
	}

	/**
	 * @param array $removed_product_ids
	 */
	public function setRemovedProductIds( $removed_product_ids ) {
		$this->removed_product_ids = $removed_product_ids;
	}

	/**
	 * @return array List of store IDs that were removed since the previous update
	 */
	public function getRemovedStoreIds() {
		return $this->removed_store_ids;
	}

	/**
	 * @param array $removed_store_ids
	 */
	public function setRemovedStoreIds( $removed_store_ids ) {
		$this->removed_store_ids = $removed_store_ids;
	}

	/**
	 * @return string Contains a path to a ZIP archive of CSV files for stores, products,
	 * and inventories.
	 */
	public function getCsvDump() {
		return $this->csv_dump;
	}

	/**
	 * @param string $csv_dump
	 */
	public function setCsvDump( $csv_dump ) {
		$this->csv_dump = $csv_dump;
	}


}