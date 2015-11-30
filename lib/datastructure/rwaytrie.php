<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of an R-Way Trie
 *
 * Learn more @link http://algs4.cs.princeton.edu/52trie/TrieST.java.html
 */

namespace HackFastAlgos\DataStructure;

class RWayTrie
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
