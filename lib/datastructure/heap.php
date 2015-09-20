<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Heap data structure in Hack
 * Learn more @link https://en.wikipedia.org/wiki/Heap_(data_structure)
 */

namespace HackFastAlgos\DataStructure;

class Heap implements \Countable
{
	/**
	 * The data for the heap
	 * @var Vector<int> $heapData
	 */
	protected Vector<int> $heapData = Vector{};

	/**
	 * Signifies a min heap
	 * @var HEAP_MIN = 0
	 */
	const int HEAP_MIN = 0;

	/**
	 * Signifies a max heap
	 * @var HEAP_MAX = 1
	 */
	const int HEAP_MAX = 1;

	/**
	 * Constructor for the heap
	 *
	 * @param string $heapType Specify the class constants HEAP_MIN or HEAP_MAX for MinHeap or MaxHeap
	 */
	public function __construct(public int $heapType = static::HEAP_MIN){}

	/**
	 * Compare two items to find out which is greater
	 *
	 * @param T $item1	The first item to compare
	 * @param T $item2	The second item to compare
	 *
	 * @return int Returns -1, 0, or 1 if $item1 is less-than, equal-to, or greater-than $item2 respectively
	 */
	public function compare<T>(T $item1, T $item2) : int
	{
		// MaxHeap is complimentary to MinHeap, so we flip the comparison.
		if ($item1 < $item2) {
			return ($this->heapType === static::HEAP_MIN) ? -1 : 1;
		}

		if ($item1 > $item2) {
			return ($this->heapType === static::HEAP_MIN) ? 1 : -1;
		}

		return 0;
	}

	/**
	 * Insert an item into the tree
	 *
	 * @param T $item The item to insert
	 */
	public function insert<T>(T $item)
	{
		// Add the item to the end of the tree
		$this->heapData[] = $item;

		// Balance the tree
		static::balanceTree('bottom');
	}

	/**
	 * Import a vector full of items to insert
	 *
	 * @param Vector<T> $items The vector of items to insert
	 *
	 * @return this The object ready for method chaining
	 */
	public function heapify<T>(Vector<T> $items) : this
	{
		// Insert in Theta(n) time.
		foreach ($items as $value) {
			$this->heapData[] = $item;
		}

		/**
		 * @TODO Make it balance the full tree.
		 */
		static::balanceTree('bottom');

		// For chaining
		return $this;
	}

	/**
	 * Extract the node at the top of the heap
	 *
	 * @return T The item at the top of the heap
	 */
	public function extract<T>() : T
	{
		$numItems = $this->count();

		switch ($numItems) {

			case 0:
				return false;
				break;

			case 1:
				$return = $this->heapData[0];
				unset($this->heapData[0]);
				return $return;
				break;

			default:
				/*
				 * When extracting the root node, it creates a hole in the tree, so
				 * swap the last node into its place.
				 */
				$return = $this->heapData[0];
				$this->heapData[0] = $this->heapData[$numItems-1];
				static::balanceTree('top');
				return $return;
				break;

		}
	}

	public function delete<T>(T $value)
	{
		// Delete the item in Big-O(log n) time
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
	 * Get the minimum element in the heap.
	 *
	 * @return T The minimum element
	 */
	public function getMin<T>() : T
	{
		return $this->heapType === static::HEAP_MIN ? $this->heapData[0] : $this->getMax();
	}

	/**
	 * Get the maximum element in the heap.
	 *
	 * @return T The maximum element
	 */
	public function getMax<T>() : T
	{
		if ($this->heapType === static::HEAP_MAX) {
			return $this->getMin();
		}

		// Finish this method
	}

	protected function balanceTree(string $start = 'top')
	{
		if ($start === 'top') {

			// Balance the tree after an extraction.
			/*
			 * Find the child nodes for the root node, then check which is smaller.
			 * Swap the parent and child nodes if the smaller child is smaller than the parent.
			 * Repeat the same thing for the new child node.
			 */

		} else {

			// Balance the tree after an insertion.
			/*
			 * Find its parent in the vector, and compare it.
			 * If it's parent is in greater than its child in MinHeap, then flip the
			 * 		parent and child, and check the next parent until they are in the
			 * 		proper position. The compare method takes care of the differences
			 * 		in MinHeap and MaxHeap, so just check once.
			 */

		}
	}
}
