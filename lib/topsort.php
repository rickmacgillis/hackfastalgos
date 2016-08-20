<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of Topological Sort [derived from CtCi 6th Edition question 4.7
 * and the spec in "Advanced Topics" page 632]
 *
 * Learn more @link https://en.wikipedia.org/wiki/Topological_sorting
 */

namespace HackFastAlgos;

use HackFastAlgos\DataStructure\GraphNode as GraphNode;

class TopSortHasCyclesException extends \Exception{}

class TopSort
{
  private array<GraphNode> $sorted = [];
  private array<GraphNode> $processNext = [];
  private array<GraphNode> $nodes = [];

  /**
   * Operates in Theta(E + N) time where E is the number of edges, and N is the number of nodes.
   */
  public function sort(array<GraphNode> $nodes)
  {
    $this->nodes = $nodes;
    $this->setInboundEdges();
    $this->enqueueNonDependentNodes();
    $this->processNodes();
    $this->throwIfNotAllNodesPresent();
  }

  public function getSorted() : array<GraphNode>
  {
    return $this->sorted;
  }

  /**
   * Operates in Theta(E) time where E is the number of edges.
   */
  private function setInboundEdges()
  {
    for ($i = 0; $i < count($this->nodes); $i++) {

      $source = $this->nodes[$i];

      for ($j = 0; $j < count($source->outbound); $j++) {

        $target = $source->outbound[$j];
        $target->inboundEdgeCount++;

      }

    }
  }

  /**
   * Operates in Theta(N) time where N is the number of nodes in the input array.
   */
  private function enqueueNonDependentNodes()
  {
    for ($i = 0; $i < count($this->nodes); $i++) {

      $node = $this->nodes[$i];
      if ($node->inboundEdgeCount === 0) {
        $this->processNext[] = $node;
      }

    }
  }

  /**
   * Operates in O(E) or Omega(1) time depending on if there are cycles. [E is the number of edges]
   */
  private function processNodes()
  {
    while (empty($this->processNext) === false) {

      $source = array_shift($this->processNext);
      for ($i = 0; $i < count($source->outbound); $i++) {

        $target = $source->outbound[$i];
        $target->inboundEdgeCount--;

        if ($target->inboundEdgeCount === 0) {
          $this->processNext[] = $target;
        }

      }

      $this->sorted[] = $source;

    }
  }

  private function throwIfNotAllNodesPresent()
  {
    if (count($this->nodes) !== count($this->sorted)) {
      throw new TopSortHasCyclesException();
    }
  }
}
