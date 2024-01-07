<?php

namespace Davids\Collection;

class Collection_Helper
{
	/**
	 * @param string $direction ("asc", "desc" )
	 * @param string $sort_by ( "key", "value" )
	 * @return true
	 */
	public static function assoc_array_sort( array $array, string $direction, string $sort_by ): array {
		$sorted_array = new Collection( $array );
		$direction = strtolower( $direction );
		$sort_by = strtolower( $sort_by );

		if ( $direction === 'asc' ) {
			if ( $sort_by === 'key' ) {
				return ksort( $sorted_array->array );
			} else {
				return asort( $sorted_array->array );
			}
		} else {
			if ( $sort_by === 'key' ) {
				return krsort( $sorted_array->array );
			} else {
				return arsort( $sorted_array->array );
			}
		}

		return $sorted_array->array;
	}

    public static function flat_array_sort( array $array, string $direction ) {
		$sorted_array = new Collection( $array );
		$direction = strtolower( $direction );

		if ( $direction === 'asc' ) {
			return sort( $sorted_array->array );
		} else {
			return rsort( $sorted_array->array );
		}

		return $sorted_array->array;
	}

	public static function is_assoc( array $array ): bool {
		$keys = array_keys($array);
		return array_keys($keys) !== $keys;
	}
}
