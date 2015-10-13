<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Bloom Filter
 * Learm more @link https://en.wikipedia.org/wiki/Bloom_filter
 * @link https://github.com/bitcoin/bitcoin/blob/219b916545f3be194eb53801bfb8d0694978fb00/src/bloom.cpp
 */

namespace HackFastAlgos\DataStructure;

newtype BloomMap = Map<int,int>;

class BloomFilter
{
	private BloomMap $bloomData = Map{};
	private BloomMap $removedBloomData = Map{};

	public function __construct(private int $size, private int $ddosSeed = 0){}

	/**
	 * Runs in O(k*n) where "k" is the number of items in the vector, and n is the length of the item getting hashed.
	 * Omega(n) best case
	 */
	public function insert<T>(Vector<T> $items)
	{
		$this->addItemsToFilter($items, $this->bloomData);
	}

	/**
	 * Runs in O(k*n) where "k" is the number of items in the vector, and n is the length of the item getting hashed.
	 * Omega(n) best case
	 */
	public function delete<T>(Vector<T> $items)
	{
		$this->addItemsToFilter($items, $this->removedBloomData);
	}

	/**
	 * Runs in O(k*n) where "k" is the number of items in the vector, and n is the length of the item getting hashed.
	 * Omega(n) best case
	 */
	public function exists<T>(Vector<T> $items) : bool
	{
		$totalItems = $items->count();
		for ($i = 0; $i < $totalItems; $i++) {
			$location = $this->getLocationForItemAtPos($items[$i], $i+1);
			if (!$this->isInsertedItem($location)) {
				return false;
			}
		}

		return true;
	}

	/**
	 * Runs in O(k*n) where "k" is the number of items in the vector, and n is the length of the item getting hashed.
	 * Omega(n) best case
	 */
	private function addItemsToFilter<T>(Vector<T> $items, BloomMap $filter)
	{
		$totalItems = $items->count();
		for ($i = 0; $i < $totalItems; $i++) {
			$location = $this->getLocationForItemAtPos($items[$i], $i+1);
			$filter[$location] = 1;
		}
	}

	private function getLocationForItemAtPos<T>(T $item, int $position) : int
	{
		return $this->hash($item, $position);
	}

	/**
	 * Runs in Theta(n) time.
	 */
	private function hash<T>(T $item, int $position) : int
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$hash = $murmur->hash($item, $this->ddosSeed);
		return $hash % ($this->size * $position * 2);
	}

	private function isInsertedItem(int $location) : bool
	{
		if ($this->bloomData->containsKey($location) && !$this->removedBloomData->containsKey($location)) {
			return true;
		}

		return false;
	}
}
