<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a node for use in graphs
 */

namespace HackFastAlgos\DataStructure;

class GraphNode
{
  public int $inboundEdgeCount = 0;
  public array<GraphNode> $outbound = [];
  public array<array<GraphNode, int>> $weightedEdges = [];

  public function addEdgeTo(GraphNode $node)
  {
    $this->outbound[] = $node;
  }

  public function addWeightedEdgeTo(int $weight, GraphNode $node)
  {
    $this->weightedEdges[] = [$node, $weight];
  }
}
