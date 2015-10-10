<?HH
/**
 * @author Rick Mac Gillis
 *
 * Abstraction of a hash table (Also called a hash map, dictionary, symbol
 * table, flibber jabber, or Jabberwocky)
 * Learn more @link https://en.wikipedia.org/wiki/Hash_table
 */

namespace HackFastAlgos\DataStructure;

class HashTableOutOfBoundsException extends \Exception{}

abstract class HashTable implements \Countable, \ArrayAccess, \Iterator
{
	abstract public function insert<T>(T $key, T $value);
	abstract public function delete<T>(T $key);
	abstract public function count() : int;
	abstract public function current<T>() : T;
	abstract public function key<T>() : T;
	abstract public function next();
	abstract public function prev();
	abstract public function rewind();

	public function __construct(private $hashTableSize, private int $ddosSeed = 0){}

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	public function lookup<T>(T $key) : T
	{
		$hash = $this->hash($key);
		return $this->getValueForKey($key, $hash);
	}

	public function contains<T>(T $key) : bool
	{
		try {
			$this->lookup($key);
			return true;
		} catch (HashTableOutOfBoundsException $e) {
			return false;
		}
	}

	public function valid() : bool
	{
		if ($this->iterationPtr < 0 || $this->iterationPtr >= $this->totalItems) {
			return false;
		}
		return true;
	}

	public function offsetExists<T>(T $key) : bool
	{
		return $this->contains($key);
	}

	public function offsetGet<T>(T $key) : T
	{
		return $this->lookup($key);
	}

	public function offsetSet<T>(T $key, T $value)
	{
		$this->insert($key, $value);
	}

	public function offsetUnset<T>(T $key)
	{
		$this->delete($key);
	}

	protected function hash<T>(T $key) : int
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$hash = $murmur->hash($key, $this->ddosSeed);
		return $this->getReducedHashValue($hash);
	}

	private function getReducedHashValue(int $hash) : int
	{
		return $hash % ($this->hashTableSize * 8);
	}
}
