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
		$error = curl_errno($loader);
		$code = curl_getinfo($loader, CURLINFO_RESPONSE_CODE);
		curl_close($loader);



		if($error){
			throw new Exception( "Error occurred. Request failed with error code $error" . PHP_EOL );
		}

		if ($code !== 200){
			throw new Exception("Request failed with HTTP code $code" . PHP_EOL);
		}


		return $result;

	}
}