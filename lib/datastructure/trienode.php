<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a node for an R-Way Trie
 */

namespace HackFastAlgos\DataStructure;

class TrieNode
{
	public ?T $value = null;

	private array $children = [];

	public function getChild(string $char) : ?TrieNode
	{
		if (array_key_exists($char, $this->children)) {
			return $this->children[$char];
		}

		return null;
	}

	public function addChild(string $char)
	{
		if ($this->getChild($char) === null) {
			$this->children[$char] = new TrieNode();
		}
	}

	public function getChildren() : array
	{
		return $this->children;
	}

	public function hasChildren() : bool
	{
		return $this->getChildren() !== [];
	}

	public function removeChild(string $char)
	{
		unset($this->children[$char]);
	}
}
