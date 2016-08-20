<?HH

use HackFastAlgos\TopSort as TopSort;
use HackFastAlgos\DataStructure\GraphNode as GraphNode;
use HackFastAlgos\TopSortHasCyclesException as TopSortHasCyclesException;

class TopSortTest extends \PHPUnit_Framework_TestCase
{
  public function testCanGetProperlySortedEdges()
  {
    $edges = $this->getNodeList();
    $expected = $this->getSortedList();

    $topSort = new TopSort();
    $topSort->sort($edges);

    $this->assertEquals($expected, $topSort->getSorted());
  }

  public function testWillThrowExceptionWhenHasCycle()
  {
    $corrupt = $this->getCorruptNodeList();
    $topSort = new TopSort();

    try {

      $topSort->sort($corrupt);
      $this->fail();

    } catch (TopSortHasCyclesException $e) {}
  }

  private function getNodeList()
  {
    $a = new GraphNode();
    $b = new GraphNode();
    $c = new GraphNode();
    $d = new GraphNode();
    $e = new GraphNode();
    $f = new GraphNode();

    $a->addEdgeTo($d);
    $f->addEdgeTo($b);
    $b->addEdgeTo($d);
    $f->addEdgeTo($a);
    $d->addEdgeTo($c);

    return [$a, $b, $c, $d, $e, $f];
  }

  private function getSortedList()
  {
    $nodes = $this->getNodeList();

    // 4=e, 5=f, 0=a, 1=b, 3=d, 2=c
    return [$nodes[4], $nodes[5], $nodes[0], $nodes[1], $nodes[3], $nodes[2]];
  }

  private function getCorruptNodeList()
  {
    $nodes = $this->getNodeList();

    // a -> d, d -> a
    $nodes[3]->addEdgeTo($nodes[0]);

    return $nodes;
  }
}
