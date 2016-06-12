<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a hash table using a doubly linked list
 */

namespace HackFastAlgos\DataStructure;

class HashTableChain extends HashTable
{
	protected int $totalItems = 0;
	protected int $iterationPtr = 0;

	private array $hashes = [];
	private int $dllPtr = 1;
	private int $hashesPtr = 0;
	private array $hashTableData = [];

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	public function insert<T>(T $key, T $value)
	{
		$hash = $this->hash($key);
		$this->createLinkedListIfNeeded($hash);
		$this->addItemToLinkedList($key, $value, $hash);
		$this->totalItems++;
	}

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	public function delete<T>(T $key)
	{
		$hash = $this->hash($key);
		if ($this->hashExists($hash)) {
			$this->deleteFromLinkedList($key, $hash);
		}
	}

	public function count() : int
	{
		return $this->totalItems;
	}

	public function current<T>() : T
	{
		$data = $this->getDataFromPointedToLinkedList();
		return $data[1];
	}

	public function key<T>() : T
	{
		$data = $this->getDataFromPointedToLinkedList();
		return $data[0];
	}

	public function next()
	{
		$this->incrementPointers();
	}

	public function prev()
	{
		$this->decrementPointers();
	}

	public function rewind()
	{
		$this->iterationPtr = 0;
		$this->dllPtr = 1;
		$this->hashesPtr = 0;
		$this->hashes = array_keys($this->hashTableData);
	}

	private function createLinkedListIfNeeded(int $hash)
	{
		if (!$this->hashExists($hash)) {
			$this->makeLinkedListAtHash($hash);
		}
	}

	private function hashExists(int $hash) : bool
	{
		return array_key_exists($hash, $this->hashTableData);
	}

	private function makeLinkedListAtHash(int $hash)
	{
		$this->hashTableData[$hash] = new DoublyLinkedList();
	}

	private function addItemToLinkedList<T>(T $key, T $value, int $hash)
	{
		$this->delete($key);
		$this->hashTableData[$hash]->insertEnd(Vector{$key, $value});
	}

	protected function getValueForKey<T>(T $key, int $hash) : T
	{
		$vector = $this->getNodeAndValueForKey($key, $hash);
		return $vector[1];
	}

	private function getNodeAndValueForKey<T>(T $key, int $hash) : Vector<T>
	{
		$this->throwIfInvalidAddress($hash);

		$dll = $this->hashTableData[$hash];
		$dll->rewind();
		while ($dll->valid()) {

			$data = $dll->current();
			if ($data[0] === $key) {
				return Vector{$dll->key(), $data[1]};
			}

			$dll->next();

		}

		$this->throwOobException();
	}

	private function throwIfInvalidAddress(int $hash)
	{
		if (!$this->hashExists($hash)) {
			$this->throwOobException();
		}
	}

	private function throwOobException()
	{
		throw new HashTableOutOfBoundsException();
	}

	private function deleteFromLinkedList<T>(T $key, int $hash)
	{
		try {

			$node = $this->getNodeFromKey($key, $hash);
			$this->deleteLinkedListNode($node, $hash);
			$this->totalItems--;

		} catch (HashTableOutOfBoundsException $e) {}
	}

	protected function getNodeFromKey<T>(T $key, int $hash) : LinkedListNode
	{
		$vector = $this->getNodeAndValueForKey($key, $hash);
		return $vector[0];
	}

	private function deleteLinkedListNode(LinkedListNode $node, int $hash)
	{
		$this->hashTableData[$hash]->removeNode($node);
	}

	private function getDataFromPointedToLinkedList() : Vector<T>
	{
		$dll = $this->getLinkedListPointedTo();
		return $this->getDataAtLinkedListNode($this->dllPtr, $dll);
	}

	private function getDataAtLinkedListNode<T>(int $nodeNumber, DoublyLinkedList $dll) : Vector<T>
	{
		$dll->rewind();
		for ($i = 1; $i < $nodeNumber && $dll->valid(); $i++) {
			$dll->next();
		}

		return $dll->current();
	}

	private function incrementPointers()
	{
		$dll = $this->getLinkedListPointedTo();
		if ($this->dllPtr < $dll->count()) {
			$this->dllPtr++;
		} else {
			$this->dllPtr = 1;
			$this->hashesPtr++;
		}

		$this->iterationPtr++;
	}

	private function getLinkedListPointedTo()
	{
		return $this->hashTableData[$this->hashes[$this->hashesPtr]];
	}

	private function decrementPointers()
	{
		$dll = $this->getLinkedListPointedTo();
		if ($this->dllPtr > 1) {
			$this->dllPtr--;
		} else {
			$this->dllPtr = 1;
			$this->hashesPtr--;
		}

		$this->iterationPtr--;
	}
}
