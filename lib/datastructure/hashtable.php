<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a hash table (Also called a hash map, dictionary, symbol
 * table, flibber jabber, or Jabberwocky)
 * Learn more @link https://en.wikipedia.org/wiki/Hash_table
 */

namespace HackFastAlgos\DataStructure;

class HashTableTooManyItemsException extends \Exception{}

class HashTable implements \Countable, \ArrayAccess, \Iterator
{
	/**
	 * Handle collisions using a linked list
	 */
	const int COLLISION_CHAINING = 0;

	/**
	 * Handle collisions using the open addressing method
	 */
	const int COLLISION_OPEN_ADDR = 1;

	/**
	 * The open addressing probing number to locate the next open bucket
	 * Keep this number prime so that it isn't divisible by the maximum
	 * number of buckets, thus guaranteeing that when we overflow the number
	 * of buckets, we'll always check a different set of buckets. The maximum
	 * number of buckets should also be prime that way neither one can be
	 * divisible by the other.
	 */
	protected const int OPEN_ADDR_PROBE = 23;

	/**
	 * T will be either a vector with the key at position 0 and the value at position 1 for open
	 * addressing, or it'll be a linked list following the pattern key->value->key->value->...
	 * for the chaining collision handling.
	 */
	protected Map<int,T> $hashTableData = Map{};

	protected int $numBuckets = 0;

	protected Vector<int> $primes = Vector{
		2,3,7,23,89,113,523,887,1129,1327,9551,15683,19609,
		1397,155921,360653,370261,492113,1349533,1357201,2010733
	};

	/**
	 * Constructor for the hash table
	 *
	 * @TODO Figure out a way to set $maxBuckets to the next highest prime, and also watch out for
	 * buffer overflow issues for the integer. Primes get further apart as the number of primes increases.
	 * (To put it lightly)
	 *
	 * @param int $maxItems				The maximum number of items to store in the hash table (When using open
	 * 									addressing, the number must be Less than 2,010,733 - 10% = 1,809,660
	 * 									@See HashTable::$primes)
	 * @param int $collisionHandling	Set to COLLISION_CHAINING or COLLISION_OPEN_ADDR
	 */
	public function __construct(
		protected int $maxItems,
		protected int $collisionHandling = static::COLLISION_CHAINING
	){
		if ($this->collisionHandling === static::COLLISION_OPEN_ADDR) {

			// Scale horizontally using open addressing

			/**
			 * If the number of items is greater than the largest prime number on a 32 bit system (2,010,733),
			 * then throw an error.
			 *
			 * 1,809,660 === 2,010,733 - 10%
			 */
			if ($this->maxItems > 1809660) {
				throw new HashTableTooManyItemsException();
			}

			// Find the prime one greater than the number of items we'll store.
			$numPrimes = $this->primes->count();
			for ($i = 0; $i < $numPrimes; $i++) {

				$this->numBuckets = $this->primes[$i];

				if ($this->primes[$i] > $this->maxItems) {
					break;
				}

			}

		} else {

			// Scale vertically using chaining
			$this->numBuckets = $this->maxItems;

		}
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

	public function contains<T>(T $value) : bool
	{
		// Does the hash table contain the item?
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

	public function offsetGet<T>(T $key) : T
	{
		return $this->lookup($key);
	}

	public function count() : int
	{
		// Return the number of items in the hash table
	}

	public function offsetSet<T>(T $key, T $value)
	{
		$this->insert($key, $value);
	}

	public function offsetUnset<T>(T $key)
	{
		// Remove the item at the given $key from the hash table
	}

	public function current<T>() : T
	{

	}

	public function key<T>() : T
	{

	}

	public function valid() : bool
	{

	}

	public function next()
	{

	}

	public function prev()
	{

	}

	public function rewind()
	{

	}
}
