<?HH

use HackFastAlgos\DataStructure\AVLTree as AVLTree;
use HackFastAlgos\DataStructure\TreeNode as TreeNode;

class AVLTreeTest extends \PHPUnit_Framework_TestCase
{
  public function testCanCheckIfAVLTreeIsEmpty()
  {
    $avlTree = new AVLTree();

    $this->assertTrue($avlTree->isEmpty());

    $avlTree->put(1, "a");
    $this->assertFalse($avlTree->isEmpty());
  }

  public function testCanCheckSizeOfAVLTree()
  {
    $avlTree = new AVLTree();

    $this->assertSame(0, $avlTree->getTreeSize());

    $avlTree->put(1, "a");
    $this->assertSame(1, $avlTree->getTreeSize());
  }

  public function testCanCheckHeightOfTheTree()
  {
    $avlTree = new AVLTree();

    $this->assertSame(0, $avlTree->getTreeHeight());

    $avlTree->put(1, "a");
    $this->assertSame(0, $avlTree->getTreeHeight());

    $avlTree->put(2, "b");
    $this->assertSame(1, $avlTree->getTreeHeight());

    $avlTree->put(3, "c");
    $avlTree->put(4, "d");
    $this->assertSame(2, $avlTree->getTreeHeight());
  }

  public function testCanInsertAndGetItems()
  {
    $avlTree = new AVLTree<String>();

    $avlTree->put(1, "a");
    $avlTree->put(2, "b");
    $avlTree->put(3, "c");
    $avlTree->put(4, "d");
    $avlTree->put(5, "e");
    $avlTree->put(6, "f");
    $avlTree->put(7, "g");

    $this->assertSame("a", $avlTree->get(1));
    $this->assertSame("b", $avlTree->get(2));
    $this->assertSame("c", $avlTree->get(3));
    $this->assertSame("d", $avlTree->get(4));
    $this->assertSame("e", $avlTree->get(5));
    $this->assertSame("f", $avlTree->get(6));
    $this->assertSame("g", $avlTree->get(7));
  }

  public function testCanCheckIfTreeContainsKey()
  {
    $avlTree = new AVLTree<String>();

    $this->assertFalse($avlTree->contains(3));

    $avlTree->put(1, "a");
    $avlTree->put(2, "b");
    $avlTree->put(3, "c");
    $this->assertTrue($avlTree->contains(1));
    $this->assertTrue($avlTree->contains(2));
    $this->assertTrue($avlTree->contains(3));

    $this->assertFalse($avlTree->contains(4));

    $avlTree->put(4, "d");
    $avlTree->put(5, "e");
    $avlTree->put(6, "f");
    $avlTree->put(7, "g");
    $this->assertTrue($avlTree->contains(4));
    $this->assertTrue($avlTree->contains(5));
    $this->assertTrue($avlTree->contains(6));
    $this->assertTrue($avlTree->contains(7));

  }

  public function testCanDeleteItemsFromTree()
  {
    $avlTree = new AVLTree<String>();

    $avlTree->put(1, "a");
    $avlTree->put(2, "b");
    $avlTree->put(3, "c");
    $avlTree->put(4, "d");
    $avlTree->put(5, "e");
    $avlTree->put(6, "f");
    $avlTree->put(7, "g");

    $this->assertTrue($avlTree->contains(1));
    $this->assertTrue($avlTree->contains(2));
    $this->assertTrue($avlTree->contains(3));
    $this->assertTrue($avlTree->contains(4));
    $this->assertTrue($avlTree->contains(5));
    $this->assertTrue($avlTree->contains(6));
    $this->assertTrue($avlTree->contains(7));

    $avlTree->delete(3);
    $this->assertTrue($avlTree->contains(1));
    $this->assertTrue($avlTree->contains(2));

    $this->assertFalse($avlTree->contains(3));

    $this->assertTrue($avlTree->contains(4));
    $this->assertTrue($avlTree->contains(5));
    $this->assertTrue($avlTree->contains(6));
    $this->assertTrue($avlTree->contains(7));

    $avlTree->delete(1);
    $avlTree->delete(2);
    $avlTree->delete(3);

    $this->assertTrue($avlTree->contains(4));

    $avlTree->delete(7);
    $this->assertTrue($avlTree->contains(6));

    $avlTree->delete(6);
    $avlTree->delete(5);
    $avlTree->delete(4);

    $this->assertFalse($avlTree->contains(1));
    $this->assertFalse($avlTree->contains(2));
    $this->assertFalse($avlTree->contains(3));
    $this->assertFalse($avlTree->contains(4));
    $this->assertFalse($avlTree->contains(5));
    $this->assertFalse($avlTree->contains(6));
    $this->assertFalse($avlTree->contains(7));

  }
}
