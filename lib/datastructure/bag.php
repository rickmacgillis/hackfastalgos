<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a bag
 * Learn more @link http://algs4.cs.princeton.edu/13stacks/
 */

namespace HackFastAlgos\Datastructure;

class Bag implements \Iterator, \Countable
{
	/**
	 * Storage for the bag's contents
	 * @type Vector<T>
	 */
	protected Vector<T> $bagData = Vector{};

	/**
	 * Points to an index of the bag
	 * @type int
	 */
	protected int $bagPointer = 0;

	/**
	 * Count how many items are in the bag.
	 * @return int
	 */
	public function count() : int
	{
		return $this->bagData->count();
	}

	/**
	 * Check if the bag has any items.
	 * @return bool
	 */
	public function isEmpty() : bool
	{
		return $this->count() === 0;
	}

	/**
	 * Add an item to the bag.
	 * @param  T $item
	 */
	public function add<T>(T $item)
	{
		$this->bagData[] = $item;
	}

	/**
	 * Check if the pointer points to a valid location.
	 * @return bool
	 */
	public function valid() : bool
	{
		return $this->bagData->containsKey($this->bagPointer);
	}

	/**
	 * Get the item at the current pointer.
	 * @return T
	 */
	public function current<T>() : T
	{
		return $this->bagData[$this->bagPointer];
	}

	/**
	 * Get the current key to which the bag pointer is pointing.
	 * @return int
	 */
	public function key() : int
	{
		return $this->bagPointer;
	}

	/**
	 * Move the bag pointer to the next location.
	 */
	public function next()
	{
		$this->bagPointer++;
	}

	/**
	 * Move the bag pointer to the previous location.
	 */
	public function prev()
	{
		$this->bagPointer--;
	}

	/**
	 * Rewind the bag pointer to the baginning of the bag.
	 */
	public function rewind()
	{
		$this->bagPointer = 0;
	}
}
