<?HH

use HackFastAlgos\DataStructure\OrderStatisticTree as OrderStatisticTree;

class OrderStatisticTreeTest extends \PHPUnit_Framework_TestCase
{
  public function testCanGetTheRankOfAnItem()
  {
    $osTree = new OrderStatisticTree<String>();

    $this->assertSame(null, $osTree->getRank(1));

    $osTree->put(1, "One");
    $this->assertSame(1, $osTree->getRank(1));

    $osTree->put(2, "Two");
    $osTree->put(3, "Three");
    $osTree->put(4, "Four");
    $osTree->put(5, "Five");
    $osTree->put(6, "Six");
    $osTree->put(7, "Seven");
    $osTree->put(8, "Eight");
    $osTree->put(9, "Nine");
    $this->assertSame(7, $osTree->getRank(7));
    $this->assertSame(8, $osTree->getRank(8));

    $osTree->put(10, "Ten");
    $this->assertSame(10, $osTree->getRank(10));
  }

  public function testCanGetTheIthOrderStatistic()
  {
    $osTree = new OrderStatisticTree<String>();

    $this->assertSame(null, $osTree->select(1));

    $osTree->put(1, "One");
    $osTree->put(2, "Two");
    $osTree->put(3, "Three");
    $osTree->put(4, "Four");
    $osTree->put(5, "Five");
    $osTree->put(6, "Six");
    $osTree->put(7, "Seven");
    $osTree->put(8, "Eight");
    $osTree->put(9, "Nine");
    $this->assertSame("Seven", $osTree->select(7));
    $this->assertSame("Eight", $osTree->select(8));

    $osTree->put(10, "Ten");
    $this->assertSame("Ten", $osTree->select(10));

    $this->assertSame(null, $osTree->select(11));
    $this->assertSame(null, $osTree->select(100));
  }
}
