<?HH
/**
 * @author Rick Mac Gillis
 *
 * Abstraction of a hash table (Also called a hash map, dictionary, symbol
 * table, flibber jabber, or Jabberwocky)
 * Learn more @link https://en.wikipedia.org/wiki/Hash_table
 */

namespace HackFastAlgos\DataStructure;

abstract class HashTable implements \Countable, \ArrayAccess, \Iterator
{
	/**
	 * T will be either a vector with the key at position 0 and the value at position 1 for open
	 * addressing, or it'll be a linked list following the pattern key->value->key->value->...
	 * for the chaining collision handling.
	 */

	abstract public function insert<T>(T $key, T $value);
	abstract public function delete<T>(T $key);
	abstract public function contains<T>(T $key) : bool;
	abstract public function lookup<T>(T $key) : T;
	abstract public function count() : int;
	abstract public function current<T>() : T;
	abstract public function key<T>() : T;
	abstract public function valid() : bool;
	abstract public function next();
	abstract public function prev();
	abstract public function rewind();

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
		return $murmur->hash($key);
	}
}
