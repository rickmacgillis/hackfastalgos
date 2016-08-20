<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of Dijkstra's Algorithm
 * Learn more
 * @link https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
 * @link http://algs4.cs.princeton.edu/44sp/DijkstraSP.java.html
 */

namespace HackFastAlgos;

use HackFastAlgos\DataStructure\GraphNode as GraphNode;

class DijkstrasAlgorithmHasNegativeEdgeLengthsException extends \Exception{}

class DijkstrasAlgorithm
{
  public function __construct(private array<GraphNode> $nodes)
  {

  }
}
