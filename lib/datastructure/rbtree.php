<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a Left-Leaning Red-Black Tree (LLRB Tree)
 *
 * Note: Red-Black Trees are very confusing. I've written some notes on to make it easier to grasp.
 * Also, check out the Wikipedia tree rotation animation to which I've linked nearby.
 *
 * Learn more
 * @link https://en.wikipedia.org/wiki/Red%E2%80%93black_tree
 * @link https://en.wikipedia.org/wiki/Left-leaning_red%E2%80%93black_tree
 * @link http://www.cs.princeton.edu/~rs/talks/LLRB/LLRB.pdf
 * @link http://algs4.cs.princeton.edu/33balanced/RedBlackBST.java.html
 * @link https://en.wikipedia.org/wiki/Tree_rotation
 */

namespace HackFastAlgos\DataStructure;

class RBTree
{
	public function get(string $key) : ?int
	{

	}

	public function contains(string $key) : bool
	{
		return $this->get($key) !== null;
	}

	public function put(string $key, int $value)
	{

	}

	public function delete(string $key)
	{

	}

	public function deleteMin()
	{

	}

	public function deleteMax()
	{

	}

	public function getMin()
	{

	}

	public function getMax()
	{

	}

	private function rotateLeft(TreeNode $topNode)
	{
		// https://en.wikipedia.org/wiki/File:Tree_rotation_animation_250x250.gif
		$rightChild = $topNode->rightChild;					// Hooks into B circle
		$topNode->attachRightChild($rightChild->leftChild);	// Moves the Beta sub-tree
		$rightChild->parent = $topNode->parent;				// Not drawn in the animation - References the root node of A and B circles
		$rightChild->attachLeftChild($topNode);				// Reattaches B to A with the proper relations

		$rightChild->color = $rightChild->leftChild->color;	// Move the color up the tree
		$rightChild->leftChild->color = TreeNode::RED;		// B-A is now red

		return $rightChild;	// New root of this madness
	}

	private function rotateRight(TreeNode $topNode)
	{
		// https://en.wikipedia.org/wiki/File:Tree_rotation_animation_250x250.gif
		$leftChild = $topNode->leftChild;					// Hooks into A circle
		$topNode->attachLeftChild($leftChild->rightChild);	// Moves the Beta sub-tree
		$leftChild->parent = $topNode->parent;				// Not drawn in the animation - References the root node of A and B circles
		$leftChild->attachRightChild($topNode);				// Reattaches A to B with the proper relations

		$leftChild->color = $leftChild->rightChild->color;	// Move the color up the tree
		$leftChild->rightChild->color = TreeNode::RED;		// A-B is now red

		return $leftChild;	// New root of this madness
	}

	private function flipColors(TreeNode $topNode)
	{
		$topNode->color = !$topNode->color;
		$topNode->leftChild->color = !$topNode->leftChild->color;
		$topNode->rightChild->color = !$topNode->rightChild->color;
	}

	private function isRed(?TreeNode $node) : bool
	{
		return $node === null ? false : $node->color;
	}

	private function balance()
	{

	}
}
