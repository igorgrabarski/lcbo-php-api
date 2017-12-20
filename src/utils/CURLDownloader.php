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

	private $options;
	/**
	 * CURLDownloader constructor.
	 *
	 * @param $url
	 */
	public function __construct( $options ) {
		$this->options = $options;
	}

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
		if ( $this->options ) {
			curl_setopt_array( $loader, $this->options );
		}

		$result = curl_exec( $loader );

		if ( ! $result ) {
			throw new Exception( "Error occurred while downloading the data. Check URL format." . PHP_EOL );
		}

		return $result;
	}
}