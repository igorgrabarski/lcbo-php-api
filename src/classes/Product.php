<?php

namespace igorgrabarski\classes;


/**
 * The product object represents a product in the LCBO catalog.
 * @package igorgrabarski\classes
 */
class Product {
	private $alcohol_content;

	private $bonus_reward_miles;

	private $bonus_reward_miles_ends_on;

	private $description;

	private $has_bonus_reward_miles;

	private $has_limited_time_offer;

	private $has_value_added_promotion;

	private $id;

	private $inventory_count;

	private $inventory_price_in_cents;

	private $inventory_volume_in_milliliters;

	private $is_dead;

	private $is_discontinued;

	private $is_kosher;

	private $is_seasonal;

	private $is_vqa;

	private $is_ocb;

	private $limited_time_offer_ends_on;

	private $limited_time_offer_savings_in_cents;

	private $name;

	private $origin;

	private $package;

	private $package_unit_type;

	private $package_unit_volume_in_milliliters;

	private $price_in_cents;

	private $price_per_liter_in_cents;

	private $price_per_liter_of_alcohol_in_cents;

	private $primary_category;

	private $producer_name;

	private $regular_price_in_cents;

	private $released_on;

	private $secondary_category;

	private $serving_suggestion;

	private $style;

	private $tertiary_category;

	private $image_url;

	private $image_thumb_url;

	private $stock_type;

	private $sugar_content;

	private $sugar_in_grams_per_liter;

	private $tags;

	private $tasting_note;

	private $total_package_units;

	private $updated_at;

	private $value_added_promotion_description;

	private $varietal;

	private $volume_in_milliliters;

	/**
	 * @return int Alcohol content (Divide by 100 for decimal value)
	 */
	public function getAlcoholContent() {
		return $this->alcohol_content;
	}

	/**
	 * @param int $alcohol_content
	 */
	public function setAlcoholContent( $alcohol_content ) {
		$this->alcohol_content = $alcohol_content;
	}

	/**
	 * @return int Number of bonus air miles
	 */
	public function getBonusRewardMiles() {
		return $this->bonus_reward_miles;
	}

	/**
	 * @param int $bonus_reward_miles
	 */
	public function setBonusRewardMiles( $bonus_reward_miles ) {
		$this->bonus_reward_miles = $bonus_reward_miles;
	}

	/**
	 * @return \DateTime When bonus air miles are no longer valid
	 */
	public function getBonusRewardMilesEndsOn() {
		return $this->bonus_reward_miles_ends_on;
	}

	/**
	 * @param \DateTime $bonus_reward_miles_ends_on
	 */
	public function setBonusRewardMilesEndsOn( $bonus_reward_miles_ends_on ) {
		$this->bonus_reward_miles_ends_on = $bonus_reward_miles_ends_on;
	}


	/**
	 * @return string Product description (not available for all products)
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return bool True if the product has bonus air miles
	 */
	public function getHasBonusRewardMiles() {
		return $this->has_bonus_reward_miles;
	}

	/**
	 * @param bool $has_bonus_reward_miles
	 */
	public function setHasBonusRewardMiles( $has_bonus_reward_miles ) {
		$this->has_bonus_reward_miles = $has_bonus_reward_miles;
	}


	/**
	 * @return bool True if the product is on sale
	 */
	public function getHasLimitedTimeOffer() {
		return $this->has_limited_time_offer;
	}

	/**
	 * @param bool $has_limited_time_offer
	 */
	public function setHasLimitedTimeOffer( $has_limited_time_offer ) {
		$this->has_limited_time_offer = $has_limited_time_offer;
	}

	/**
	 * @return bool True if the product has a value added promotion
	 */
	public function getHasValueAddedPromotion() {
		return $this->has_value_added_promotion;
	}

	/**
	 * @param bool $has_value_added_promotion
	 */
	public function setHasValueAddedPromotion( $has_value_added_promotion ) {
		$this->has_value_added_promotion = $has_value_added_promotion;
	}

	/**
	 * @return int The LCBO product ID / number
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
	 * @return int Total units across all stores
	 */
	public function getInventoryCount() {
		return $this->inventory_count;
	}

