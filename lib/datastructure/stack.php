<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implementation of a stack
 * @Learn more @link https://en.wikipedia.org/wiki/Stack_(abstract_data_type)
 */

namespace HackFastAlgos\DataStructure;

class StackException extends \Exception{}

class Stack implements \Countable
{
	/**
	 * The array of stack data
	 * @param Vector<T> $stackData
	 */
	protected Vector<T> $stackData = Vector{};

	/**
	 * Get the number of items in the stack
	 *
	 * @return int The number of items in the stack
	 */
	public function count() : int
	{
		return $this->stackData->count();
	}

	/**
	 * Add an item in the stack
	 *
	 * @param T $item The item to add
	 */
	public function push<T>(T $item)
	{
		$this->stackData[] = $item;
	}

	/**
	 * Remove and return the last item in the stack
	 *
	 * @return T The item from the stack
	 */
	public function pop<T>() : T
	{
		// Manual pop
		$count = $this->stackData->count();

		if ($count === 0) {
			throw new StackException('Invalid index');
		}

		$last = $this->stackData[$count-1];
		$this->stackData->removeKey($count-1);

		return $last;
	}
}
