<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a hash table using open addressing
 */

namespace HackFastAlgos\DataStructure;

class HashTableOA extends HashTable
{
	protected int $totalItems = 0;
	protected int $iterationPtr = 0;

	private array $hashTableData = [];
	private int $openAddrProbe = 23;

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	public function insert<T>(T $key, T $value)
	{
		$hashForKey = $this->getHashForKey($key);
		$this->hashTableData[$hashForKey] = Vector{$key, $value};
		$this->totalItems++;
	}

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	public function delete<T>(T $key)
	{
		$hashForKey = $this->getHashForKey($key);
		if (!$this->isOpenAddress($hashForKey)) {
			$this->hashTableData[$hashForKey] = Vector{null, null};
			$this->totalItems--;
		}
	}

	public function count() : int
	{
		return $this->totalItems;
	}

	public function current<T>() : T
	{
		$hash = key($this->hashTableData);
		return $this->hashTableData[$hash][1];
	}

	public function key<T>() : T
	{
		$hash = key($this->hashTableData);
		return $this->hashTableData[$hash][0];
	}

	public function next()
	{
		$this->iterationPtr++;
		next($this->hashTableData);
	}

	public function prev()
	{
		$this->iterationPtr--;
		prev($this->hashTableData);
	}

	public function rewind()
	{
		$this->iterationPtr = 0;
		reset($this->hashTableData);
	}

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	private function getHashForKey<T>(T $key) : int
	{
		$hash = $this->hash($key);
		while ($this->keyIsNotAtAddress($key, $hash)) {
			$hash = $this->getNextAddress($hash);
		}

		return $hash;
	}

	private function keyIsNotAtAddress<T>(T $key, int $hash) : bool
	{
		return !$this->isOpenAddress($hash) && $this->getKeyFromHash($hash) !== $key;
	}

	private function getNextAddress(int $hash) : int
	{
		$hash += $this->openAddrProbe;
		return $hash;
	}

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	protected function getValueForKey<T>(T $key, int $hash) : T
	{
		while ($this->keyIsNotAtAddress($key, $hash)) {
			$hash = $this->getNextAddress($hash);
		}

		return $this->getValueFromHash($hash);
	}

	private function isOpenAddress(int $hash) : bool
	{
		return empty($this->hashTableData[$hash]) || $this->hashTableData[$hash] === Vector{null, null};
	}

	private function getKeyFromHash<T>(int $hash) : T
	{
		$this->throwIfInvalidAddress($hash);
		return $this->hashTableData[$hash][0];
	}

	private function getValueFromHash<T>(int $hash) : T
	{
		$this->throwIfInvalidAddress($hash);
		return $this->hashTableData[$hash][1];
	}

	private function throwIfInvalidAddress(int $hash)
	{
		if ($this->isOpenAddress($hash)) {
			throw new HashTableOutOfBoundsException();
		}
	}
}
