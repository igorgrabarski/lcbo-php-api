<?php
namespace igorgrabarski\utils;


/**
 * Interface Downloadable
 * @package igorgrabarski
 */
interface Downloadable {


	/**
	 * @param string $url
	 *
	 * @return string Downloaded json string
	 */
	public function download($url);
}