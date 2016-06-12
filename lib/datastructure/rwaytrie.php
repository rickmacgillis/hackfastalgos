<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of an R-Way Trie
 *
 * Learn more @link http://algs4.cs.princeton.edu/52trie/TrieST.java.html
 */

namespace HackFastAlgos\DataStructure;

class RWayTrie
{
	private TrieNode $root;
	private TrieNode $lastNodeInPrefix;
	private int $longestPrefixOffset = 0;

	public function __construct()
	{
		$this->root = new TrieNode();
	}

	/**
	 * Operates on O(L) or Omega(1) time where L is the length of the string for which we're searching.
	 */
	public function get(string $string) : ?int
	{
		$node = $this->root;
		$stringLength = strlen($string);
		for ($i = 0; $i < $stringLength; $i++) {

			$char = $string[$i];
			$node = $node->getChild($char);

			if ($node === null) {

				$this->longestPrefixOffset = $i;
				return null;

			}

		}

		$this->longestPrefixOffset = $i;
		$this->lastNodeInPrefix = $node;
		return $node->value;
	}

	/**
	 * Operates in Theta(L) time where L is the length of the string being added.
	 */
	public function put(string $string, ?int $value)
	{
		$node = $this->root;
		$stringLength = strlen($string);
		for ($i = 0; $i < $stringLength; $i++) {

			$char = $string[$i];
			$node->addChild($char);
			$node = $node->getChild($char);

		}

		$node->value = $value;
	}

	public function delete(string $string)
	{
		if ($this->contains($string) === false) {
			return;
		}

		$this->put($string, null);
		$this->removeDeletedStringStartingAt($string, $this->root);
	}

	public function contains(string $string) : bool
	{
		return $this->get($string) !== null;
	}

	public function getKeys() : Vector<string>
	{
		$stack = new Vector();
		$this->addKeysStartingAtNode($this->root, $stack);
		return $stack;
	}

	public function getKeysWithPrefix(string $prefix) : Vector<string>
	{
		$this->get($prefix);
		$stack = new Vector();
		$this->addKeysStartingAtNode($this->lastNodeInPrefix, $stack, $prefix);
		return $stack;
	}

	public function getLongestPrefixOf(string $string) : string
	{
		$this->get($string);
		return substr($string, 0, $this->longestPrefixOffset);
	}

	/**
	 * Operates in Theta(L) time.
	 */
	private function removeDeletedStringStartingAt(string $string, TrieNode $node, int $offset = -1)
	{
		$stringLength = strlen($string);
		$secondFromLast = $stringLength-2;
		$nextChar = $string[$offset+1];
		$nextNode = $node->getChild($nextChar);

		if ($offset < $secondFromLast) {
			$this->removeDeletedStringStartingAt($string, $nextNode, $offset+1);
		}

		if ($nextNode->hasChildren() === false && $nextNode->value === null) {
			$node->removeChild($nextChar);
		}
	}

	/**
	 * Operates in Theta(N) time where N is the size of the trie at the given node.
	 */
	private function addKeysStartingAtNode(TrieNode $node, Vector<string> &$stack, string $string = '')
	{
		if ($node->value !== null) {
			$stack[] = $string;
		}

		$children = $node->getChildren();
		foreach ($children as $char => $childNode) {
			$this->addKeysStartingAtNode($childNode, $stack, $string . $char);
		}
	}
}
