<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implementation of a doubly linked list
 * Learn more @link https://en.wikipedia.org/wiki/Doubly-linked_list
 *
 * Every method works in Theta(1) time.
 */

namespace HackFastAlgos\DataStructure;

class DoublyLinkedListException extends \Exception{}

class DoublyLinkedList implements \Iterator, \Countable
{
	/**
	 * The data for the DLL
	 * @var Map<int, (int,T,int)> $dllData
	 */
	protected Map<int, (?int,T,?int)> $dllData = Map{};

	/**
	 * The last node in the DLL
	 * @var int $lastNode
	 */
	protected int $lastNode = 0;

	/**
	 * The first node in the DLL
	 * @var int $firstNode
	 */
	protected int $firstNode = 0;

	/**
	 * A pointer to the next available index we can safely assign in the map.
	 * @var int $openIndex
	 */
	protected int $openIndex = 0;

	/**
	 * The pointer for the iterator
	 * @var int $pointer
	 */
	protected ?int $pointer = 0;

	/**
	 * Count the number of items in the DLL.
	 *
	 * @return int The number of items
	 */
	public function count() : int
	{
		return $this->dllData->count();
	}

	/**
	 * Get the data for the current location.
	 *
	 * @return T The data
	 */
	public function current<T>() : T
	{
		if ($this->pointer == null || !$this->dllData->containsKey($this->pointer)) {
			throw new DoublyLinkedListException('Invalid index');
		}

		return $this->dllData[$this->pointer][1];
	}

	/**
	 * Check if the current location is a valid place in the DDL.
	 *
	 * @return bool True if it's valid, false if it isn't valid
	 */
	public function valid() : bool
	{
		return $this->pointer == null ? false : $this->dllData->containsKey($this->pointer);
	}

	/**
	 * Get the current location in the DDL.
	 *
	 * @return int The location in the DDL
	 */
	public function key() : int
	{
		return $this->pointer;
	}

	/**
	 * Set the pointer to the previous location.
	 */
	public function prev()
	{
		$this->pointer = $this->pointer === null ? null : $this->dllData[$this->pointer][0];
	}

	/**
	 * Set the pointer to the next location in the DLL.
	 */
	public function next()
	{
		$this->pointer = $this->pointer === null ? null : $this->dllData[$this->pointer][2];
	}

	/**
	 * Set the location to the beginning of the DLL.
	 */
	public function rewind()
	{
		$this->pointer = $this->firstNode;
	}

	/**
	 * Set the location to the end of the DLL.
	 */
	public function moveLast()
	{
		$this->pointer = $this->lastNode;
	}

	/**
	 * Insert a node before another node,
	 *
	 * @param T $data	The data to add to the new node
	 * @param int $node	The key for the node to insert before
	 */
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

	/**
	 * Insert a node after another node,
	 *
	 * @param T $data	The data to add to the new node
	 * @param int $node	The key for the node to insert after
	 */
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

	/**
	 * Insert a node at the beginning of the DLL.
	 *
	 * @param T $data The data for the new node
	 */
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

	/**
	 * Insert a node at the end of the DLL.
	 *
	 * @param T $data The data for the new node
	 */
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

	/**
	 * Remove a node from the DLL.
	 *
	 * @param int $node The key of the node to delete
	 */
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

	/**
	 * Throw an exception if the requested node is invalid.
	 *
	 * @param  int $node	The node to search for
	 * @throws DoublyLinkedListException
	 */
	protected function throwIfInvalidNode(int $node)
	{
		if (!$this->nodeExists($node)) {
			throw new DoublyLinkedListException('Invalid Index');
		}
	}

	/**
	 * Check if a node exists.
	 *
	 * @param  int $node	The node to find
	 * @return bool	True if it exists or false if it does not.
	 */
	protected function nodeExists(int $node) : bool
	{
		return $this->dllData->containsKey($node);
	}

	/**
	 * Set the "previous node" pointer for a node.
	 *
	 * @param int $node				The node to set the pointer on
	 * @param ?int $newPreviousNode	The new node to use as the "previous" pointer
	 */
	protected function setPreviousNode(int $node, ?int $newPreviousNode)
	{
		$this->dllData[$node][0] = $newPreviousNode;
	}

	/**
	 * Set the previous node's "next node" pointer.
	 *
	 * @param int $node		The node to set the next node for
	 * @param ?int $nextNode	The node to use as the next node
	 */
	protected function setNextNode(int $node, ?int $nextNode)
	{
		$this->dllData[$node][2] = $nextNode;
	}

	/**
	 * Get the "previous node" pointer for a node.
	 *
	 * @param  int $node	The node for which to find the "previous node" pointer
	 * @return ?int	The ID of the previous node
	 */
	protected function getPreviousNode(int $node) : ?int
	{
		return $this->dllData[$node][0];
	}

	/**
	 * Get the "next node" pointer for a node.
	 *
	 * @param  int $node	The node for which to find the "next node" pointer
	 * @return ?int	The ID of the next node
	 */
	protected function getNextNode(int $node) : ?int
	{
		return $this->dllData[$node][2];
	}

	/**
	 * Check if a node is the first node in the DLL.
	 *
	 * @param  int $node	The node to check
	 * @return bool	True if it's the first node, false if it's not.
	 */
	protected function isFirstNode(int $node) : bool
	{
		return $this->dllData[$node][0] === null;
	}

	/**
	 * Check if a node is the last node in the DLL.
	 *
	 * @param  int $node	The node to check
	 * @return bool	True if it's the last node, false if it's not.
	 */
	protected function isLastNode(int $node) : bool
	{
		return $this->dllData[$node][2] === null;
	}

	/**
	 * Create a node at the current open index.
	 *
	 * @param  ?int $previousNode	The node ID for the node previous to the new node
	 * @param  T   $data			The data for the new node
	 * @param  ?int $nextNode		The node ID for the node after the new node
	 */
	protected function createNode<T>(?int $previousNode, T $data, ?int $nextNode)
	{
		$this->dllData[$this->openIndex] = tuple($previousNode, $data, $nextNode);
	}

	/**
	 * Create a node before another node.
	 *
	 * @param  T   $data		The data for the new node
	 * @param  int $nextNode	The ID for the node after the one being created
	 */
	protected function createNodeBeforeNext<T>(T $data, int $nextNode)
	{
		$nextNodeData = $this->dllData[$nextNode];
		$this->createNode($nextNodeData[0], $data, $nextNode);
	}

	/**
	 * Create a node after another node.
	 *
	 * @param  T   $data			The data for the new node
	 * @param  int $previousNode	The ID for the node previous to the one being created
	 */
	protected function createNodeAfterPrevious<T>(T $data, int $previousNode)
	{
		$previousNodeData = $this->dllData[$previousNode];
		$this->createNode($previousNode, $data, $previousNodeData[2]);
	}

	/**
	 * Insert $data at the beginning of the DLL if the DLL is empty.
	 *
	 * @param  T $data The data to enter
	 * @throws DoublyLinkedListException if the DLL is not empty.
	 */
	protected function insertAtBeginningIfEmpty<T>(T $data, Callable $notEmpty)
	{
		if ($this->count() === 0) {
			$this->insertBeginning($data);
		} else {
			$notEmpty();
		}
	}
}
