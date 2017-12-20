<?php

namespace igorgrabarski\utils;


/**
 * Contains metadata about the downloaded resources
 * such as total number of pages, total number of results etc.
 * @package igorgrabarski\utils
 */
class Metadata {

	private	$records_per_page;
	private	$total_record_count;
	private	$current_page_record_count;
	private	$is_first_page;
	private	$is_final_page;
	private	$current_page;
	private	$current_page_path;
	private	$next_page;
	private	$next_page_path;
	private	$previous_page;
	private	$previous_page_path;
	private	$total_pages;
	private	$total_pages_path;

	/**
	 * @return mixed
	 */
	public function getRecordsPerPage() {
		return $this->records_per_page;
	}

	/**
	 * @param mixed $records_per_page
	 */
	public function setRecordsPerPage( $records_per_page ) {
		$this->records_per_page = $records_per_page;
	}

	/**
	 * @return mixed
	 */
	public function getTotalRecordCount() {
		return $this->total_record_count;
	}

	/**
	 * @param mixed $total_record_count
	 */
	public function setTotalRecordCount( $total_record_count ) {
		$this->total_record_count = $total_record_count;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPageRecordCount() {
		return $this->current_page_record_count;
	}

	/**
	 * @param mixed $current_page_record_count
	 */
	public function setCurrentPageRecordCount( $current_page_record_count ) {
		$this->current_page_record_count = $current_page_record_count;
	}

	/**
	 * @return mixed
	 */
	public function getisFirstPage() {
		return $this->is_first_page;
	}

	/**
	 * @param mixed $is_first_page
	 */
	public function setIsFirstPage( $is_first_page ) {
		$this->is_first_page = $is_first_page;
	}

	/**
	 * @return mixed
	 */
	public function getisFinalPage() {
		return $this->is_final_page;
	}

	/**
	 * @param mixed $is_final_page
	 */
	public function setIsFinalPage( $is_final_page ) {
		$this->is_final_page = $is_final_page;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPage() {
		return $this->current_page;
	}

	/**
	 * @param mixed $current_page
	 */
	public function setCurrentPage( $current_page ) {
		$this->current_page = $current_page;
	}

	/**
	 * @return mixed
	 */
	public function getCurrentPagePath() {
		return $this->current_page_path;
	}

	/**
	 * @param mixed $current_page_path
	 */
	public function setCurrentPagePath( $current_page_path ) {
		$this->current_page_path = $current_page_path;
	}

	/**
	 * @return mixed
	 */
	public function getNextPage() {
		return $this->next_page;
	}

	/**
	 * @param mixed $next_page
	 */
	public function setNextPage( $next_page ) {
		$this->next_page = $next_page;
	}

	/**
	 * @return mixed
	 */
	public function getNextPagePath() {
		return $this->next_page_path;
	}

	/**
	 * @param mixed $next_page_path
	 */
	public function setNextPagePath( $next_page_path ) {
		$this->next_page_path = $next_page_path;
	}

	/**
	 * @return mixed
	 */
	public function getPreviousPage() {
		return $this->previous_page;
	}

	/**
	 * @param mixed $previous_page
	 */
	public function setPreviousPage( $previous_page ) {
		$this->previous_page = $previous_page;
	}

	/**
	 * @return mixed
	 */
	public function getPreviousPagePath() {
		return $this->previous_page_path;
	}

	/**
	 * @param mixed $previous_page_path
	 */
	public function setPreviousPagePath( $previous_page_path ) {
		$this->previous_page_path = $previous_page_path;
	}

	/**
	 * @return mixed
	 */
	public function getTotalPages() {
		return $this->total_pages;
	}

	/**
	 * @param mixed $total_pages
	 */
	public function setTotalPages( $total_pages ) {
		$this->total_pages = $total_pages;
	}

	/**
	 * @return mixed
	 */
	public function getTotalPagesPath() {
		return $this->total_pages_path;
	}

	/**
	 * @param mixed $total_pages_path
	 */
	public function setTotalPagesPath( $total_pages_path ) {
		$this->total_pages_path = $total_pages_path;
	}




}