<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a Linked List Node
 */

namespace HackFastalgos\DataStructure;

class LinkedListNode
{
	private T $value = null;
	private ?LinkedListNode $next = null;
	private ?LinkedListNode $prev = null;

	public function getValue<T>() : T
	{
		return $this->value;
	}

	public function getNext() : ?LinkedListNode
	{
		return $this->next;
	}

	public function getPrev() : ?LinkedListNode
	{
		return $this->prev;
	}

	public function setValue<T>(T $value)
	{
		$this->value = $value;
	}

	public function setNext(?LinkedListNode $nextLinkedListNode)
	{
		$this->next = $nextLinkedListNode;
	}

	public function setPrev(?LinkedListNode $prevLinkedListNode)
	{
		$this->prev = $prevLinkedListNode;
	}
}
