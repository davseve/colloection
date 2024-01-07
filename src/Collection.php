<?php
namespace Davids\Collection;

use Davids\Collection\Collection_Helper;

class Collection implements \Countable
{
	public $array = [];

	public function __construct( $array ) {
		$this->array = $array;
	}

	public function first() {
        if ( Collection_Helper::is_assoc( $this->array ) ) {
            $value = reset( $this->array );
            $key = array_key_first( $this->array );

            return [ $key => $value ];
        }

        foreach ($this->array as $item) {
            return $item;
        }
	}

	public function last() {
        if ( Collection_Helper::is_assoc( $this->array ) ){
            $value = end( $this->array );
            $key = array_key_last( $this->array );

            return [ $key => $value ];
        } else {
            return end( $this->array );
        }
	}

	public function merge( $addition ) {
        $this->array = array_merge( $this->array, $addition );
		return new static( $this->array );
	}

	public function pop() {
		return new static( array_pop( $this->array ) );
	}

	public function count() {
		return count( $this->array );
	}

	public function map( $callback ) {
        if( Collection_Helper::is_assoc( $this->array ) ){
            $keys = array_keys( $this->array );
            $values = array_values( $this->array );
            return new static( array_map( $callback, $keys, $values ) );
        }

		return  new static( array_map( $callback, $this->array ) );
	}

    /**
     * Sort flat and assoc arrays
     *
     * @param $callback
     *
     * @return $this
     */
    public function sort( $callback = null ) {
        // TODO: test in the future
        if( $callback ){
            return new static( uasort( $this->array, 'callback' ) );
        }

        if (Collection_Helper::is_assoc( $this->array ) ){
            asort( $this->array );
            return new static( $this->array );
        }

        sort( $this->array );
        return new static( $this->array );
    }

	/**
	 * @param string $direction ("asc", "desc" )
	 * @param string $s3ort_by ( "key", "value" )
	 * @return array
	 */
	public function sortBy( $direction = 'asc', $sort_by = 'key' ) {
		if ( Collection_Helper::is_assoc( $this->array ) ) {
            Collection_Helper::assoc_array_sort( $this->array, $direction, $sort_by );
		} else {
            Collection_Helper::flat_array_sort( $this->array, $direction );
		}
	}


	public function reduce(  ) {
		return $this->array;
	}

	public function all() {
		return $this->array;
	}
}
