<?HH

use HackFastAlgos\DataStructure\GraphNode as GraphNode;

class GraphNodeTest extends \PHPUnit_Framework_TestCase
{
  public function testCanReadWriteInboundEdgeCount()
  {
    $node = new GraphNode();

    $this->assertSame(0, $node->inboundEdgeCount);

    $node->inboundEdgeCount = 1;
    $this->assertSame(1, $node->inboundEdgeCount);
  }

  public function testCanAddEdgeToNode()
  {
    $node1 = new GraphNode();
    $node2 = new GraphNode();

    $node1->addEdgeTo($node2);
    $this->assertSame([$node2], $node1->outbound);
  }
}
