<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a doubly linked list
 * Learn more @link https://en.wikipedia.org/wiki/Doubly-linked_list
 *
 * Every method works in Theta(1) time.
 */

namespace HackFastAlgos\DataStructure;

newtype DLLNode = int;
newtype DLLEntry = (?DLLNode,T,?DLLNode);

class DoublyLinkedListInvalidIndexException extends \Exception{}

class DoublyLinkedList implements \Iterator, \Countable
{
	protected Map<int, DLLEntry> $dllData = Map{};
	protected int $lastNode = 0;
	protected int $firstNode = 0;
	protected int $openIndex = 0;
	protected ?int $pointer = 0;

	public function count() : int
	{
		return $this->dllData->count();
	}

	public function current<T>() : T
	{
		if ($this->pointer == null || !$this->dllData->containsKey($this->pointer)) {
			throw new DoublyLinkedListInvalidIndexException();
		}

		return $this->dllData[$this->pointer][1];
	}

	public function valid() : bool
	{
		return $this->pointer == null ? false : $this->dllData->containsKey($this->pointer);
	}

	public function key() : int
	{
		return $this->pointer;
	}

	public function prev()
	{
		$this->pointer = $this->pointer === null ? null : $this->dllData[$this->pointer][0];
	}

	public function next()
	{
		$this->pointer = $this->pointer === null ? null : $this->dllData[$this->pointer][2];
	}

	public function rewind()
	{
		$this->pointer = $this->firstNode;
	}

	public function moveToLast()
	{
		$this->pointer = $this->lastNode;
	}

	public function insertBefore<T>(T $data, int $node)
	{
		$this->insertAtBeginningIfEmpty($data, function () use ($data, $node) {

			$this->throwIfInvalidNode($node);
			$this->createNodeBeforeNext($data, $node);
			$thisNode = $this->openIndex++;

			if ($this->isFirstNode($node)) {
				$this->firstNode = $thisNode;
			} else {
				$this->setNextNode($this->getPreviousNode($node), $thisNode);
			}

			$this->setPreviousNode($node, $thisNode);

		});
	}

	public function insertAfter<T>(T $data, int $node)
	{
		$this->insertAtBeginningIfEmpty($data, function () use ($data, $node) {

			$this->throwIfInvalidNode($node);
			$this->createNodeAfterPrevious($data, $node);
			$thisNode = $this->openIndex++;

			if ($this->isLastNode($node)) {
				$this->lastNode = $thisNode;
			} else {
				$this->setPreviousNode($this->getNextNode($node), $thisNode);
			}

			$this->setNextNode($node, $thisNode);

		});
	}

	public function insertBeginning<T>(T $data)
	{
		// Feeling a bit empty?
		if ($this->count() === 0) {

			/*
			 * Avoid bugs in 3rd party code by using the next open index in case they don't
			 * check if the DLL is empty. (Ex. All nodes got removed.)
			 */
			$this->createNode(null, $data, null);
			$this->lastNode = $this->openIndex;

		} else {

			$this->createNode(null, $data, $this->firstNode);
			$this->setPreviousNode($this->firstNode, $this->openIndex);

		}

		$this->firstNode = $this->openIndex++;
	}

	public function insertEnd<T>(T $data)
	{
		if ($this->count() === 0) {

			$this->createNode(null, $data, null);
			$this->firstNode = $this->openIndex;

		} else {

			$this->createNode($this->lastNode, $data, null);
			$this->setNextNode($this->lastNode, $this->openIndex);

		}

		$this->lastNode = $this->openIndex++;
	}

	public function removeNode(int $node)
	{
		$this->throwIfInvalidNode($node);

		if ($this->getPreviousNode($node) !== null && $this->getNextNode($node) !== null) {

			$this->setNextNode($this->getPreviousNode($node), $this->getNextNode($node));
			$this->setPreviousNode($this->getNextNode($node), $this->getPreviousNode($node));

		} else if ($this->getPreviousNode($node) !== null) {

			$this->setNextNode($this->getPreviousNode($node), null);
			$this->lastNode = $this->getPreviousNode($node);

		} else if ($this->getNextNode($node) !== null) {

			$this->setPreviousNode($this->getNextNode($node), null);
			$this->firstNode = $this->getNextNode($node);

		}

		$this->dllData->removeKey($node);
	}

	protected function throwIfInvalidNode(int $node)
	{
		if (!$this->nodeExists($node)) {
			throw new DoublyLinkedListInvalidIndexException();
		}
	}

	protected function nodeExists(int $node) : bool
	{
		return $this->dllData->containsKey($node);
	}

	protected function setPreviousNode(int $node, ?int $newPreviousNode)
	{
		$this->dllData[$node][0] = $newPreviousNode;
	}

	protected function setNextNode(int $node, ?int $nextNode)
	{
		$this->dllData[$node][2] = $nextNode;
	}

	protected function getPreviousNode(int $node) : ?int
	{
		return $this->dllData[$node][0];
	}

	protected function getNextNode(int $node) : ?int
	{
		return $this->dllData[$node][2];
	}

	protected function isFirstNode(int $node) : bool
	{
		return $this->dllData[$node][0] === null;
	}

	protected function isLastNode(int $node) : bool
	{
		return $this->dllData[$node][2] === null;
	}

	protected function createNode<T>(?int $previousNode, T $data, ?int $nextNode)
	{
		$this->dllData[$this->openIndex] = tuple($previousNode, $data, $nextNode);
	}

	protected function createNodeBeforeNext<T>(T $data, int $nextNode)
	{
		$nextNodeData = $this->dllData[$nextNode];
		$this->createNode($nextNodeData[0], $data, $nextNode);
	}

	protected function createNodeAfterPrevious<T>(T $data, int $previousNode)
	{
		$previousNodeData = $this->dllData[$previousNode];
		$this->createNode($previousNode, $data, $previousNodeData[2]);
	}

	protected function insertAtBeginningIfEmpty<T>(T $data, Callable $notEmpty)
	{
		if ($this->count() === 0) {
			$this->insertBeginning($data);
		} else {
			$notEmpty();
		}
	}
}
