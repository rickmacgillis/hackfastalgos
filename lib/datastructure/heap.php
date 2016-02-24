<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a binary heap data structure in Hack
 * Learn more @link https://en.wikipedia.org/wiki/Heap_(data_structure)
 */

namespace HackFastAlgos\DataStructure;

class HeapEmptyException extends \Exception{}
class HeapNotEmptyException extends \Exception{}
class HeapNotMinHeapException extends \Exception{}
class HeapNotMaxHeapException extends \Exception{}

class Heap implements \Countable
{
	const int MIN_HEAP = 0;
	const int MAX_HEAP = 1;

	private Vector<int> $heapData = Vector{};

	public function __construct(public int $heapType = static::MIN_HEAP){}

	/**
	 * Operates in O(log n) or Omega(1) time.
	 */
	public function insert<T>(T $item)
	{
		$this->heapData[] = $item;
		$this->swim($this->count() - 1);
	}

	/**
	 * Operates in O(n log n) or Omega(1) time.
	 */
	public function heapify<T>(Vector<T> $items)
	{
		$this->throwIfHeapNotEmpty();

		foreach ($items as $item) {
			$this->insert($item);
		}
	}

	/**
	 * Operates in O(log n) or Omega(1) time.
	 */
	public function extract<T>() : T
	{
		$this->throwIfEmptyHeap();
		$numItems = $this->count();

		$return = $this->heapData[0];

		if ($numItems === 1) {
			$this->heapData->removeKey(0);
		} else {
			$this->heapData[0] = $this->heapData[$numItems-1];
			$this->heapData->removeKey($numItems-1);
			$this->sink(0);
		}

		return $return;
	}

	/**
	 * Operates in O(n log n) time or Omega(1) time.
	 */
	public function delete<T>(T $item)
	{
		$this->throwIfEmptyHeap();
		$numItems = $this->count();

		$itemKey = $this->findKeyForItem($item);
		if ($numItems === 1 || $itemKey === $numItems-1) {
			$this->heapData->removeKey($itemKey);
		} else {

			$last = $numItems-1;
			$this->swap($itemKey, $last);
			$this->heapData->removeKey($last);
			$this->sink($itemKey);
			$this->swim($itemKey);

		}
	}

	public function reset()
	{
		$this->heapData = Vector{};
	}

	public function count() : int
	{
		return $this->heapData->count();
	}

	public function isEmpty() : bool
	{
		return $this->heapData->count() === 0;
	}

	public function getMin<T>() : T
	{
		$this->throwIfNotMinHeap();
		return $this->getRootItemData();
	}

	public function getMax<T>() : T
	{
		$this->throwIfNotMaxHeap();
		return $this->getRootItemData();
	}

	private function throwIfNotMinHeap()
	{
		if ($this->heapType === static::MAX_HEAP) {
			throw new HeapNotMinHeapException();
		}
	}

	private function throwIfNotMaxHeap()
	{
		if ($this->heapType === static::MIN_HEAP) {
			throw new HeapNotMaxHeapException();
		}
	}

	private function throwIfHeapNotEmpty()
	{
		if ($this->count() !== 0) {
			throw new HeapNotEmptyException();
		}
	}

	private function throwIfEmptyHeap()
	{
		if ($this->count() === 0) {
			throw new HeapEmptyException();
		}
	}

	/**
	 * Balance the tree by moving higher value nodes under lower value nodes.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 */
	private function sink(int $startNode)
	{
		/*
		 * Find the child nodes for the root node, then check which is smaller.
		 * Swap the parent and child nodes if the smaller child is smaller than the parent.
		 * Repeat the same thing for the new child node.
		 */
		$numItems = $this->count() - 1;
		while ($startNode < $numItems) {

			$leftChild = $this->getLeftChildForParent($startNode);
			$rightChild = $this->getRightChildForParent($startNode);

			if ($leftChild > $numItems) {
				break;
			}

			$dest = $rightChild;
			if (
				$rightChild > $numItems ||
				$this->compare($this->heapData[$leftChild], $this->heapData[$rightChild]) < 0
			) {
				$dest = $leftChild;
			}

			if ($this->compare($this->heapData[$dest], $this->heapData[$startNode]) < 0) {
				$this->swap($startNode, $dest);
				$startNode = $dest;
			} else {
				break;
			}

		}
	}

	/**
	 * Balance the tree by moving lesser value nodes above the higher value nodes.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 */
	private function swim(int $startNode)
	{
		/*
		 * Find the parent for the child node. If it's parent is greater than
		 * its child in MinHeap, then flip the parent and child, and check the
		 * next parent until they are in the proper position. The compare
		 * method takes care of the differences in MinHeap and MaxHeap, so just
		 * check once.
		 */
		 while ($startNode > 0) {

			 $parent = $this->getParentForChild($startNode);
			 if ($this->compare($this->heapData[$parent], $this->heapData[$startNode]) > 0) {

				 $this->swap($parent, $startNode);
				 $startNode = $parent;

			 } else {
				 break;
			 }

		 }
	}

	private function getParentForChild(int $child) : int
	{
		if ($child === 0) {
			return 0;
		}

		return $child % 2 === 1 ? $child >> 1 : ($child >> 1) - 1;
	}

	private function getLeftChildForParent(int $parent) : int
	{
		if ($parent === 0) {
			return 1;
		}

		return ($parent << 1) + 1;
	}

	private function getRightChildForParent(int $parent) : int
	{
		if ($parent === 0) {
			return 2;
		}

		return ($parent << 1) + 2;
	}

	private function swap(int $key1, int $key2)
	{
		$tmp = $this->heapData[$key1];
		$this->heapData[$key1] = $this->heapData[$key2];
		$this->heapData[$key2] = $tmp;
	}

	private function findKeyForItem<T>(T $item) : int
	{
		foreach ($this->heapData as $key => $value) {
			if ($this->itemsAreIdentical($item, $value)) {
				return $key;
			}
		}
	}

	protected function itemsAreIdentical<T>(T $compareTo, T $itemInHeap) : bool
	{
		if ($compareTo === $itemInHeap) {
			return true;
		}

		return false;
	}

	protected function compare<T>(T $item1, T $item2) : int
	{
		// MaxHeap is complimentary to MinHeap, so we flip the comparison.
		if ($item1 < $item2) {
			return ($this->heapType === static::MIN_HEAP) ? -1 : 1;
		}

		if ($item1 > $item2) {
			return ($this->heapType === static::MIN_HEAP) ? 1 : -1;
		}

		return 0;
	}

	protected function getRootItemData<T>() : T
	{
		return $this->heapData[0];
	}
}
