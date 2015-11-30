<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Ternary Search Tree (TST)
 * Learn more:
 * @link https://en.wikipedia.org/wiki/Ternary_search_tree
 * @link http://algs4.cs.princeton.edu/52trie/TST.java.html
 */

namespace HackFastAlgos\DataStructure;

class TernarySearchTrie
{
	private int $trieSize = 0;
	private ?Node $root = null;

	public function __construct()
	{
		$this->root = new Node();
	}

	public function get(String $key) : int
	{

	}

	public function put(String $key, int $value)
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
}
