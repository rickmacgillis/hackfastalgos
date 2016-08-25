<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of an Order Statistic Tree based on an AVL Tree
 *
 * Learn more
 * @link https://en.wikipedia.org/wiki/Order_statistic_tree
 * @link https://en.wikipedia.org/wiki/AVL_tree
 */

namespace HackFastAlgos\DataStructure;

class OrderStatisticTree<T> extends AVLTree
{
  /**
   * Operates on O(log n) or Omega(1) time.
   */
  public function select(int $ithOrderstatistic) : ?T
	{
    if ($this->getTreeSize() < $ithOrderstatistic || $ithOrderstatistic < 1) {
      return null;
    }

    $node = $this->getIthOrderNodeStartingAt($ithOrderstatistic, $this->root);
    return $node->value;
	}

  /**
   * Operates on O(log n) or Omega(1) time.
   */
	public function getRank(int $key) : ?int
	{
    $node = $this->getNodeForKeyStartingAt($key, $this->root);
    return $node === null ? null : $this->getrankForNode($node);
	}

  /**
   * Operates on O(log n) or Omega(1) time.
   */
  private function getrankForNode(TreeNode $node) : int
  {
    $rank = $node->size;

    if ($node->rightChild !== null) {
      $rank -= $node->rightChild->size;
    }

    while ($node !== $this->root) {

      $parentNode = $node->parent;
      if ($parentNode->rightChild === $node) {

        if ($parentNode->leftChild !== null) {
          $rank += $parentNode->leftChild->size;
        }

        $rank++;

      }

      $node = $parentNode;

    }

    return $rank;
  }

  /**
   * Operates on O(log n) or Omega(1) time.
   */
  private function getIthOrderNodeStartingAt(int $ithOrderstatistic, TreeNode $node) : TreeNode
  {
    if ($node === null) {
      return null;
    }

    $currentStatistic = $node->leftChild === null ? 1 : $node->leftChild->size+1;

    if ($currentStatistic === $ithOrderstatistic) {
      return $node;
    }

    if ($ithOrderstatistic < $currentStatistic) {
      return $this->getIthOrderNodeStartingAt($ithOrderstatistic, $node->leftChild);
    }

    if ($ithOrderstatistic > $currentStatistic) {

      $statisticForRightSubtree = $ithOrderstatistic - $currentStatistic;
      return $this->getIthOrderNodeStartingAt($statisticForRightSubtree, $node->rightChild);

    }
  }
}
