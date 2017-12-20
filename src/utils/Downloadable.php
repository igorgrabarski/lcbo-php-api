<?php
namespace igorgrabarski\utils;


/**
 * Interface Downloadable
 * @package igorgrabarski
 */
interface Downloadable {


	/**
	 * Downloads the raw JSON as a string.
	 *
	 * @param string $url
	 *
	 * @return string Downloaded json string
	 */
	public function downloadRaw($url);
}