<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a generic binary tree node
 */

namespace HackFastAlgos\DataStructure;

class TreeNode
{
	const bool RED = true;
	const bool BLACK = false;

	public ?T $value = null;
	public T $key = null;
	public bool $color = TreeNode::BLACK;
	public int $height = 0;
	public int $size = 0;

	public ?TreeNode $parent = null;

	public ?TreeNode $leftChild = null;
	public ?TreeNode $middleChild = null;
	public ?TreeNode $rightChild = null;

	public function attachLeftChild(TreeNode $leftChild)
	{
		$this->leftChild = $leftChild;
		$leftChild->parent = $this;
	}

	public function attachMiddleChild(TreeNode $middleChild)
	{
		$this->middleChild = $middleChild;
		$middleChild->parent = $this;
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

	public function attachAsMiddleChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->middleChild = $this;
	}

	public function attachAsRightChildOf(TreeNode $parent)
	{
		$this->parent = $parent;
		$parent->rightChild = $this;
	}

	public function hasChild() : bool
	{
		return $this->leftChild !== null || $this->middleChild !== null || $this->rightChild !== null;
	}

	public function isRed() : bool
	{
		return $this->color === static::RED;
	}

	public function disownMe()
	{
		if ($this->parent === null) {
			return;
		}

		if ($this->isLeftChild()) {
			$this->parent->leftChild = null;
		}

		if ($this->isRightChild()) {
			$this->parent->rightChild = null;
		}
	}

	public function isLeftChild() : bool
	{
		return $this->parent->leftChild === $this;
	}

	public function isRightChild() : bool
	{
		return $this->parent->rightChild === $this;
	}
}
