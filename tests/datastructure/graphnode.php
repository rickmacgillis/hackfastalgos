<?HH

use HackFastAlgos\DataStructure\GraphNode as GraphNode;
use HackFastAlgos\DataStructure\GraphNodeWeightedEdgeNotFoundException as GraphNodeWeightedEdgeNotFoundException;

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

  public function testCanChangeVisitedStatus()
  {
    $node = new GraphNode();

    $this->assertFalse($node->visited);

    $node->visited = true;
    $this->assertTrue($node->visited);
  }

  public function testCanAddWeightedEdgeToNode()
  {
    $node1 = new GraphNode();
    $node2 = new GraphNode();

    $node1->addWeightedEdgeTo(3, $node2);
    $this->assertSame(3, $node1->getEdgeWeight(0));
    $this->assertSame($node2, $node1->getWeightedEdgeNode(0));
  }

  public function testWillThrowExceptionWhenWeightedEdgeNotFound()
  {
    $node = new GraphNode();

    try {

      $node->getEdgeWeight(0);
      $this->fail();

    } catch(GraphNodeWeightedEdgeNotFoundException $e){}

    try {

      $node->getWeightedEdgeNode(0);
      $this->fail();

    } catch(GraphNodeWeightedEdgeNotFoundException $e){}
  }

  public function testCanCountWeightedEdges()
  {
    $node1 = new GraphNode();
    $node2 = new GraphNode();

    $this->assertSame(0, $node1->countWeightedEdges());

    $node1->addWeightedEdgeTo(3, $node2);
    $this->assertSame(1, $node1->countWeightedEdges());
  }

  public function testCanChangeNodeValue()
  {
    $node = new GraphNode();

    $this->assertSame(null, $node->value);

    $node->value = "test";
    $this->assertSame("test", $node->value);
  }

  public function testWillGenerateAUniqueId()
  {
    $node = new GraphNode("test");
    $this->assertSame("test", $node->getUniqueId());
  }
}
