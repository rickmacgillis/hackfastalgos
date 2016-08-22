<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of Dijkstra's Algorithm (Designed based on the specification on page 633 of CtCi)
 * Learn more
 * @link https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
 * @link http://algs4.cs.princeton.edu/44sp/DijkstraSP.java.html
 */

namespace HackFastAlgos;

use HackFastAlgos\DataStructure\GraphNode as GraphNode;
use HackFastAlgos\DataStructure\PriorityQueue as PriorityQueue;

class DijkstrasAlgorithmHasNegativeEdgeLengthsException extends \Exception{}
class DijkstrasAlgorithmNoPreviousNodeException extends \Exception{}

class DijkstrasAlgorithm
{
  private Map<String, int> $pathWeight = Map{};
  private Map<String, GraphNode> $previousNode = Map{};
  private ?PriorityQueue $remainingNodes = null;

  public function __construct(private GraphNode $start)
  {
    $this->pathWeight[$start->getUniqueId()] = 0;
    $this->remainingNodes = new PriorityQueue('min');
    $this->remainingNodes->enqueue($start, 0);
  }

  /**
   * Operates in O((E + N) log N) amortized time or Omega(log N) where E is the number of edges and N is the number
   * of nodes in the graph. Omega(log N) is only possible if the first edge encountered has a negative edge weight,
   * thus throwing an exception.
   *
   * The reason that I've noted this method in amortized time is because we could visit nodes more than one time.
   * Consider what happens if we visit a node the second time using a shorter path than the first visit.
   *
   * You could scope the algorithm by limiting how large of path is acceptible when checking if we should add in a
   * new node or not. Consider what a GPS does. Your destination is a set distance from your current location in a
   * straight line. If you square that number, then you can avoid going out further than it's physically possible
   * to travel on a 2D plane. That square accounts for variations. No one will drive in a perfect zigzag to fill
   * the entire square area between the two end points, and they may need to drive further than the destination
   * just to come back.
   */
  public function buildPath()
  {
    while ($this->remainingNodes->isEmpty() === false) {

      $node = $this->remainingNodes->dequeue();
      $this->processNodesAdjacentOn($node);

    }
  }

  public function getPreviousNodeFor(GraphNode $node) : GraphNode
  {
    $this->throwIfNoPreviousNodeFor($node);
    return $this->previousNode[$node->getUniqueId()];
  }

  /**
   * Operates in Omega(E) or Omega(1) time where E is the number of edges incident on the originating node.
   * Omega(1) is only possible if it throws an exception for a negative edge weight on the first run.
   */
  private function processNodesAdjacentOn(GraphNode $node)
  {
    for ($i = 0; $i < $node->countWeightedEdges(); $i++) {

      $targetNodeWeight = $node->getEdgeWeight($i);
      $targetNode = $node->getWeightedEdgeNode($i);
      $previousPathWeight = $this->getPathWeightFor($node);

      $this->throwIfNodeHasNegativeEdgeWeight($targetNode, $targetNodeWeight);

      $currentShortestPathToTarget= $this->getPathWeightFor($targetNode);
      $proposedNewPath = $previousPathWeight + $targetNodeWeight;

      // You could scope the algorithm here. See the notes on buildPath() above.
      if ($currentShortestPathToTarget === null || $currentShortestPathToTarget > $proposedNewPath) {

        $this->pathWeight[$targetNode->getUniqueId()] = $targetNodeWeight + $previousPathWeight;
        $this->previousNode[$targetNode->getUniqueId()] = $node;
        $this->remainingNodes->enqueue($targetNode, $targetNodeWeight);

      }

    }
  }

  private function getPathWeightFor(GraphNode $node) : ?int
  {
    return $this->pathWeight->containsKey($node->getUniqueId()) ? $this->pathWeight[$node->getUniqueId()] : null;
  }

  private function throwIfNoPreviousNodeFor(GraphNode $node)
  {
    if ($this->previousNode->containsKey($node->getUniqueId()) === false) {
      throw new DijkstrasAlgorithmNoPreviousNodeException($node->getUniqueId());
    }
  }

  private function throwIfNodeHasNegativeEdgeWeight(GraphNode $node, int $weight)
  {
    if ($weight < 0) {
      throw new DijkstrasAlgorithmHasNegativeEdgeLengthsException($node);
    }
  }
}
