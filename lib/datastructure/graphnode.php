<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a node for use in graphs
 */

namespace HackFastAlgos\DataStructure;

class GraphNodeWeightedEdgeNotFoundException extends \Exception{}

class GraphNode
{
  public bool $visited = false;
  public int $inboundEdgeCount = 0;
  public array<GraphNode> $outbound = [];
  public String $value = null;

  public function __construct(private ?String $uniqueId = null){}

  private array<array<int, GraphNode>> $weightedEdges = [];

  public function addEdgeTo(GraphNode $node)
  {
    $this->outbound[] = $node;
  }

  public function addWeightedEdgeTo(int $weight, GraphNode $node)
  {
    $this->weightedEdges[] = [$weight, $node];
  }

  public function getEdgeWeight(int $edgeNumber) : int
  {
    $this->throwIfWeightedEdgeDoesNotExist($edgeNumber);
    return $this->weightedEdges[$edgeNumber][0];
  }

  public function getWeightedEdgeNode(int $edgeNumber) : GraphNode
  {
    $this->throwIfWeightedEdgeDoesNotExist($edgeNumber);
    return $this->weightedEdges[$edgeNumber][1];
  }

  public function countWeightedEdges() : int
  {
    return count($this->weightedEdges);
  }

  public function getUniqueId() : ?String
  {
    return $this->uniqueId;
  }

  private function throwIfWeightedEdgeDoesNotExist(int $edgeNumber)
  {
    if (array_key_exists($edgeNumber, $this->weightedEdges) === false) {
      throw new GraphNodeWeightedEdgeNotFoundException($edgeNumber);
    }
  }
}