	/**
	 * @param int $inventory_count
	 */
	public function setInventoryCount( $inventory_count ) {
		$this->inventory_count = $inventory_count;
	}

	/**
	 * @return int Total retail price of all units across all stores
	 */
	public function getInventoryPriceInCents() {
		return $this->inventory_price_in_cents;
	}

	/**
	 * @param int $inventory_price_in_cents
	 */
	public function setInventoryPriceInCents( $inventory_price_in_cents ) {
		$this->inventory_price_in_cents = $inventory_price_in_cents;
	}

	/**
	 * @return int Total volume of all units across all stores
	 */
	public function getInventoryVolumeInMilliliters() {
		return $this->inventory_volume_in_milliliters;
	}

	/**
	 * @param int $inventory_volume_in_milliliters
	 */
	public function setInventoryVolumeInMilliliters( $inventory_volume_in_milliliters ) {
		$this->inventory_volume_in_milliliters = $inventory_volume_in_milliliters;
	}

	/**
	 * @return bool When products are removed from the LCBO catalog they are marked as “dead”
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
	 * @return bool True if the product has been marked as discontinued by the LCBO
	 */
	public function getisDiscontinued() {
		return $this->is_discontinued;
	}

	/**
	 * @param bool $is_discontinued
	 */
	public function setIsDiscontinued( $is_discontinued ) {
		$this->is_discontinued = $is_discontinued;
	}

	/**
	 * @return bool True if the product is designated as Kosher.
	 */
	public function getisKosher() {
		return $this->is_kosher;
	}

	/**
	 * @param bool $is_kosher
	 */
	public function setIsKosher( $is_kosher ) {
		$this->is_kosher = $is_kosher;
	}

	/**
	 * @return bool True if the product is designated as seasonal
	 */
	public function getisSeasonal() {
		return $this->is_seasonal;
	}

	/**
	 * @param bool $is_seasonal
	 */
	public function setIsSeasonal( $is_seasonal ) {
		$this->is_seasonal = $is_seasonal;
	}

	/**
	 * @return bool True if the product is designated as VQA
	 */
	public function getisVqa() {
		return $this->is_vqa;
	}

	/**
	 * @param bool $is_vqa
	 */
	public function setIsVqa( $is_vqa ) {
		$this->is_vqa = $is_vqa;
	}

	/**
	 * @return bool True if the product is produced by a member of the Ontario Craft Brewers
	 */
	public function getisOcb() {
		return $this->is_ocb;
	}

	/**
	 * @param bool $is_ocb
	 */
	public function setIsOcb( $is_ocb ) {
		$this->is_ocb = $is_ocb;
	}

	/**
	 * @return \DateTime When the sale price is no longer valid
	 */
	public function getLimitedTimeOfferEndsOn() {
		return $this->limited_time_offer_ends_on;
	}

	/**
	 * @param \DateTime $limited_time_offer_ends_on
	 */
	public function setLimitedTimeOfferEndsOn( $limited_time_offer_ends_on ) {
		$this->limited_time_offer_ends_on = $limited_time_offer_ends_on;
	}

	/**
	 * @return int Savings in cents if on sale
	 */
	public function getLimitedTimeOfferSavingsInCents() {
		return $this->limited_time_offer_savings_in_cents;
	}

	/**
	 * @param int $limited_time_offer_savings_in_cents
	 */
	public function setLimitedTimeOfferSavingsInCents( $limited_time_offer_savings_in_cents ) {
		$this->limited_time_offer_savings_in_cents = $limited_time_offer_savings_in_cents;
	}

	/**
	 * @return string Product name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return string Country of origin / manufacture
	 */
	public function getOrigin() {
		return $this->origin;
	}

	/**
	 * @param string $origin
	 */
	public function setOrigin( $origin ) {
		$this->origin = $origin;
	}

	/**
	 * @return string Full package description
	 */
	public function getPackage() {
		return $this->package;
	}

	/**
	 * @param string $package
	 */
	public function setPackage( $package ) {
		$this->package = $package;
	}

