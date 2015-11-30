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
	public function __construct()
	{
		parent::__construct(static::MAX_HEAP);
	}

	/**
	 * Operates in O(log n) or Omega(1) time.
	 */
	public function enqueue<T>(T $item, T $priority)
	{
		$this->insert(Vector{(float) $priority, $item});
	}

	/**
	 * Operates in O(log n) or Omega(1) time.
	 */
	public function dequeue<T>() : T
	{
		$extracted = $this->extract();
		return $extracted[1];
	}

	<<override>>protected function getRootItemData<T>() : T
	{
		$heapData = parent::getRootItemData();
		return $heapData[1];
	}

	<<override>>protected function compare<T>(T $item1, T $item2) : int
	{
		if ($item1[0] < $item2[0]) {
			return 1;
		}

		if ($item1[0] > $item2[0]) {
			return -1;
		}

		return 0;
	}

	<<override>>protected function itemsAreIdentical<T>(T $compareTo, T $itemInHeap) : bool
	{
		if ($compareTo === $itemInHeap[1]) {
			return true;
		}

		return false;
	}
}
