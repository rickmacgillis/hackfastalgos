<?php
/**
 * Copyright 2015 Rick Mac Gillis
 * 
 * Implementation of a hash table (Also called a hash map or dictionary)
 * Learn more @link https://en.wikipedia.org/wiki/Hash_table
 */

namespace HackFastAlgos\DataStructure;

class HashTable implements \Countable, \ArrayAccess
{
	/**
	 * Handle collisions using a linked list
	 * @var int COLLISION_CHAINING = 0
	 */
	public const COLLISION_CHAINING	= 0;
	
	/**
	 * Handle collisions using the open addressing method
	 * @var int COLLISION_OPEN_ADDR = 1
	 */
	public const COLLISION_OPEN_ADDR	= 1;
	
	/**
	 * The data stored in the hash table (It's ironic that we'll use a map to implement a map,
	 * though the alternative is Array (A PHP array is also a map that uses linked lists). However,
	 * as this library is built for Hack, we'll use the augmented Array in Hack, known as Map,
	 * so we have OOP access.
	 * 
	 * @var Map<int,T> $hashTableData
	 */
	protected Map<int,T> $hashTableData = Map{};
	
	/**
	 * Constructor for the hash table
	 * 
	 * @param int $collisionHandling Set to COLLISION_CHAINING or COLLISION_OPEN_ADDR
	 */
	public function __construct(
		protected int $maxBuckets,
		protected int $collisionHandling = static::COLLISION_CHAINING
	){
		// Find a prime
		$this->maxBuckets = \HackFastAlgos::atkinFindPrime($this->maxBuckets);
	}
	
	public function insert<T>(T $key, T $value)
	{
		// Insert an item into the hash table
	}
	
	public function delete<T>(T $key)
	{
		// Delete an item from the hash table
	}
	
	public function search<T>(T $value) : T
	{
		// Find an item in the hash table
	}
	
	public function lookup<T>(T $key) : T
	{
		// Get an item by its key
	}
	
	public function hash<T>(T $item) : int
	{
		// Take in the item, hash it, then spit out the key where the data or linked-list is stored.
		// http://www.azillionmonkeys.com/qed/hash.html
	}
	
	public function offsetExists<T>(T $key) : bool
	{
		// Check if the offset exists in the hash table
	}
	
	/**
	 * Get an entry with $hashTable[$key]
	 * 
	 * @param T $key The key for which to locate the data
	 * @return T The data stored in $key
	 */
	public function offsetGet<T>(T $key) : T
	{
		return $this->lookup($key);
	}
	
	public function count() : int
	{
		// Return the number of items in the hash table
	}
	
	/**
	 * Set the entry with $hashTable[$key] = $value
	 * 
	 * @param T $key	The key to set in the hash table
	 * @param T $value	The value to set for the given $key
	 */
	public function offsetSet<T>(T $key, T $value)
	{
		$this->insert($key, $value);
	}
	
	public function offsetUnset<T>(T $key)
	{
		// Remove the item at the given $key from the hash table
	}
}
