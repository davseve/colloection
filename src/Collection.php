<?php
namespace Davids\Collection;

use Davids\Collection\Collection_Helper;

class Collection implements \Countable {
    public $array = [];

    public function __construct( $array ) {
        $this->array = $array;
    }

    /**
    * Get the first element of the collection.
    *
    * @example
    * $collection = new Collection([1, 2, 3]);
    * $result = $collection->first();
    * // Returns: 1
    *
    * @return mixed
    */
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

    /**
    * Get the last element of the collection.
    *
    * @example
    * $collection = new Collection([1, 2, 3]);
    * $result = $collection->last();
    * // Returns: 3
    *
    * @return mixed
    */
    public function last() {
        if ( Collection_Helper::is_assoc( $this->array ) ){
            $value = end( $this->array );
            $key = array_key_last( $this->array );

            return [ $key => $value ];
        } else {
            return end( $this->array );
        }
    }

    /**
    * Merge the collection with another array.
    *
    * @param array $addition
    * @example
    * $collection = new Collection([1, 2, 3]);
    * $result = $collection->merge([4, 5, 6]);
    * // Returns: Collection object with elements [1, 2, 3, 4, 5, 6]
    *
    * @return Collection
    */
    public function merge( array $addition ) {
        $this->array = array_merge( $this->array, $addition );
        return new static( $this->array );
    }

    /**
    * Remove and return the last element from the collection.
    *
    * @example
    * $collection = new Collection([1, 2, 3]);
    * $result = $collection->pop();
    * // Returns: Collection object with elements [1, 2]
    *
    * @return Collection
    */
    public function pop() {
        return new static( array_pop( $this->array ) );
    }

    /**
    * Count the number of elements in the collection.
    *
    * @example
    * $collection = new Collection(['a', 'b', 'c']);
    * $result = $collection->count();
    * // Returns: 3
    *
    * @return int
    */
    public function count() {
        return count( $this->array );
    }

    /**
    * Apply a callback to each element of the collection.
    *
    * @param callable $callback
    * @example
    * $collection = new Collection([1, 2, 3]);
    * $result = $collection->map(function($item) { return $item * 2; });
    * // Returns: Collection object with elements [2, 4, 6]
    *
    * @return Collection
    */
    public function map( $callback ) {
        if( Collection_Helper::is_assoc( $this->array ) ){
            $keys = array_keys( $this->array );
            $values = array_values( $this->array );
            return new static( array_map( $callback, $keys, $values ) );
        }

        return  new static( array_map( $callback, $this->array ) );
    }

    /**
    * Sort the collection either in ascending order.
    *
    * @param callable|null $callback
    * @example
    * $collection = new Collection([3, 1, 2]);
    * $result = $collection->sort();
    * // Returns: Collection object with elements [1, 2, 3]
    *
    * @return Collection
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
    * TODO: not fully working yet
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


    /**
    * Get all elements of the collection.
    *
    * @example
    * $collection = new Collection([1, 2, 3]);
    * $result = $collection->all();
    * // Returns: [1, 2, 3]
    *
    * @return array
    */
    public function all() {
        return $this->array;
    }
}
