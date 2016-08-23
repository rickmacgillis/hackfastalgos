<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of an AVL Tree
 * Learn more
 * @link https://en.wikipedia.org/wiki/AVL_tree
 * @link http://algs4.cs.princeton.edu/code/edu/princeton/cs/algs4/AVLTreeST.java.html
 */

namespace HackFastAlgos\DataStructure;

class AVLTree<T>
{
  private TreeNode $root = null;

  public function isEmpty() : bool
  {
    return $this->root === null;
  }

  public function getTreeSize() : int
  {
    return $this->getSizeAt($this->root);
  }

  public function getTreeHeight() : int
  {
    return $this->getHeightAt($this->root);
  }

  public function contains(int $key) : bool
  {
    return $this->get($key) !== null;
  }

  public function get(int $key) : ?T
  {
    $node = $this->getNodeForKeyStartingAt($key, $this->root);
    return $node === null ? null : $node->value;
  }

  public function put(int $key, T $value)
  {
    $this->root = $this->putValueAtKeyAndGetRoot($value, $key, $this->root);
    $this->fixRootHeight();
  }

  public function delete(int $key)
  {
    $this->root = $this->deleteKeyAndGetRoot($key, $this->root);
    $this->fixRootHeight();
  }

  private function getSizeAt(?TreeNode $node) : int
  {
    return $node === null ? 0 : $node->size;
  }

  private function getHeightAt(?TreeNode $node) : int
  {
    return $node === null ? 0 : $node->height;
  }

  private function getNodeForKeyStartingAt(int $key, ?TreeNode $node) : ?TreeNode
  {
    if ($node === null) {
      return null;
    }

    $compare = $this->compare($key, $node->key);

    if ($compare < 0) {
      return $this->getNodeForKeyStartingAt($key, $node->leftChild);
    }

    if ($compare > 0) {
      return $this->getNodeForKeyStartingAt($key, $node->rightChild);
    }

    return $node;
  }

  private function fixRootHeight()
  {
    if ($this->root !== null) {
      $this->root->height = $this->getHeightForNode($this->root);
    }
  }

  private function compare(int $key1, int $key2) : int
  {
    if ($key1 < $key2) {
      return -1;
    }

    if ($key1 > $key2) {
      return 1;
    }

    return 0;
  }

  private function putValueAtKeyAndGetRoot(T $value, int $key, ?TreeNode $node) : TreeNode
  {
    if ($node === null) {
      return $this->makeNode($key, $value, null);
    }

    $compare = $this->compare($key, $node->key);

    if ($compare < 0) {
      $node->leftChild = $this->putValueAtKeyAndGetRoot($value, $key, $node->leftChild);
    } else if ($compare > 0) {
      $node->rightChild = $this->putValueAtKeyAndGetRoot($value, $key, $node->rightChild);
    } else {

      $node->value = $value;
      return $node;

    }

    $node->size = $this->getSizeForNode($node);
    $node->height = $this->getHeightForNode($node);

    return $this->balanceAtNodeAndGetRoot($node);
  }

  private function makeNode(int $key, T $value, ?TreeNode $parent) : TreeNode
  {
    $node = new TreeNode();
    $node->key = $key;
    $node->value = $value;
    $node->parent = $parent;
    $node->height = 0;
    $node->size = 1;

    return $node;
  }

  private function getSizeForNode(TreeNode $node) : int
  {
    return 1 + $this->getSizeAt($node->leftChild) + $this->getSizeAt($node->rightChild);
  }

  private function getHeightForNode(TreeNode $node) : int
  {
    if ($node->hasChild() === false) {
      return 0;
    }

    return 1 + max($this->getHeightAt($node->leftChild), $this->getHeightAt($node->rightChild));
  }

  private function balanceAtNodeAndGetRoot(TreeNode $node) : TreeNode
  {
    $balanceFactor = $this->getBalanceFactorAtNode($node);

    if ($balanceFactor < -1) {

      if ($this->getBalanceFactorAtNode($node->rightChild) > 0) {
        $node->rightChild = $this->rotateRightAndGetRoot($node->rightChild);
      }

      $node = $this->rotateLeftAndGetRoot($node);

    }

    if ($balanceFactor > 1) {

      if ($this->getBalanceFactorAtNode($node->leftChild) < 0) {
        $node->leftChild = $this->rotateLeftAndGetRoot($node->leftChild);
      }

      $node = $this->rotateRightAndGetRoot($node);

    }

    return $node;
  }

  private function getBalanceFactorAtNode(TreeNode $node) : int
  {
    return $this->getHeightAt($node->leftChild) - $this->getHeightAt($node->rightChild);
  }

  private function rotateRightAndGetRoot(TreeNode $node) : TreeNode
  {
    $leftChild = $node->leftChild;
    $node->leftChild = $leftChild->rightChild;
    $leftChild->rightChild = $node;

    $leftChild->size = $node->size;
    $node->size = $this->getSizeForNode($node);
    $leftChild->height = $this->getHeightForNode($leftChild);
    $node->height = $this->getHeightForNode($node);

    return $leftChild;
  }

  private function rotateLeftAndGetRoot(TreeNode $node) : TreeNode
  {
    $rightChild = $node->rightChild;
    $node->rightChild = $rightChild->leftChild;
    $rightChild->leftChild = $node;

    $rightChild->size = $node->size;
    $node->size = $this->getSizeForNode($node);
    $rightChild->height = $this->getHeightForNode($rightChild);
    $node->height = $this->getHeightForNode($node);

    return $rightChild;
  }

  private function deleteKeyAndGetRoot(int $key, ?TreeNode $node) : ?TreeNode
  {
    if ($node === null) {
      return null;
    }

    $compare = $this->compare($key, $node->key);
    if ($compare < 0) {
      $node->leftChild = $this->deleteKeyAndGetRoot($key, $node->leftChild);
    } elseif ($compare > 0) {
      $node->rightChild = $this->deleteKeyAndGetRoot($key, $node->rightChild);
    } else {

      if ($node->leftChild === null) {
        return $node->rightChild;
      } elseif ($node->rightChild === null) {
        return $node->leftChild;
      } else {
        $node = $this->makeRightMinBecomeThisNode($node);
      }

    }

    $node->size = $this->getSizeForNode($node);
    $node->height = $this->getHeightForNode($node);
    return $this->balanceAtNodeAndGetRoot($node);
  }

  private function makeRightMinBecomeThisNode(TreeNode $node) : TreeNode
  {
    $nodeClode = $node;
    $node = $this->getMinAt($nodeClode->rightChild);
    $node->rightChild = $this->deleteMinAndGetRoot($nodeClode->rightChild);
    $node->leftChild = $nodeClode->leftChild;

    return $node;
  }

  private function getMinAt(?TreeNode $node) : TreeNode
  {
    return $node->leftChild === null ? $node : $this->getMinAt($node->leftChild);
  }

  private function deleteMinAndGetRoot(TreeNode $node) : ?TreeNode
  {
    if ($node->leftChild === null) {
      return $node->rightChild;
    }

    $node->leftChild = $this->deleteMinAndGetRoot($node->leftChild);
    $node->size = $this->getSizeAt($node->size);
    $node->height = $this->getHeightAt($node->height);
    return $this->balanceAtNodeAndGetRoot($node);
  }
}
