<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a Ternary Search Tree (TST)
 * Learn more:
 * @link https://en.wikipedia.org/wiki/Ternary_search_tree
 * @link http://algs4.cs.princeton.edu/52trie/TST.java.html
 */

namespace HackFastAlgos\DataStructure;

class TernarySearchTrie<T>
{
	private int $trieSize = 0;
	private ?Node $root = null;

	public function __construct()
	{
		$this->root = new Node();
	}

	public function get(String $key) : T
	{

	}

	public function put(String $key, T $value)
	{

	}

	public function delete(String $key)
	{

	}

	public function contains(String $key) : bool
	{

	}

	public function size() : int
	{
		return $this->trieSize;
	}

	public function getKeys() : Vector<string>
	{

	}

	public function getKeysWithPrefix(string $prefix) : Vector<string>
	{

	}

	public function getLongestPrefixOf(string $string) : string
	{

	}
}
