<?php

namespace igorgrabarski\utils;

use Exception;
use HttpException;


/**
 * Class CURLDownloader
 * @package igorgrabarski
 */
class CURLDownloader implements Downloadable {

	/**
	 * @var
	 */
	private $url;

	/**
	 * Downloads the raw JSON as a string.
	 *
	 * @param array curl options array
	 *
	 * @return string Downloaded json string
	 * @throws Exception
	 */
	public function downloadRaw( $url ) {

		$this->url = $url;

		$loader    = curl_init();
		curl_setopt( $loader, CURLOPT_URL, $this->url );
		curl_setopt( $loader, CURLOPT_RETURNTRANSFER, 1 );

		$result = curl_exec( $loader );

		if ( ! $result ) {
			throw new Exception( "Error occurred while downloading the data. Check URL format." . PHP_EOL );
		}

		return $result;
	}
}