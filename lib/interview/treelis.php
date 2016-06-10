<?HH
/**
 * Asked in my Amazon practice interview through Gainlo:
 *
 * Puzzle:
 * Given a binary tree find the size of the largest independent set.
 * This means that no two nodes in final set have direct parent-child relationship.
 *
 *              a1
 *             /  \
 *            a2   a3
 *           / \    \
 *          a4  a5  a6
 *              / \
 *             a7  a8
 *
 *             Answer: a1,a4,a7,a8,a6 ---> LIS is 5
 */

namespace HackFastAlgos\Interview;

use HackFastAlgos\DataStructure\TreeNode as TreeNode;

class TreeLISTreeIsTooShallowException extends \Exception{}

class TreeLIS
{
	private int $lis = 0;

	public function __construct(private TreeNode $root)
	{
		$this->setLis();
	}

	public function getLis() : int
	{
		return $this->lis;
	}

	private function setLis()
	{
		$this->throwIfTooShallow();
		$this->lis = $this->findLis($this->root);
	}

	private function throwIfTooShallow()
	{
		if ($this->isTreeTooShallow() === true) {
			throw new TreeLISTreeIsTooShallowException();
		}
	}

	private function isTreeTooShallow() : bool
	{
		$leftChildHasChildren = $this->nodeHasChildren($this->root->leftChild);
		$rightChildHasChildren = $this->nodeHasChildren($this->root->rightChild);

		return $leftChildHasChildren === false && $rightChildHasChildren === false;
	}

	private function nodeHasChildren(?TreeNode $node) : bool
	{
		return $node !== null && $node->hasChild();
	}

	/**
	 * Operates in O(N) or Omega(1) time
	 */
	private function findLis(?TreeNode $node) : int
	{
		if ($node === null) {
			return 0;
		}

		$totalWithoutNode = $this->findLis($node->leftChild) + $this->findLis($node->rightChild);

		$totalWithNode = 1;
		if ($node->leftChild !== null) {
			$totalWithNode += $this->findLis($node->leftChild->leftChild) + $this->findLis($node->leftChild->rightChild);
		}

		if ($node->rightChild !== null) {
			$totalWithNode += $this->findLis($node->rightChild->leftChild) + $this->findLis($node->rightChild->rightChild);
		}

		return max($totalWithoutNode, $totalWithNode);
	}
}