	/**
	 * @return string Package unit type (bottle, can, etc.)
	 */
	public function getPackageUnitType() {
		return $this->package_unit_type;
	}

	/**
	 * @param string $package_unit_type
	 */
	public function setPackageUnitType( $package_unit_type ) {
		$this->package_unit_type = $package_unit_type;
	}

	/**
	 * @return int The volume of one unit in the package
	 */
	public function getPackageUnitVolumeInMilliliters() {
		return $this->package_unit_volume_in_milliliters;
	}

	/**
	 * @param int $package_unit_volume_in_milliliters
	 */
	public function setPackageUnitVolumeInMilliliters( $package_unit_volume_in_milliliters ) {
		$this->package_unit_volume_in_milliliters = $package_unit_volume_in_milliliters;
	}

	/**
	 * @return int Current retail price in cents
	 */
	public function getPriceInCents() {
		return $this->price_in_cents;
	}

	/**
	 * @param int $price_in_cents
	 */
	public function setPriceInCents( $price_in_cents ) {
		$this->price_in_cents = $price_in_cents;
	}

	/**
	 * @return int The beverage price per liter
	 */
	public function getPricePerLiterInCents() {
		return $this->price_per_liter_in_cents;
	}

	/**
	 * @param int $price_per_liter_in_cents
	 */
	public function setPricePerLiterInCents( $price_per_liter_in_cents ) {
		$this->price_per_liter_in_cents = $price_per_liter_in_cents;
	}

	/**
	 * @return int The alcohol price per liter
	 */
	public function getPricePerLiterOfAlcoholInCents() {
		return $this->price_per_liter_of_alcohol_in_cents;
	}

	/**
	 * @param int $price_per_liter_of_alcohol_in_cents
	 */
	public function setPricePerLiterOfAlcoholInCents( $price_per_liter_of_alcohol_in_cents ) {
		$this->price_per_liter_of_alcohol_in_cents = $price_per_liter_of_alcohol_in_cents;
	}

	/**
	 * @return string Primary product category
	 */
	public function getPrimaryCategory() {
		return $this->primary_category;
	}

	/**
	 * @param string $primary_category
	 */
	public function setPrimaryCategory( $primary_category ) {
		$this->primary_category = $primary_category;
	}

	/**
	 * @return string Name of the company that produces the product
	 */
	public function getProducerName() {
		return $this->producer_name;
	}

	/**
	 * @param string $producer_name
	 */
	public function setProducerName( $producer_name ) {
		$this->producer_name = $producer_name;
	}

	/**
	 * @return int Regular retail price in cents
	 */
	public function getRegularPriceInCents() {
		return $this->regular_price_in_cents;
	}

	/**
	 * @param int $regular_price_in_cents
	 */
	public function setRegularPriceInCents( $regular_price_in_cents ) {
		$this->regular_price_in_cents = $regular_price_in_cents;
	}

	/**
	 * @return \DateTime Official release date (usually unspecified)
	 */
	public function getReleasedOn() {
		return $this->released_on;
	}

	/**
	 * @param \DateTime $released_on
	 */
	public function setReleasedOn( $released_on ) {
		$this->released_on = $released_on;
	}

	/**
	 * @return string Secondary LCBO product category (Not available for all products)
	 */
	public function getSecondaryCategory() {
		return $this->secondary_category;
	}

	/**
	 * @param string $secondary_category
	 */
	public function setSecondaryCategory( $secondary_category ) {
		$this->secondary_category = $secondary_category;
	}

	/**
	 * @return string LCBO serving suggestion (Not available for all products)
	 */
	public function getServingSuggestion() {
		return $this->serving_suggestion;
	}

	/**
	 * @param string $serving_suggestion
	 */
	public function setServingSuggestion( $serving_suggestion ) {
		$this->serving_suggestion = $serving_suggestion;
	}

	/**
	 * @return string The LCBO’s determined style designation (Not available for most products)
	 */
	public function getStyle() {
		return $this->style;
	}

	/**
	 * @param string $style
	 */
	public function setStyle( $style ) {
		$this->style = $style;
	}

