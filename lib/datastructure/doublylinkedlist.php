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
	 * @var int $last
	 */
	protected int $last = 0;
	
	/**
	 * The first node in the DLL
	 * @var int $first
	 */
	protected int $first = 0;
	
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
		if (null === $this->pointer || false === $this->dllData->containsKey($this->pointer)) {
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
		return null === $this->pointer ? false : $this->dllData->containsKey($this->pointer);
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
		$this->pointer = null === $this->pointer ? null : $this->dllData[$this->pointer][0];
	}
	
	/**
	 * Set the pointer to the next location in the DLL.
	 */
	public function next()
	{
		$this->pointer = null === $this->pointer ? null : $this->dllData[$this->pointer][2];
	}
	
	/**
	 * Set the location to the beginning of the DLL.
	 */
	public function rewind()
	{
		$this->pointer = $this->first;
	}
	
	/**
	 * Set the location to the end of the DLL.
	 */
	public function last()
	{
		$this->pointer = $this->last;
	}
	
	/**
	 * Insert a node before another node,
	 * 
	 * @param T $data	The data to add to the new node
	 * @param int $node	The key for the node to insert before
	 */
	public function insertBefore<T>(T $data, int $node)
	{
		// Verify the data integrity.
		if (false === $this->integrityCheck($data, $node)) {
			return;
		}
		
		// Data for the next node
		$nextNode = $this->dllData[$node];
		
		// Create the new node.
		$this->dllData[$this->openIndex] = tuple($nextNode[0], $data, $node);
		
		// Save the location of the new node.
		$thisNode = $this->openIndex;
		
		// Increment the open index to the next available index slot.
		$this->openIndex++;
		
		if (null === $nextNode[0]) {
			
			// If $node is at the beginning, then set the new node as the first node.
			$this->first = $thisNode;
			
		} else {
			
			// Set the previous node to point to the new node.
			$this->dllData[$nextNode[0]][2] = $thisNode;
			
		}
		
		// $node's prev pointer points to the new node.
		$this->dllData[$node][0] = $thisNode;
	}
	
	/**
	 * Insert a node after another node,
	 *
	 * @param T $data	The data to add to the new node
	 * @param int $node	The key for the node to insert after
	 */
	public function insertAfter<T>(T $data, int $node)
	{
		// Verify the data integrity.
		if (false === $this->integrityCheck($data, $node)) {
			return;
		}
		
		$prevNode = $this->dllData[$node];
		$this->dllData[$this->openIndex] = tuple($node, $data, $prevNode[2]);
		$thisNode = $this->openIndex;
		$this->openIndex++;
		
		if (null === $prevNode[2]) {
			$this->last = $thisNode;
		} else {
			$this->dllData[$prevNode[2]][0] = $thisNode;
		}
		
		$this->dllData[$node][2] = $thisNode;
	}
	
	/**
	 * Insert a node at the beginning of the DLL.
	 * 
	 * @param T $data The data for the new node
	 */
	public function insertBeginning<T>(T $data)
	{
		// Feeling a bit empty?
		if (0 === $this->dllData->count()) {
			
			/*
			 * Avoid bugs in 3rd party code by using the next open index in case they don't
			 * check if the DLL is empty. (Ex. All nodes got removed.)
			 */
			$this->dllData[$this->openIndex] = tuple(null, $data, null);
			$this->last = $this->openIndex;
			
		} else {
			
			$this->dllData[$this->openIndex] = tuple(null, $data, $this->first);
			$this->dllData[$this->first][0] = $this->openIndex;
			
		}
		
		$this->first = $this->openIndex;
		$this->openIndex++;
	}
	
	/**
	 * Insert a node at the end of the DLL.
	 *
	 * @param T $data The data for the new node
	 */
	public function insertEnd<T>(T $data)
	{
		if (0 === $this->dllData->count()) {
			
			$this->dllData[$this->openIndex] = tuple(null, $data, null);
			$this->first = $this->openIndex;
			
		} else {
			
			$this->dllData[$this->openIndex] = tuple($this->last, $data, null);
			$this->dllData[$this->last][2] = $this->openIndex;
			
		}
		
		$this->last = $this->openIndex;
		$this->openIndex++;
	}
	
	/**
	 * Remove a node from the DLL.
	 * 
	 * @param int $node The key of the node to delete
	 */
	public function remove(int $node)
	{
		if (false === $this->dllData->containsKey($node)) {
			throw new DoublyLinkedListException('Invalid index');
		}
		
		$thisNode = $this->dllData[$node];
		
		if (null !== $thisNode[0] && null !== $thisNode[2]) {
			
			// Set the next and previous nodes to each other.
			$this->dllData[$thisNode[0]][2] = $thisNode[2];
			$this->dllData[$thisNode[2]][0] = $thisNode[0];
			
		} else if (null !== $thisNode[0]) {
			
			// The previous node's next pointer gets set to null since the current node was the last node.
			$this->dllData[$thisNode[0]][2] = null;
			$this->last = $thisNode[0];
			
		} else if (null !== $thisNode[2]) {
			
			// The next node's previous pointer gets set to null since the current node was the first node.
			$this->dllData[$thisNode[2]][0] = null;
			$this->first = $thisNode[2];
			
		}
		
		unset($this->dllData[$node]);
	}
	
	/**
	 * Check that the DLL is not empty and that the requested key exists.
	 * 
	 * @param T $data	The data to insert into the DLL if it's empty
	 * @param int $node	The node to check
	 * 
	 * @access protected
	 * 
	 * @returns bool True if the data is valid or false if the data was handled by insertBeginning()
	 */
	protected function integrityCheck<T>(T $data, int $node) : bool
	{
		// If we don't have any data yet, add it to the beginning of the DLL.
		if (0 === $this->dllData->count()) {
			$this->insertBeginning($data);
			return false;
		}
		
		// The node we're inserting it before does not exist.
		if (false === $this->dllData->containsKey($node)) {
			throw new DoublyLinkedListException('Invalid index');
		}
		
		return true;
	}
}
