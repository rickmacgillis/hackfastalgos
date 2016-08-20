<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a node for use in graphs
 */

namespace HackFastAlgos\DataStructure;

class GraphNode
{
  public function __construct(public int $inboundEdgeCount = 0, public array<GraphNode> $outbound = []){}

  public function addEdgeTo(GraphNode $node)
  {
    $this->outbound[] = $node;
  }
}