	/**
	 * @return string Tertiary LCBO product category (Not available for all products)
	 */
	public function getTertiaryCategory() {
		return $this->tertiary_category;
	}

	/**
	 * @param string $tertiary_category
	 */
	public function setTertiaryCategory( $tertiary_category ) {
		$this->tertiary_category = $tertiary_category;
	}

	/**
	 * @return string A URL to an image of the product (Not available for all products)
	 */
	public function getImageUrl() {
		return $this->image_url;
	}

	/**
	 * @param string $image_url
	 */
	public function setImageUrl( $image_url ) {
		$this->image_url = $image_url;
	}

	/**
	 * @return string A URL to a smaller image of the product (Not available for all products)
	 */
	public function getImageThumbUrl() {
		return $this->image_thumb_url;
	}

	/**
	 * @param string $image_thumb_url
	 */
	public function setImageThumbUrl( $image_thumb_url ) {
		$this->image_thumb_url = $image_thumb_url;
	}

	/**
	 * @return string Either “LCBO” or “VINTAGES”
	 */
	public function getStockType() {
		return $this->stock_type;
	}

	/**
	 * @param string $stock_type
	 */
	public function setStockType( $stock_type ) {
		$this->stock_type = $stock_type;
	}

	/**
	 * @return string The product’s sweetness descriptor, is usually a designation
	 * such as extra-dry (XD), medium sweet (MS), etc. (Not available for all products)
	 */
	public function getSugarContent() {
		return $this->sugar_content;
	}

	/**
	 * @param string $sugar_content
	 */
	public function setSugarContent( $sugar_content ) {
		$this->sugar_content = $sugar_content;
	}

	/**
	 * @return int The amount of sugar that is contained in the product in grams per liter.
	 * (Not available for all products)
	 */
	public function getSugarInGramsPerLiter() {
		return $this->sugar_in_grams_per_liter;
	}

	/**
	 * @param int $sugar_in_grams_per_liter
	 */
	public function setSugarInGramsPerLiter( $sugar_in_grams_per_liter ) {
		$this->sugar_in_grams_per_liter = $sugar_in_grams_per_liter;
	}

	/**
	 * @return string A string of tags that reflect the product
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * @param string $tags
	 */
	public function setTags( $tags ) {
		$this->tags = $tags;
	}

	/**
	 * @return string Professional tasting note (Not available for all products)
	 */
	public function getTastingNote() {
		return $this->tasting_note;
	}

	/**
	 * @param string $tasting_note
	 */
	public function setTastingNote( $tasting_note ) {
		$this->tasting_note = $tasting_note;
	}

	/**
	 * @return int Number of units in a package
	 */
	public function getTotalPackageUnits() {
		return $this->total_package_units;
	}

	/**
	 * @param int $total_package_units
	 */
	public function setTotalPackageUnits( $total_package_units ) {
		$this->total_package_units = $total_package_units;
	}

	/**
	 * @return \DateTime Time that the product information was updated
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

	/**
	 * @return string Contents of the value added promotion offer if available
	 */
	public function getValueAddedPromotionDescription() {
		return $this->value_added_promotion_description;
	}

	/**
	 * @param string $value_added_promotion_description
	 */
	public function setValueAddedPromotionDescription( $value_added_promotion_description ) {
		$this->value_added_promotion_description = $value_added_promotion_description;
	}

	/**
	 * @return string Grape varietal (or blend) designated by the LCBO
	 * (Not available for all products)
	 */
	public function getVarietal() {
		return $this->varietal;
	}

	/**
	 * @param string $varietal
	 */
	public function setVarietal( $varietal ) {
		$this->varietal = $varietal;
	}

	/**
	 * @return int Total volume of all units in package
	 */
	public function getVolumeInMilliliters() {
		return $this->volume_in_milliliters;
	}

	/**
	 * @param int $volume_in_milliliters
	 */
	public function setVolumeInMilliliters( $volume_in_milliliters ) {
		$this->volume_in_milliliters = $volume_in_milliliters;
	}



}