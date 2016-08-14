<?HH

use HackFastAlgos\DataStructure\RBTree as RBTree;
use HackFastAlgos\DataStructure\RBTreeIsEmptyException as RBTreeIsEmptyException;
use HackFastAlgos\DataStructure\RBTreeKeyNotFoundException as RBTreeKeyNotFoundException;
use HackFastAlgos\DataStructure\RBTreeKeyIsEmptyStringException as RBTreeKeyIsEmptyStringException;

class RBTreeTest extends \PHPUnit_Framework_TestCase
{
	public function testWillThrowExceptionWhenAddingEmptyKey()
	{
		$rbTree = new RBTree<int>();
		try {

			$rbTree->put('', 0);
			$this->fail;

		} catch (RBTreeKeyIsEmptyStringException $e) {}
	}

	public function testWillThrowExceptionWhenTreeIsEmpty()
	{
		$rbTree = new RBTree<int>();
		try {

			$rbTree->get('test');
			$this->fail;

		} catch (RBTreeIsEmptyException $e) {}
	}

	public function testCanPutAndGetSameString()
	{
		$rbTree = new RBTree<int>();

		$rbTree->put('test', 0);
		$this->assertSame(0, $rbTree->get('test'));
	}

	public function testTrieContainsStringWhenItExists()
	{
		$rbTree = new RBTree<int>();
		$this->assertFalse($rbTree->contains('test'));

		$rbTree->put('test', 0);
		$this->assertTrue($rbTree->contains('test'));
	}

	public function testCanInsertAndRetrieveMultipleWords()
	{
		$rbTree = new RBTree<int>();

		$rbTree->put('test', 0);
		$rbTree->put('try', 1);
		$rbTree->put('te', 2);
		$rbTree->put('testing', 3);
		$rbTree->put('apple', 4);
		$rbTree->put('zebra', 5);
		$rbTree->put('ali-zebu', 6);

		$this->assertSame(0, $rbTree->get('test'));
		$this->assertSame(1, $rbTree->get('try'));
		$this->assertSame(2, $rbTree->get('te'));
		$this->assertSame(3, $rbTree->get('testing'));
		$this->assertSame(4, $rbTree->get('apple'));
		$this->assertSame(5, $rbTree->get('zebra'));
		$this->assertSame(6, $rbTree->get('ali-zebu'));

		$this->assertTrue($rbTree->contains('test'));
		$this->assertTrue($rbTree->contains('try'));
		$this->assertTrue($rbTree->contains('te'));
		$this->assertTrue($rbTree->contains('testing'));
		$this->assertTrue($rbTree->contains('apple'));
		$this->assertTrue($rbTree->contains('zebra'));
		$this->assertTrue($rbTree->contains('ali-zebu'));
	}

	public function testGetMinWillThrowExceptionOnEmptyTree()
	{
		$rbTree = new RBTree<int>();
		try {

			$rbTree->getMin();
			$this->fail();

		} catch (RBTreeIsEmptyException $e) {}
	}

	public function testGetMaxWillThrowExceptionOnEmptyTree()
	{
		$rbTree = new RBTree<int>();
		try {

			$rbTree->getMax();
			$this->fail();

		} catch (RBTreeIsEmptyException $e) {}
	}

	public function testCanGetMinKey()
	{
		$rbTree = new RBTree<int>();

		$rbTree->put('test', 0);
		$rbTree->put('try', 1);
		$rbTree->put('te', 2);
		$rbTree->put('testing', 3);
		$rbTree->put('apple', 4);
		$rbTree->put('zebra', 5);
		$rbTree->put('ali-zebu', 6);

		$this->assertSame(6, $rbTree->getMin());
	}

	public function testCanGetMaxKey()
	{
		$rbTree = new RBTree<int>();

		$rbTree->put('test', 0);
		$rbTree->put('try', 1);
		$rbTree->put('te', 2);
		$rbTree->put('testing', 3);
		$rbTree->put('apple', 4);
		$rbTree->put('zebra', 5);
		$rbTree->put('ali-zebu', 6);

		$this->assertSame(5, $rbTree->getMax());
	}

	public function testCanDeleteItemsFromTheTreeWithoutDataLoss()
	{
		$rbTree = new RBTree<int>();

		$rbTree->put('test', 0);
		$rbTree->put('try', 1);
		$rbTree->put('te', 2);
		$rbTree->put('testing', 3);
		$rbTree->put('apple', 4);
		$rbTree->put('zebra', 5);
		$rbTree->put('ali-zebu', 6);

		$rbTree->delete('te');$rbTree->delete('te');
		$this->assertFalse($rbTree->contains('te'));
	}
}
