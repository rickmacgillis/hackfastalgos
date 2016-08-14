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

class RBTreeIsEmptyException extends \Exception{}
class RBTreeKeyNotFoundException extends \Exception{}
class RBTreeKeyIsEmptyStringException extends \Exception{}

class RBTree<T>
{
	private ?TreeNode $root = null;

	public function get(string $key) : T
	{
		$this->throwIfEmptyTree();
		$node = $this->getNodeForKey($key, $this->root);
		$this->throwIfKeyIsNullNode($key, $node);

		return $node->value;
	}

	public function contains(string $key) : bool
	{
		try {
			$value = $this->get($key);
		} catch (\Exception $e) {
			return false;
		}

		return true;
	}

	public function put(string $key, T $value)
	{
		$this->throwIfEmptyKey($key);
		$newNode = $this->makeNode($key, $value);

		if ($this->root === null) {
			$this->root = $newNode;
		} else {
			$this->addNodeToTree($newNode, $this->root);
		}

		$this->root->color = TreeNode::BLACK;
	}

	public function delete(string $key)
	{
		if ($this->root === null || $this->contains($key) === false) {
			return;
		}

		if (!$this->isRed($this->root->leftChild) && !$this->isRed($this->root->rightChild)) {
			$this->root->color = TreeNode::RED;
		}

		$this->root = $this->deleteKeyAfterNode($key, $this->root);
		if ($this->root !== null) {
			$this->root->color = TreeNode::BLACK;
		}
	}

	public function getMin() : T
	{
		$this->throwIfEmptyTree();
		$node = $this->getMinAt($this->root);
		return $node->value;
	}

	public function getMax() : T
	{
		$this->throwIfEmptyTree();
		$node = $this->getMaxAt($this->root);
		return $node->value;
	}

	private function throwIfEmptyTree()
	{
		if ($this->root === null) {
			throw new RBTreeIsEmptyException();
		}
	}

	private function getMinAt(TreeNode $node)
	{
		return $node->leftChild === null ? $node : $this->getMinAt($node->leftChild);
	}

	private function getMaxAt(TreeNode $node)
	{
		return $node->rightChild === null ? $node : $this->getMaxAt($node->rightChild);
	}

	/**
	 * Operates in O(log N)
	 */
	private function getNodeForKey(string $key, ?TreeNode $node) : ?TreeNode
	{
		if ($node === null) {
			return null;
		}

		$compare = $this->compare($key, $node->key);
		if ($compare < 0) {
			return $this->getNodeForKey($key, $node->leftChild);
		} elseif ($compare > 0) {
			return $this->getNodeForKey($key, $node->rightChild);
		}

		return $node;
	}

	private function compare(string $key1, string $key2)
	{
		return strcmp($key1, $key2);
	}

	private function throwIfKeyIsNullNode(string $key, ?TreeNode $node)
	{
		if ($node === null) {
			throw new RBTreeKeyNotFoundException($key);
		}
	}

	private function throwIfEmptyKey(string $key)
	{
		if ($key === '') {
			throw new RBTreeKeyIsEmptyStringException();
		}
	}

	private function makeNode(string $key, T $value)
	{
		$newNode = new TreeNode();
		$newNode->key = $key;
		$newNode->value = $value;

		return $newNode;
	}

	/**
	 * Operates in O(log N) or Omega(1) time
	 */
	private function addNodeToTree(TreeNode $newNode, ?TreeNode $node) : TreeNode
	{
		if ($node === null) {
			return $newNode;
		}

		$compare = $this->compare($newNode->key, $node->key);
		if ($compare < 0) {

			$leftChild = $this->addNodeToTree($newNode, $node->leftChild);
			$node->attachLeftChild($leftChild);

		} elseif ($compare > 0) {

			$rightChild = $this->addNodeToTree($newNode, $node->rightChild);
			$node->attachRightChild($rightChild);

		} else {
			$node->value = $newNode->value;
		}

		$this->fixRightLeaningLinksAtNode($node);
		return $node;
	}

