<?php
namespace Davseve\Collection\Tests;

use Davids\Collection\Collection;
use PHPUnit\Framework\TestCase as TestCase;

class CollectionTest extends TestCase {

	private $assoc_collection;

	private $flat_collection;

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

	public function setUp(): void{
		parent::setUp();

		$this->assoc_collection = new Collection( $this->cities_population );

		$this->flat_collection = new Collection( $this->cities_names );

	}

	public function test__construct() {
		$this->assertCount( 3, $this->flat_collection->array );

		$this->assertCount( 3, $this->assoc_collection->array );
	}

	public function test__first() {
		// Flat array
		$first_flat = $this->flat_collection->first();
		$this->assertEquals( 'Frankfurt', $first_flat );

		// Associative array - value only
		$first_assoc = $this->assoc_collection->first();
		$this->assertEquals( [ 'Frankfurt' => 785000 ], $first_assoc );
	}

	public function test__last() {
		// Flat array
		// Act
		$last_flat = $this->flat_collection->last();

		// Assert
		$this->assertEquals( 'Valencia', $last_flat );

		// Associative array
		// Act
		$last_assoc = $this->assoc_collection->last();

		// Assert
		$this->assertEquals( [ 'Valencia' => 834920 ], $last_assoc );
	}

	public function test__merge(){
		// flat array
		// Act
		$this->flat_collection->merge( ['Arad'] );

		// Assert
		$this->assertCount( 4, $this->flat_collection );
		$this->assertEquals( 'Arad', $this->flat_collection->last() );

		// Associative array
		//Act
		$this->assoc_collection->merge( [ 'Arad' => 30000 ] );

		//Assert
		$this->assertCount( 4, $this->assoc_collection );
		$this->assertEquals( [ 'Arad' => 30000 ], $this->assoc_collection->last() );
	}

	public function test__pop() {
        // Flat collection
        $this->assertCount( 3, $this->flat_collection );
        $this->assertEquals( 'Valencia', $this->flat_collection->last() );

        // Act
        $this->flat_collection->pop();
        $new_flat_last = $this->flat_collection->last();

        $this->assertCount( 2, $this->flat_collection );
        $this->assertEquals( 'Mumbai' , $new_flat_last );

        // Assoc collection
		$this->assertCount( 3, $this->assoc_collection );
		$this->assertEquals( [ 'Valencia' => 834920 ], $this->assoc_collection->last() );

        // Act
		$this->assoc_collection->pop();
		$new_last = $this->assoc_collection->last();

        // Assert
		$this->assertCount( 2, $this->assoc_collection );
		$this->assertEquals( [ 'Mumbai' => 20000000 ], $new_last );
	}

	public function test__map() {
        // Flat array
        // Act
		$mapped_flat_collection = $this->flat_collection
            ->map( function( $item ) {
			    return $item . ' is a city';
            }
        );

        // Assert
		$this->assertIsArray( $mapped_flat_collection->all() );
		$this->assertCount( 3, $mapped_flat_collection );
		$this->assertEquals( 'Frankfurt is a city', $mapped_flat_collection->all()[0] );
		$this->assertEquals( 'Mumbai is a city', $mapped_flat_collection->all()[1] );
		$this->assertEquals( 'Valencia is a city', $mapped_flat_collection->last() );

        // Assoc array
        // Act
        $mapped_assoc_collection = $this->assoc_collection
            ->merge( [ 'Arad' => 30000 ] )
            ->map( function ( $key, $item ) {
            return $key . ' has ' . $item . ' habitats';
        } );

        // Assert
        $this->assertIsArray( $mapped_assoc_collection->all() );
        $this->assertCount( 4, $mapped_assoc_collection );
        $this->assertEquals( 'Arad has 30000 habitats', $mapped_assoc_collection->last() );
	}

	public function test__sort() {
        // Flat array
        // Act
		$sorted_collection = $this->flat_collection->merge( ['Arad'] )->sort();

        // Assert
        $this->assertIsArray( $sorted_collection->all() );
		$this->assertCount( 4, $sorted_collection );
		$this->assertEquals( 'Arad',$sorted_collection->first() );
		$this->assertEquals( 'Valencia', $sorted_collection->last() );

        //Assoc array
        //Act
        $assoc_sorted_collection = $this->assoc_collection->merge( ['Arad' => 30000] )->sort();
        $this->assertIsArray( $assoc_sorted_collection->all() );
        $this->assertCount( 4, $assoc_sorted_collection );
        $this->assertEquals( [ 'Arad' => 30000 ], $assoc_sorted_collection->first() );
        $this->assertEquals( [ 'Mumbai' => 20000000 ], $assoc_sorted_collection->last() );
    }
}
