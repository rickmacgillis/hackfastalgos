<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a generic binary tree node
 */

namespace HackFastAlgos\DataStructure;

class TreeNode
{
	public ?T $value = null;

	public ?TreeNode $parent = null;
	public ?TreeNode $leftChild = null;
	public ?TreeNode $rightChild = null;

	public function attachLeftChild(TreeNode $leftChild)
	{
		$this->leftChild = $leftChild;
		$leftChild->parent = $this;
	}

	public function attachRightChild(TreeNode $rightChild)
	{
		$this->rightChild = $rightChild;
		$rightChild->parent = $this;
	}

	public function attachAsLeftChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->leftChild = $this;
	}

	public function attachAsRightChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->rightChild = $this;
	}

	public function hasChild() : bool
	{
		return $this->leftChild !== null || $this->rightChild !== null;
	}
}
