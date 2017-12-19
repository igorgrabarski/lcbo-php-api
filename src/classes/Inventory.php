<?php

namespace igorgrabarski\classes;


/**
 * An inventory represents the presence of a product at an LCBO store.
 * @package igorgrabarski\classes
 */
class Inventory {

	private $product_id;

	private $store_id;

	private $is_dead;

	private $quantity;

	private $updated_on;

	private $updated_at;

	/**
	 * @return int Product ID
	 */
	public function getProductId() {
		return $this->product_id;
	}

	/**
	 * @param int $product_id
	 */
	public function setProductId( $product_id ) {
		$this->product_id = $product_id;
	}

	/**
	 * @return int Store ID
	 */
	public function getStoreId() {
		return $this->store_id;
	}

	/**
	 * @param int $store_id
	 */
	public function setStoreId( $store_id ) {
		$this->store_id = $store_id;
	}

	/**
	 * @return bool True if this inventory refers to a dead store and/or product
	 */
	public function getisDead() {
		return $this->is_dead;
	}

	/**
	 * @param bool $is_dead
	 */
	public function setIsDead( $is_dead ) {
		$this->is_dead = $is_dead;
	}

	/**
	 * @return int Reported quantity on hand of the product ID at store ID
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * @param int $quantity
	 */
	public function setQuantity( $quantity ) {
		$this->quantity = $quantity;
	}

	/**
	 * @return \DateTime Reported date that quantity was updated
	 */
	public function getUpdatedOn() {
		return $this->updated_on;
	}

	/**
	 * @param \DateTime $updated_on
	 */
	public function setUpdatedOn( $updated_on ) {
		$this->updated_on = $updated_on;
	}

	/**
	 * @return \DateTime Time that this inventory item was updated
	 */
	public function getUpdatedAt() {
		return $this->updated_at;
	}

	/**
	 * @param \DateTime $updated_at
	 */
	public function setUpdatedAt( $updated_at ) {
		$this->updated_at = $updated_at;
	}


}