<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a hash table using open addressing
 */

namespace HackFastAlgos\DataStructure;

class HashTableOAOutOfBoundsException extends \Exception{}

class HashTableOA extends HashTable
{
	private array $hashTableData = [];
	private int $totalItems = 0;
	private int $openAddrProbe = 23;
	private int $iterationPtr = 0;

	public function insert<T>(T $key, T $value)
	{
		$hash = $this->hash($key);
		$hashForKey = $this->getHashForKey($key);
		$this->hashTableData[$hashForKey] = Vector{$key, $value};
		$this->totalItems++;
	}

	public function delete<T>(T $key)
	{
		$hashForKey = $this->getHashForKey($key);
		$this->hashTableData[$hashForKey] = Vector{null, null};
		$this->totalItems--;
	}

	public function contains<T>(T $key) : bool
	{
		try {
			$this->lookup($key);
			return true;
		} catch (HashTableOAOutOfBoundsException $e) {
			return false;
		}
	}

	public function lookup<T>(T $key) : T
	{
		$hash = $this->hash($key);
		$value = $this->getValueForKey<T>($key);
		return $value;
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

	public function valid() : bool
	{
		if ($this->iterationPtr < 0 || $this->iterationPtr >= $this->totalItems) {
			return false;
		}
		return true;
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

	private function getValueForKey<T>(T $key) : T
	{
		$hash = $this->hash($key);
		while ($this->keyIsNotAtAddress($key, $hash)) {
			$hash = $this->getNextAddress($hash);
		}

		return $this->getValueFromHash($hash);
	}

	private function isOpenAddress(int $hash) : bool
	{
		return empty($this->hashTableData[$hash]) || $this->hashTableData[$hash] === null;
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
			throw new HashTableOAOutOfBoundsException();
		}
	}
}
