<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a priority queue
 * Learn more @link https://en.wikipedia.org/wiki/Priority_queue
 */

namespace HackFastAlgos\DataStructure;

class PriorityQueue extends Heap
{
	/**
	 * Construct the heap as a max heap.
	 */
	public function __construct()
	{
		parent::__construct(static::MAX_HEAP);
	}

	/**
	 * Insert an item into the priority queue. The higher the priority value,
	 * the higher its priority.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @param  T   $item
	 * @param  int $priority
	 */
	public function enqueue<T>(T $item, T $priority)
	{
		$this->insert(Vector{(float) $priority, $item});
	}

	/**
	 * Dequeue an item from the priority queue
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @return T
	 */
	public function dequeue<T>() : T
	{
		$extracted = $this->extract();
		return $extracted[1];
	}

	/**
	 * Get the data for the root key.
	 *
	 * @return T
	 */
	protected function getRootItemData<T>() : T
	{
		$heapData = parent::getRootItemData();
		return $heapData[1];
	}

	/**
	 * Compare the two vectors.
	 *
	 * @param  T $item1
	 * @param  T $item2
	 * @return int
	 */
	protected function compare<T>(T $item1, T $item2) : int
	{
		if ($item1[0] < $item2[0]) {
			return 1;
		}

		if ($item1[0] > $item2[0]) {
			return -1;
		}

		return 0;
	}

	/**
	 * Check if two items are identical.
	 *
	 * @param  T $item1
	 * @param  T $item2
	 *
	 * @return bool
	 */
	protected function itemsAreIdentical<T>(T $compareTo, T $itemInHeap) : bool
	{
		if ($compareTo === $itemInHeap[1]) {
			return true;
		}

		return false;
	}
}
