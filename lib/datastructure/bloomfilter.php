<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Bloom Filter
 * Learm more @link https://en.wikipedia.org/wiki/Bloom_filter
 * @link https://github.com/bitcoin/bitcoin/blob/219b916545f3be194eb53801bfb8d0694978fb00/src/bloom.cpp
 */

namespace HackFastAlgos\DataStructure;

class BloomFilter
{
	private Vector<int> $bloomData = Vector{};

	public function __construct(protected int $bitWidth = 8){}

	public function insert<T>(T $item)
	{
		// Insert an item into the Bloom filter.
	}

	public function exists<T>(T $item) : bool
	{
		// Check if the item exists in the Bloom filter
	}

	public function hash<T>(T $item) : int
	{
		// Get location where the $item goes
	}
}
