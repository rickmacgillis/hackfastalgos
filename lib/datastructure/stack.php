<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a stack
 * @Learn more @link https://en.wikipedia.org/wiki/Stack_(abstract_data_type)
 */

namespace HackFastAlgos\DataStructure;

class StackInvalidIndexException extends \Exception{}

class Stack implements \Countable
{
	private Vector<T> $stackData = Vector{};

	public function count() : int
	{
		return $this->stackData->count();
	}

	public function push<T>(T $item)
	{
		$this->stackData[] = $item;
	}

	public function pop<T>() : T
	{
		// Manual pop
		$count = $this->stackData->count();

		if ($count === 0) {
			throw new StackInvalidIndexException();
		}

		$last = $this->stackData[$count-1];
		$this->stackData->removeKey($count-1);

		return $last;
	}
}
