<?HH
/**
 * @author Rick Mac Gillis
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
	/**
	 * The data for the heap
	 * @var Vector<int> $heapData
	 */
	protected Vector<int> $heapData = Vector{};

	/**
	 * Signifies a min heap
	 * @var MIN_HEAP = 0
	 */
	const int MIN_HEAP = 0;

	/**
	 * Signifies a max heap
	 * @var MAX_HEAP = 1
	 */
	const int MAX_HEAP = 1;

	/**
	 * Constructor for the heap
	 *
	 * @param string $heapType Specify the class constants MIN_HEAP or MAX_HEAP for MinHeap or MaxHeap
	 */
	public function __construct(public int $heapType = static::MIN_HEAP){}

	/**
	 * Insert an item into the tree
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @param T $item The item to insert
	 */
	public function insert<T>(T $item)
	{
		$this->heapData[] = $item;
		$this->swim($this->count() - 1);
	}

	/**
	 * Import a vector full of items to insert
	 *
	 * @param Vector<T> $items The vector of items to insert
	 *
	 * @return this The object ready for method chaining
	 */
	public function heapify<T>(Vector<T> $items)
	{
		$this->throwIfHeapNotEmpty();

		foreach ($items as $item) {
			$this->insert($item);
		}
	}

	/**
	 * Extract the node at the top of the heap
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @return T The item at the top of the heap
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
	 * Delete an item from the heap.
	 *
	 * Operates in O(n log n) time or Omega(1) time.
	 *
	 * @param  T $item
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

	/**
	 * Reset the heap.
	 */
	public function clear()
	{
		$this->heapData = Vector{};
	}

	/**
	 * Return the number of items in the heap.
	 *
	 * @return int The number of items in the heap
	 */
	public function count() : int
	{
		return $this->heapData->count();
	}

	/**
	 * Check if the heap is empty.
	 *
	 * @return bool
	 */
	public function isEmpty() : bool
	{
		return $this->heapData->count() === 0;
	}

	/**
	 * Get the minimum element in the heap.
	 *
	 * @return T The minimum element
	 */
	public function getMin<T>() : T
	{
		$this->throwIfNotMinHeap();
		return $this->getRootItemData();
	}

	/**
	 * Get the maximum element in the heap.
	 *
	 * @return T The maximum element
	 */
	public function getMax<T>() : T
	{
		$this->throwIfNotMaxHeap();
		return $this->getRootItemData();
	}

	/**
	 * Throw an exception if the heap is not a min heap.
	 *
	 * @throws HeapNotMinHeapException
	 */
	protected function throwIfNotMinHeap()
	{
		if ($this->heapType === static::MAX_HEAP) {
			throw new HeapNotMinHeapException();
		}
	}

	/**
	 * Throw an exception if the heap is not a max heap.
	 *
	 * @throws HeapNotMaxHeapException
	 */
	protected function throwIfNotMaxHeap()
	{
		if ($this->heapType === static::MIN_HEAP) {
			throw new HeapNotMaxHeapException();
		}
	}

	/**
	 * Throw an exception of the heap is not empty.
	 *
	 * @throws HeapNotEmptyException
	 */
	protected function throwIfHeapNotEmpty()
	{
		if ($this->count() !== 0) {
			throw new HeapNotEmptyException();
		}
	}

	/**
	 * Throw an exception if the heap is empty.
	 *
	 * @throws HeapEmptyException
	 */
	protected function throwIfEmptyHeap()
	{
		if ($this->count() === 0) {
			throw new HeapEmptyException();
		}
	}

	/**
	 * Balance the tree by moving higher value nodes under lower value nodes.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @param $source	The item to start comparisons from
	 */
	protected function sink(int $source)
	{
		/*
		 * Find the child nodes for the root node, then check which is smaller.
		 * Swap the parent and child nodes if the smaller child is smaller than the parent.
		 * Repeat the same thing for the new child node.
		 */
		$numItems = $this->count() - 1;
		while ($source < $numItems) {

			$leftChild = $this->getLeftChild($source);
			$rightChild = $this->getRightChild($source);

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

			if ($this->compare($this->heapData[$dest], $this->heapData[$source]) < 0) {
				$this->swap($source, $dest);
				$source = $dest;
			} else {
				break;
			}

		}
	}

	/**
	 * Balance the tree by moving lesser value nodes above the higher value nodes.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @param $source	The item to start comparisons from
	 */
	protected function swim(int $source)
	{
		/*
		 * Find the parent for the child node. If it's parent is greater than
		 * its child in MinHeap, then flip the parent and child, and check the
		 * next parent until they are in the proper position. The compare
		 * method takes care of the differences in MinHeap and MaxHeap, so just
		 * check once.
		 */
		 while ($source > 0) {

			 $parent = $this->getParent($source);
			 if ($this->compare($this->heapData[$parent], $this->heapData[$source]) > 0) {

				 $this->swap($parent, $source);
				 $source = $parent;

			 } else {
				 break;
			 }

		 }
	}

	/**
	 * Get the parent node for a given child.
	 *
	 * @param  int $child
	 * @return int
	 */
	protected function getParent(int $child) : int
	{
		if ($child === 0) {
			return 0;
		}

		return $child % 2 === 1 ? $child >> 1 : ($child >> 1) - 1;
	}

	/**
	 * Get the left child for a given parent.
	 *
	 * @param  int $parent
	 * @return int
	 */
	protected function getLeftChild(int $parent) : int
	{
		if ($parent === 0) {
			return 1;
		}

		return ($parent << 1) + 1;
	}

	/**
	 * Get the right child for a given parent.
	 *
	 * @param  int $parent
	 * @return int
	 */
	protected function getRightChild(int $parent) : int
	{
		if ($parent === 0) {
			return 2;
		}

		return ($parent << 1) + 2;
	}

	/**
	 * Swap two items in the heap.
	 *
	 * @param  int $key1
	 * @param  int $key2
	 */
	protected function swap(int $key1, int $key2)
	{
		$tmp = $this->heapData[$key1];
		$this->heapData[$key1] = $this->heapData[$key2];
		$this->heapData[$key2] = $tmp;
	}

	/**
	 * Find the key for a given item.
	 *
	 * Operates in O(n) or Omega(1) time.
	 *
	 * @param  T $item
	 *
	 * @return int
	 */
	protected function findKeyForItem<T>(T $item) : int
	{
		foreach ($this->heapData as $key => $value) {
			if ($this->itemsAreIdentical($item, $value)) {
				return $key;
			}
		}
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
		if ($compareTo === $itemInHeap) {
			return true;
		}

		return false;
	}

	/**
	 * Compare two items to find out which is greater
	 *
	 * @param T $item1	The first item to compare
	 * @param T $item2	The second item to compare
	 *
	 * @return int Returns -1, 0, or 1 if $item1 is less-than, equal-to, or greater-than $item2 respectively
	 */
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

	/**
	 * Get the data for the root key.
	 *
	 * @return T
	 */
	protected function getRootItemData<T>() : T
	{
		return $this->heapData[0];
	}
}
