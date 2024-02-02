Sure, here's the README.md file content with all content converted to Markdown format:

```markdown
# PHP Collection Class (POC)

This `Collection` class is a POC inspired by Laravel's collection. It offers various methods for working with arrays of data in PHP.

## Functionality

The `Collection` class provides the following functionalities:

- **First:** Get the first element of the collection.
- **Last:** Get the last element of the collection.
- **Merge:** Merge the collection with another array.
- **Pop:** Remove and return the last element from the collection.
- **Count:** Count the number of elements in the collection.
- **Map:** Apply a callback to each element of the collection.
- **Sort:** Sort the collection either in ascending order.
- **SortBy:** Sort the collection by a specified direction and key.
- **All:** Get all elements of the collection.

Please note that the `SortBy` method is not fully working yet, as indicated by the provided comments in the code.

## Example Usage

```php
<?php

use Davids\Collection\Collection;

// Create a new collection
$collection = new Collection([1, 2, 3]);

// Get the first element
$result = $collection->first();
// Returns: 1

// Get the last element
$result = $collection->last();
// Returns: 3

// Merge with another array
$result = $collection->merge([4, 5, 6]);
// Returns: Collection object with elements [1, 2, 3, 4, 5, 6]

// Remove and return the last element
$result = $collection->pop();
// Returns: Collection object with elements [1, 2]

// Count the number of elements
$result = $collection->count();
// Returns: 2

// Apply a callback to each element
$result = $collection->map(function($item) { return $item * 2; });
// Returns: Collection object with elements [2, 4]

// Sort the collection
$result = $collection->sort();
// Returns: Collection object with elements [1, 2]

// Get all elements
$result = $collection->all();
// Returns: [1, 2]
```

## Additional Examples

```php
<?php

use Davids\Collection\Collection;

// Create an associative collection
$assocCollection = new Collection(['Timisoara' => 200000, 'Cluj' => 400000]);

// Merge with another array and then map
$mappedAssocCollection = $assocCollection
    ->merge(['Arad' => 30000])
    ->map(function ($key, $item) {
        return $key . ' has ' . $item . ' habitats';
    })
    ->last();

print_r($mappedAssocCollection);
// Output: Cluj has 400000 habitats
```

In this example, we create an associative collection with population data for two cities. Then, we merge it with another array containing population data for a new city ('Arad'). Next, we sort the collection alphabetically, map over the collection to create a new array with formatted strings indicating the number of habitats for each city, and finally, retrieve the last element of the resulting collection, which is 'Cluj has 400000 habitats'.

## Note

This `Collection` class is a proof of concept (POC) and may not be complete or fully functional. Further testing and development are needed. Contributions are welcome!
```
