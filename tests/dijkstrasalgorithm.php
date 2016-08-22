<?HH

use HackFastAlgos\DataStructure\GraphNode as GraphNode;
use HackFastAlgos\DijkstrasAlgorithm as DijkstrasAlgorithm;
use HackFastAlgos\DijkstrasAlgorithmHasNegativeEdgeLengthsException as DijkstrasAlgorithmHasNegativeEdgeLengthsException;
use HackFastAlgos\DijkstrasAlgorithmNoPreviousNodeException as DijkstrasAlgorithmNoPreviousNodeException;

class DijkstrasAlgorithmTest extends \PHPUnit_Framework_TestCase
{
  public function testCanFindShortestPath()
  {
    $nodes = $this->getStartAndEndNodes();
    $start = $nodes[0];
    $end = $nodes[1];

    $dijkstra = new DijkstrasAlgorithm($start);
    $dijkstra->buildPath();

    $previousNode = $dijkstra->getPreviousNodeFor($end);
    $this->assertEquals('g', $previousNode->getUniqueId());

    $previousNode = $dijkstra->getPreviousNodeFor($previousNode);
    $this->assertEquals('d', $previousNode->getUniqueId());

    $previousNode = $dijkstra->getPreviousNodeFor($previousNode);
    $this->assertEquals('c', $previousNode->getUniqueId());

    $previousNode = $dijkstra->getPreviousNodeFor($previousNode);
    $this->assertEquals('a', $previousNode->getUniqueId());
  }

  public function testWillThrowExceptionWhenPreviousNode()
  {
    $nodes = $this->getStartAndEndNodes();
    $start = $nodes[0];

    $dijkstra = new DijkstrasAlgorithm($start);
    $dijkstra->buildPath();

    $node = new GraphNode("dummy");

    try {

      $dijkstra->getPreviousNodeFor($node);
      $this->fail();

    } catch (DijkstrasAlgorithmNoPreviousNodeException $e){}
  }

  public function testWillThrowExceptionWhenGraphHasNegativeEdgeWeight()
  {
    $a = new GraphNode("a");
    $b = new GraphNode("b");
    $c = new GraphNode("c");

    $a->addWeightedEdgeTo(5, $b);
    $b->addWeightedEdgeTo(-1, $c);

    $dijkstra = new DijkstrasAlgorithm($a);

    try {

      $dijkstra->buildPath();
      $this->fail();

    } catch (DijkstrasAlgorithmHasNegativeEdgeLengthsException $e){}
  }

  private function getStartAndEndNodes()
  {
    // Graph on page 634 of CtCi
    $a = new GraphNode("a");
    $b = new GraphNode("b");
    $c = new GraphNode("c");
    $d = new GraphNode("d");
    $e = new GraphNode("e");
    $f = new GraphNode("f");
    $g = new GraphNode("g");
    $h = new GraphNode("h");
    $i = new GraphNode("i");

    $a->addWeightedEdgeTo(5, $b);
    $a->addWeightedEdgeTo(3, $c);
    $a->addWeightedEdgeTo(2, $e);

    $b->addWeightedEdgeTo(2, $d);

    $c->addWeightedEdgeTo(1, $b);
    $c->addWeightedEdgeTo(1, $d);

    $d->addWeightedEdgeTo(1, $a);
    $d->addWeightedEdgeTo(2, $g);
    $d->addWeightedEdgeTo(1, $h);

    $e->addWeightedEdgeTo(1, $a);
    $e->addWeightedEdgeTo(4, $h);
    $e->addWeightedEdgeTo(7, $i);

    $f->addWeightedEdgeTo(3, $b);
    $f->addWeightedEdgeTo(1, $g);

    $g->addWeightedEdgeTo(3, $c);
    $g->addWeightedEdgeTo(2, $i);

    $h->addWeightedEdgeTo(2, $g);
    $h->addWeightedEdgeTo(2, $f);
    $h->addWeightedEdgeTo(2, $c);

    return [$a, $i];
  }
}
