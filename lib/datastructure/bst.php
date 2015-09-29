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

class BSTException extends \Exception{}

class BST implements \Countable, \Iterator
{
	/**
	 * The BST vector
	 * @var Vector<int> $bstData
	 */
	protected Vector<(T, Statistic, Relations)> $bstData = Vector{};

	/**
	 * The iterator pointer
	 * @var int $iteratorPtr
	 */
	protected int $iteratorPtr = 0;

	/**
	 * Compare two items to see which is larger
	 *
	 * @param T $item1	The first item to compare
	 * @param T $item2	The second item to compare
	 *
	 * @return int Returns -1, 0, or 1 if $item1 is less-than, equal-to, or greater-than $item2 respectively
	 *
	 * @throws \HackFastAlgos\DataStructure\BSTException If the items are not integers or floats
	 */
	public function compare<T>(T $item1, T $item2) : int
	{
		if ((!is_int($item1) && !is_float($item1)) || (!is_int($item2) && !is_float($item2))) {
			throw new BSTException('The built in compare() method only handles numeric comparisons. '.
								   'Override the method to extend its capabilities.');
		}

		if ($item1 < $item2) {
			return -1;
		}

		if ($item1 > $item2) {
			return 1;
		}

		return 0;
	}

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

	/**
	 * Import a vector into the BST tree format
	 *
	 * @param Vector<T> $vector The vector to import data from
	 */
	public function import<T>(Vector<T> $vector)
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

	/**
	 * Return the data for the given statistic. (A statistic is the $statistic smallest
	 * item in the tree. So if the tree contains the numbers, 1,2,3,4,5, then 3 is the 3rd
	 * order statistic. It's not in relation to the root node. It's in relation to the entire
	 * tree.)
	 *
	 * @param int $statistic The statistic to find the data for
	 *
	 * @return T The data at the given statistic or false on fail
	 */
	public function select<T>(int $statistic) : T
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

	/**
	 * Get the total number of items in the BST
	 *
	 * @return int The number of items
	 */
	public function count() : int
	{
		// Find the statistic for the lower-right child.
	}

	/**
	 * Rewind the pointer to the beginning of the tree vector
	 */
	public function rewind()
	{
		$this->iteratorPtr = 0;
	}

	/**
	 * Get the current value of the iteration
	 *
	 * @return int The value at the pointer
	 */
	public function current() : int
	{
		return $this->bstData[$this->iteratorPtr][0];
	}

	/**
	 * Get the key for the current value
	 *
	 * @return int The pointer's current value
	 */
	public function key() : int
	{
		return $this->iteratorPtr;
	}

	/**
	 * Check if the pointer is pointing to a valid location in the tree vector
	 *
	 * @return bool True if it's a valid key or false if not
	 */
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
}
