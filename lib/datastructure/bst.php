<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Binary Search Tree (BST)
 * Learn more @link https://en.wikipedia.org/wiki/Binary_search_tree
 */

namespace HackFastAlgos\DataStructure;

newtype Statistic		= int;
newtype BSTParent		= int;
newtype BSTLeftChild	= int;
newtype BSTRightChild	= int;
newtype Relations		= Vector<(?BSTParent, ?BSTLeftChild, ?BSTRightChild)>;

class BST implements \Countable, \Iterator
{
	private Vector<(T, Statistic, Relations)> $bstData = Vector{};
	private int $iteratorPtr = 0;

	public function insert<T>(T $item, ?int $priority = null)
	{
		/*
		 * $priority deturmins the $item's placement (statistic) in the tree if it's not null.
		 * It's sent through the compare() function instead of the $item.
		 */

		// Insert an item into the tree
		if (!$this->bstData->containsKey(0)) {
			$this->bstData[] = Vector{$item, 0, tuple(null, null, null)};
		} else {

			// Keep the tree statistics balanced.

		}
	}

	public function fromVector<T>(Vector<T> $vector)
	{
		foreach ($vector as $value) {
			$this->insert($value);
		}
	}

	public function delete<T>(T $item)
	{
		// Delete an item from the tree
	}

	public function getMin<T>() : T
	{
		// Return the minimum value in the heap (Lowest left child)
	}

	public function getMax<T>() : T
	{
		// Return the maximum value in the heap (Lowest right child)
	}

	public function search<T>(T $item) : int
	{
		// Return the index for the given item
	}

	public function select<T>(int $nthOrderstatistic) : T
	{
		// https://en.wikipedia.org/wiki/Order_statistic_tree
	}

	public function getRank<T>(T $item) : int
	{
		/*
		 * Return the position of the given $item (Not the key; it's the number
		 * of items we iterate over in order from least to greatest up to and
		 * including $item.)
		 */
	}

	public function rotateLeft(int $node)
	{
		// https://en.wikipedia.org/wiki/Tree_rotation
		// Swap $node with its right child.
	}

	public function rotateRight(int $node)
	{
		// https://en.wikipedia.org/wiki/Tree_rotation
		// Swap $node with its left child.
	}

	public function count() : int
	{
		// Find the statistic for the lower-right child.
	}

	public function rewind()
	{
		$this->iteratorPtr = 0;
	}

	public function current() : int
	{
		return $this->bstData[$this->iteratorPtr][0];
	}

	public function key() : int
	{
		return $this->iteratorPtr;
	}

	public function valid() : bool
	{
		return $this->bstData->containsKey($this->iteratorPtr);
	}

	public function next()
	{
		// Advance the pointer to the next proper value.
	}

	public function prev()
	{
		// Rewind to the last proper value.
	}

	protected function compare<T>(T $item1, T $item2) : int
	{
		if ($item1 < $item2) {
			return -1;
		}

		if ($item1 > $item2) {
			return 1;
		}

		return 0;
	}
}
