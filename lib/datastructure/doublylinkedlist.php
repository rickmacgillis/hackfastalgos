<?HH
/**
 * Hack Fast Algos
 *
 * This object is an alternative to directly working with the Node object.
 * It just simplifies some operations.
 * Learn more @link https://en.wikipedia.org/wiki/Doubly-linked_list
 */

namespace HackFastAlgos\DataStructure;


class DoublyLinkedListIsEmptyException extends \Exception{}

class DoublyLinkedList implements \Iterator, \Countable
{
	private ?Node $lastNode = null;
	private ?Node $firstNode = null;
	private ?Node $pointer = null;
	private int $total = 0;

	public function count() : int
	{
		return $this->total;
	}

	public function current<T>() : T
	{
		return $this->pointer === null ? null : $this->pointer->getValue();
	}

	public function valid() : bool
	{
		return $this->pointer instanceOf Node;
	}

	public function key() : ?Node
	{
		return $this->pointer;
	}

	public function prev()
	{
		$this->pointer = $this->pointer === null ? null : $this->pointer->getPrev();
	}

	public function next()
	{
		$this->pointer = $this->pointer === null ? null : $this->pointer->getNext();
	}

	public function rewind()
	{
		$this->pointer = $this->firstNode;
	}

	public function moveToLast()
	{
		$this->pointer = $this->lastNode;
	}

	public function insertBefore<T>(T $data, Node $node)
	{
		if ($node === $this->firstNode || $this->firstNode === null) {
			$this->insertBeginning($data);
		} else {

			$this->total++;
			$newNode = new Node();
			$newNode->setValue($node->getValue());
			$newNode->setPrev($node);
			$newNode->setNext($node->getNext());
			$node->setValue($data);
			$node->setNext($newNode);

		}
	}

	public function insertAfter<T>(T $data, Node $node)
	{
		if ($node === $this->lastNode || $this->lastNode === null) {
			$this->insertEnd($data);
		} else {

			$this->total++;
			$newNode = new Node();
			$newNode->setValue($data);
			$newNode->setNext($node->getNext());
			$newNode->setPrev($node);
			$node->setNext($newNode);

		}
	}

	public function insertBeginning<T>(T $data)
	{
		$this->total++;
		$newNode = new Node();
		$newNode->setValue($data);
		$newNode->setNext($this->firstNode);

		if ($this->firstNode !== null) {
			$this->firstNode->setPrev($newNode);
		}

		$this->firstNode = $newNode;

		if ($this->lastNode === null) {
			$this->lastNode = $this->firstNode;
		}
	}

	public function insertEnd<T>(T $data)
	{
		$this->total++;
		$newNode = new Node();
		$newNode->setValue($data);
		$newNode->setPrev($this->lastNode);

		if ($this->lastNode !== null) {
			$this->lastNode->setNext($newNode);
		}

		$this->lastNode = $newNode;

		if ($this->firstNode === null) {
			$this->firstNode = $this->lastNode;
		}
	}

	public function removeNode(Node $node)
	{
		$this->throwIfEmptyLinkedList();
		$this->resetListIfOnlyNodePresent($node);

		if ($node === $this->firstNode) {
			$this->removeFirstNode();
		} else if ($node === $this->lastNode) {
			$this->removeLastNode();
		} else if ($this->isEmpty() === false) {
			$this->removeMiddleNode($node);
		}
	}

	public function isEmpty() : bool
	{
		return $this->count() === 0;
	}

	private function throwIfEmptyLinkedList()
	{
		if ($this->count() === 0) {
			throw new DoublyLinkedListIsEmptyException();
		}
	}

	private function removeFirstNode()
	{
		$this->total--;
		$this->firstNode = $this->firstNode->getNext();
	}

	private function removeLastNode()
	{
		$this->total--;
		$this->lastNode = $this->lastNode->getPrev();
	}

	private function removeMiddleNode(Node $node)
	{
		$this->total--;
		$nextNode = $node->getNext();
		$node->setValue($nextNode->getValue());
		$nextNextNode = $nextNode->getNext();
		$node->setNext($nextNextNode);

		if ($nextNextNode !== null) {
			$nextNextNode->setPrev($node);
		}
	}

	private function resetListIfOnlyNodePresent(Node $node)
	{
		if ($node === $this->firstNode && $node === $this->lastNode) {

			$this->lastNode = null;
			$this->firstNode = null;
			$this->pointer = null;
			$this->total = 0;

		}
	}
}
