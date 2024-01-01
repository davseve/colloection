<?php
namespace Davseve\Collection\Tests;

use Davids\Collection\Collection;
use PHPUnit\Framework\TestCase as TestCase;

class CollectionTest extends TestCase {

	private $multi_assoc_collection;

	private $assoc_collection;

	private $plain_collection;

	private $cities = [
		[
			'name'       => 'Frankfurt',
			'country'    => 'Germany',
			'population' => 785000,
		],
		[
			'name'       => 'Mumbai',
			'country'    => 'India',
			'population' => 20000000,
		],
		[
			'name'       => 'Valencia',
			'country'    => 'Spain',
			'population' => 834920,
		]
	];

	private $arad = [
		'name'       => 'Arad',
		'country'    => 'Israel',
		'population' => 30000,
	];

	private $cities_population = [
		'Frankfurt' => 785000,
		'Mumbai' => 20000000,
		'Valencia' => 834920,
	];

	private $cities_names = [
		'Frankfurt',
		'Mumbai',
		'Valencia',
	];

	public function setUp() {
		parent::setUp();

		$this->multi_assoc_collection = new Collection( $this->cities );

		$this->assoc_collection = new Collection( $this->cities_population );

		$this->plain_collection = new Collection( $this->cities_names );

	}

	public function test__construct() {
		$this->assertCount( 3, $this->plain_collection->array );

		$this->assertCount( 3, $this->assoc_collection->array );

		$this->assertCount( 3, $this->multi_assoc_collection->array );
	}

	public function test__first() {
		// Plain array
		$first_plain = $this->plain_collection->first();
		$this->assertEquals( 'Frankfurt', $first_plain->array );

		// Associative array - value only
		$first_assoc = $this->assoc_collection->first();
		$this->assertEquals( '785000', $first_assoc->array );


		// Multi associative array
		$first_multi = $this->multi_assoc_collection->first();
		$this->assertEquals( 'Frankfurt', $first_multi->array['name'] );
	}

	public function test__last() {
		// Plain array
		// Act
		$last_plain = $this->plain_collection->last();

		// Assert
		$this->assertEquals( 'Valencia', $last_plain->array );

		// Associative array
		// Act
		$last_assoc = $this->assoc_collection->last();

		// Assert
		$this->assertEquals( '834920', $last_assoc->array );

		// Multi associative array
		// Act
		$last = $this->multi_assoc_collection->last();

		// Assert
		$this->assertEquals( 'Valencia', $last->array['name'] );
	}

	public function test__add(){
		// Plain array
		// Act
		$this->plain_collection->add( 'Arad' );

		// Assert
		$this->assertCount( 4, $this->plain_collection->array );
		$this->assertEquals( 'Arad', $this->plain_collection->last()->array );

		// Associative array
		//Act
		$this->assoc_collection->add( [ 'Arad' => 30000 ] );

		//Assert
		$this->assertCount( 4, $this->assoc_collection->array );
		$this->assertEquals( [ 'Arad' => 30000 ] , $this->assoc_collection->last()->array );

		// Act
		$this->multi_assoc_collection->add( $this->arad );

		// Assert
		$this->assertCount( 4, $this->multi_assoc_collection->array );
	}

	public function test__count() {;
		$this->assertEquals( 3, $this->multi_assoc_collection->count() );

		$this->multi_assoc_collection->add($this->arad);
		$this->assertEquals( 4, $this->multi_assoc_collection->count() );
	}

	public function test__pop() {;
		$last = $this->multi_assoc_collection->last();
		$this->assertCount( 3, $this->multi_assoc_collection );
		$this->assertEquals( 'Valencia', $last->array['name'] );

		$this->multi_assoc_collection->pop();
		$new_last = $this->multi_assoc_collection->last();
		$this->assertCount( 2, $this->multi_assoc_collection );
		$this->assertEquals( 'Mumbai', $new_last->array['name'] );
	}

	public function test__map() {
		$mapped_flat_collection = $this->plain_collection->map( function( $item ) {
			return $item . ' is a city';
		});

		$this->assertIsArray( $mapped_flat_collection );
		$this->assertCount( 3, $mapped_flat_collection );
		$this->assertEquals( 'Frankfurt is a city', $mapped_flat_collection[0] );
		$this->assertEquals( 'Mumbai is a city', $mapped_flat_collection[1] );
		$this->assertEquals( 'Valencia is a city', $mapped_flat_collection[2] );

		$mapped_multi_assoc_collection = $this->multi_assoc_collection->add( $this->arad )->map( function( $item ) {
			return $item['name'];
		});

		$this->assertIsArray( $mapped_multi_assoc_collection );
		$this->assertCount( 4, $mapped_multi_assoc_collection );
		$this->assertEquals( 'Frankfurt', $mapped_multi_assoc_collection[0] );
		$this->assertEquals( 'Mumbai', $mapped_multi_assoc_collection[1] );
		$this->assertEquals( 'Valencia', $mapped_multi_assoc_collection[2] );
		$this->assertEquals( 'Arad', $mapped_multi_assoc_collection[3] );
	}

	public function test__sort() {
		$sorted_collection = $this->plain_collection->sort( 'desc' );
		$this->assertIsArray( $sorted_collection );
		$this->assertCount( 3, $sorted_collection );
		$this->assertEquals( 'Frankfurt', $sorted_collection[0]['name'] );
		$this->assertEquals( 'Mumbai', $sorted_collection[1]['name'] );
		$this->assertEquals( 'Valencia', $sorted_collection[2]['name'] );
	}
}
