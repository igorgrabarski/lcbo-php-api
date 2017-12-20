<?php

namespace igorgrabarski\utils;

use Exception;


/**
 * Class FileGetContentsDownloader
 * @package igorgrabarski
 */
class FileGetContentsDownloader implements Downloadable {

	// URL to download
	private $url;

	/**
	 * Downloads the raw JSON as a string.
	 *
	 * @param string $url
	 *
	 * @return string Downloaded json string
	 * @throws Exception
	 */
	public function downloadRaw( $url ) {

		$this->url = $url;

		$result = @file_get_contents( $this->url );


		if ( ! $result ) {
			throw new Exception( "Error occurred while downloading the data. Check URL format." . PHP_EOL );
		}

		return $result;
	}
}