<?php
namespace Davids\Collection;

use Davids\Collection\Collection_Helper;
class Collection extends Collection_Helper implements \Countable
{
	public $array = [];

	public function __construct( $array ) {
		$this->array = $array;
	}

	public function first() {
		return new Collection( reset($this->array ) );
	}

	public function last() {
		return new Collection( end( $this->array ) );
	}

	public function add( $addition ) {
		$this->array[] = $addition;
		return new Collection( $this->array );
	}

	public function pop() {
		return new Collection( array_pop( $this->array ) );
	}

	public function count() {
		return count( $this->array );
	}

	public function map( $callback ) {
		$mapped_array = new Collection ( $this->array );
		return array_map( $callback, $mapped_array->array );
	}

	/**
	 * @param string $direction ("asc", "desc" )
	 * @param string $sort_by ( "key", "value" )
	 * @return array
	 */
	public function sort( $direction = 'asc', $sort_by = 'key' ) {
		if ( $this->is_assoc( $this->array ) ) {
			$this->assoc_array_sort( $this->array, $direction, $sort_by );
		} else {
			$this->flat_array_sort( $this->array, $direction );
		}
	}


	public function reduce(  ) {
		return $this->array;
	}

//	public function __destruct() {
//		return $this->array;
//	}
}
