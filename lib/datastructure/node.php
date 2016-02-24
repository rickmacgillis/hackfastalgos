<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a genereric Node
 */

namespace HackFastalgos\DataStructure;

class Node
{
	private T $value = null;
	private ?Node $next = null;
	private ?Node $prev = null;

	public function getValue<T>() : T
	{
		return $this->value;
	}

	public function getNext() : ?Node
	{
		return $this->next;
	}

	public function getPrev() : ?Node
	{
		return $this->prev;
	}

	public function setValue<T>(T $value)
	{
		$this->value = $value;
	}

	public function setNext(?Node $nextNode)
	{
		$this->next = $nextNode;
	}

	public function setPrev(?Node $prevNode)
	{
		$this->prev = $prevNode;
	}
}
