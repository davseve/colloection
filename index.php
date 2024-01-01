<?php
require_once 'bootstrap.php';

use Davids\Collection\Collection;

$cities = [
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


$arad = [
	'name'       => 'Arad',
	'country'    => 'Israel',
	'population' => 30000,
];

echo '<hr/>';
$collection = new Collection($cities);
echo '<hr/>';
$addition = $collection->add($arad);
echo '<hr/>';
echo '<pre>';
var_dump( $addition );
echo 'Length:' .  sizeof($addition);
echo '</pre>';

//echo '<hr/>' . is_array( $collection ) ? 'array' : 'not array';
////var_dump( $collection[0] );
//
//$first = $collection->first();
//echo '<hr/>' . var_dump($first);
//
//
//$last = $collection->last();
//echo '<hr/>' . var_dump($last['name']);
//
//echo '<hr/>';
//
//$mappedCollection = $collection->map( function( $item ) {
//	return $item['name'];
//});
//
//var_dump( $mappedCollection );
//
//
//$aa = array_map( function( $item ) {
//	return $item['name'];
//}, $collection->array );

//var_dump( 'aa', $aa );
var_dump( 'array', $collection );


