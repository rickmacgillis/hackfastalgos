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
	private Vector<T> $bagData = Vector{};
	private int $bagPointer = 0;

	public function count() : int
	{
		return $this->bagData->count();
	}

	public function isEmpty() : bool
	{
		return $this->count() === 0;
	}

	public function addItem<T>(T $item)
	{
		$this->bagData[] = $item;
	}

	public function valid() : bool
	{
		return $this->bagData->containsKey($this->bagPointer);
	}

	public function current<T>() : T
	{
		return $this->bagData[$this->bagPointer];
	}

	public function key() : int
	{
		return $this->bagPointer;
	}

	public function next()
	{
		$this->bagPointer++;
	}

	public function prev()
	{
		$this->bagPointer--;
	}

	public function rewind()
	{
		$this->bagPointer = 0;
	}
}
