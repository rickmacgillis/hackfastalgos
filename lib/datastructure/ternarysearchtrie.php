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

class TernarySearchTrie
{
	private ?TreeNode $root = null;
	private int $longestPrefixOffset = 0;

	public function get(string $string) : ?int
	{
		if (strlen($string) === 0 || $this->root === null) {
			return null;
		}

		$node = $this->getLastNodeForString($this->root, $string);
		return $node === null ? null : $node->value;
	}

	public function put(string $string, ?int $value)
	{
		if (strlen($string) === 0) {
			return;
		}

		$this->root = $this->addNode($this->root, $string, $value);
	}

	public function delete(string $string)
	{
		$this->put($string, null);
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

	/*
	 * Operates in O(P + S) or Omega(1) where P is the prefix for all word and S is the length of all suffixes.
	 */
	public function getKeysWithPrefix(string $prefix) : Vector<string>
	{
		$stack = new Vector();
		if (strlen($prefix) === 0 || $this->root === null) {
			return $stack;
		}

		$node = $this->getLastNodeForString($this->root, $prefix);

		if ($node === null) {
			return $stack;
		}

		if ($node->value !== null) {
			$stack[] = $prefix;
		}

		$this->addKeysStartingAtNode($node->middleChild, $stack, $prefix);
		return $stack;
	}

	public function getLongestPrefixOf(string $string) : string
	{
		$this->get($string);
		return substr($string, 0, $this->longestPrefixOffset);
	}

	/*
	 * Operates in O(W) or Omega(1) time where W is the length of the word to locate.
	 */
	private function getLastNodeForString(?TreeNode $node, string $string, int $offset = 0) : ?TreeNode
	{
		if ($node === null) {
			return null;
		}

		$letterComparison = $this->compareAscii($string[$offset], $node->key);

		if ($letterComparison < 0) {

			$this->setLongestPrefixOffsetIfNull($node->leftChild, $offset);
			return $this->getLastNodeForString($node->leftChild, $string, $offset);

		} elseif ($letterComparison > 0) {

			$this->setLongestPrefixOffsetIfNull($node->rightChild, $offset);
			return $this->getLastNodeForString($node->rightChild, $string, $offset);

		} elseif ($offset < strlen($string)-1) {

			$this->setLongestPrefixOffsetIfNull($node->middleChild, $offset+1);
			return $this->getLastNodeForString($node->middleChild, $string, $offset+1);

		} else {

			$this->longestPrefixOffset = $offset+1;
			return $node;

		}
	}

	private function setLongestPrefixOffsetIfNull(?TreeNode $node, int $offset)
	{
		if ($node === null) {
			$this->longestPrefixOffset = $offset;
		}
	}

	private function addNode(?TreeNode $node, string $string, ?int $value, int $offset = 0) : TreeNode
	{
		$letter = $string[$offset];
		if ($node === null) {

			$node = new TreeNode();
			$node->key = $letter;

		}

		$this->attachChildNodeByComparison($node, $string, $value, $offset);
		return $node;
	}

	/**
	 * Operates in Theta(W) time where W is the length of the word being added.
	 */
	private function attachChildNodeByComparison(TreeNode &$node, string $string, ?int $value, int $offset)
	{
		$letterComparison = $this->compareAscii($string[$offset], $node->key);

		if ($letterComparison < 0) {

			$leftChild = $this->addNode($node->leftChild, $string, $value, $offset);
			$node->attachLeftChild($leftChild);

		} elseif ($letterComparison > 0) {

			$rightChild = $this->addNode($node->rightChild, $string, $value, $offset);
			$node->attachRightChild($rightChild);

		} elseif ($offset < strlen($string)-1) {

			$middleChild = $this->addNode($node->middleChild, $string, $value, $offset+1);
			$node->attachMiddleChild($middleChild);

		} else {
			$node->value = $value;
		}
	}

	private function compareAscii(string $key1, string $key2)
	{
		if (ord($key1) < ord($key2)) {
			return -1;
		} elseif (ord($key1) > ord($key2)) {
			return 1;
		} else {
			return 0;
		}
	}

	/*
	 * Operates in Theta(N) time where N is the size of the Trie at the given $node.
	 */
	private function addKeysStartingAtNode(?TreeNode $node, Vector<string> &$stack, string $string = '')
	{
		if ($node === null) {
			return;
		}

		if ($node->value !== null) {
			$stack[] = $string . $node->key;
		}

		$this->addKeysStartingAtNode($node->leftChild, $stack, $string);
		$this->addKeysStartingAtNode($node->middleChild, $stack, $string . $node->key);
		$this->addKeysStartingAtNode($node->rightChild, $stack, $string);
	}
}