	private function fixRightLeaningLinksAtNode(TreeNode $node)
	{
		$leftChild = $node->leftChild;
		$rightChild = $node->rightChild;

		if ($this->isRed($rightChild) && !$this->isRed($leftChild)) {
			$node = $this->rotateLeft($node);
		}

		if ($this->isRed($leftChild) && $this->isRed($leftChild->leftChild)) {
			$node = $this->rotateRight($node);
		}

		if ($this->isRed($leftChild) && $this->isRed($rightChild)) {
			$this->flipColors($node);
		}
	}

	private function isRed(?TreeNode $node) : bool
	{
		return $node === null ? false : $node->color;
	}

	private function rotateLeft(TreeNode $topNode) : TreeNode
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

	private function rotateRight(TreeNode $topNode) : TreeNode
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

	private function deleteKeyAfterNode(string $key, TreeNode $node) : ?TreeNode
	{
		if ($this->compare($key, $node->key) < 0) {

			if ($this->hasBlackLeftChildAndGrandchild($node)){
				$node = $this->moveRedLeft($node);
			}

			$this->deleteKeyAfterNode($key, $node->leftChild);

		} else {

			if ($this->isRed($node->leftChild)) {
				$node = $this->rotateRight($node);
			}

			if ($this->compare($key, $node->key) === 0 && $node->rightChild === null) {
				return null;
			}

			if ($this->hasBlackRightChildAndRightLeftChild($node)) {
				$node = $this->moveRedRight($node);
			}

			if ($this->compare($key, $node->key) === 0) {

					$minRightNode = $this->getMinAt($node->rightChild);
					$node->key = $minRightNode->key;
					$node->value = $minRightNode->value;
					$node->rightChild = $this->deleteMinAt($node->rightChild);

			} else {
				$node->rightChild = $this->deleteKeyAfterNode($key, $node->rightChild);
			}

		}

		return $this->balanceAt($node);
	}

	private function hasBlackLeftChildAndGrandchild(TreeNode $node) : bool
	{
		$leftChildIsBlack = $this->isRed($node->leftChild) === false;
		$leftGrandchildIsBlack = $this->isRed($node->leftChild->leftChild) === false;

		return $leftChildIsBlack && $leftGrandchildIsBlack;
	}

	private function moveRedLeft(TreeNode $node) : TreeNode
	{
		$this->flipColors($node);
		if ($this->isRed($node->rightChild->leftChild)) {

			$node->rightChild = $this->rotateRight($node->rightChild);
			$node = $this->rotateLeft($node);
			$this->flipColors($node);

		}

		return $node;
	}

	private function hasBlackRightChildAndRightLeftChild(TreeNode $node) : bool
	{
		$rightChildIsBlack = $this->isRed($node->rightChild) === false;
		$rightLeftChildIsBlack = $this->isRed($node->rightChild->leftChild) === false;

		return $rightChildIsBlack && $rightLeftChildIsBlack;
	}

	private function moveRedRight(TreeNode $node) : TreeNode
	{
		$this->flipColors($node);
		if ($this->isRed($node->leftChild->leftChild)) {

			$node = $this->rotateRight($node);
			$this->flipColors($node);

		}

		return $node;
	}

	private function deleteMinAt(TreeNode $node) : TreeNode
	{
		if ($node->leftChild === null) {
			return null;
		}

		if ($this->hasBlackLeftChildAndGrandchild($node)) {
			$node = $this->moveRedLeft($node);
		}

		$node->leftChild = $this->deleteMinAt($node->leftChild);
		return $this->balanceAt($node);
	}

	private function balanceAt(TreeNode $node) : TreeNode
	{
		if ($this->isRed($node->rightChild)) {
			$node = $this->rotateLeft($node);
		}

		if ($this->isRed($node->leftChild) && $this->isRed($node->leftChild->leftChild)) {
			$node = $this->rotateRight($node);
		}

		if ($this->isRed($node->leftChild) && $this->isRed($node->rightChild)) {
			$this->flipColors($node);
		}

		return $node;
	}
}
