<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a set
 */

namespace HackFastAlgos\DataStructure;

class Set implements \Iterator, \Countable
{
	private ?HashTableOA $setData = null;

	public function __construct(int $size, int $seed = 0)
	{
		$this->setData = new HashTableOA($size, $seed);
	}

	public function add<T>(T $item)
	{
		$this->setData[$item] = 1;
	}

	public function contains<T>(T $item) : bool
	{
		return $this->setData->contains($item);
	}

	public function delete<T>(T $item)
	{
		$this->setData->delete($item);
	}

	public function count() : int
	{
		return $this->setData->count();
	}

	public function valid() : bool
	{
		return $this->setData->valid();
	}

	public function rewind()
	{
		$this->setData->rewind();
	}

	public function key<T>() : T
	{
		return $this->setData->key();
	}

	public function current<T>() : T
	{
		// Value is always 1, so return the key as the value.
		return $this->setData->key();
	}

	public function next()
	{
		$this->setData->next();
	}

	public function prev()
	{
		$this->setData->prev();
	}
}
