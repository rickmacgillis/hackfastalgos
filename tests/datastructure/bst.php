<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class BSTTest extends \PHPUnit_Framework_TestCase
{
	public function testCanInsertItemIntoBST()
	{
		$bst = new DataStructure\BST();
		$bst->insert(10);

		$this->assertTrue($bst->itemExists(10));
	}

	public function testCanCountBST()
	{
		$bst = new DataStructure\BST();
		$bst->insert(10);

		$this->assertSame(1, $bst->count());
	}

	public function testCanInsertMultipleItemsIntoBSTAtOnceAndFindEachItem()
	{
		$bst = new DataStructure\BST();
		$bst->fromVector(Vector{10,4,32,6,1,8,66,100,3});

		$this->assertSame(9, $bst->count());
		$this->assertTrue($bst->itemExists(10));
		$this->assertTrue($bst->itemExists(4));
		$this->assertTrue($bst->itemExists(32));
		$this->assertTrue($bst->itemExists(6));
		$this->assertTrue($bst->itemExists(1));
		$this->assertTrue($bst->itemExists(8));
		$this->assertTrue($bst->itemExists(66));
		$this->assertTrue($bst->itemExists(100));
		$this->assertTrue($bst->itemExists(3));
	}

	public function testWillThrowExceptionWhenInsertingTheSameitemTwice()
	{
		$bst = new DataStructure\BST();
		$bst->insert(10);

		try {
			$bst->insert(10);
			$this->fail();
		} catch (DataStructure\BSTItemExistsException $e) {}
	}

	public function testCanFindMinimumValueItem()
	{
		$bst = new DataStructure\BST();
		$bst->fromVector(Vector{10,4,32,6,1,8,66,100,3});

		$this->assertSame(1, $bst->getMin());
	}

	public function testCanFindMaximumValueItem()
	{
		$bst = new DataStructure\BST();
		$bst->fromVector(Vector{10,4,32,6,1,8,66,100,3});

		$this->assertSame(100, $bst->getMax());
	}

	public function testCanDeleteAnItemFromBst()
	{
		$bst = new DataStructure\BST();
		$bst->insert(10);

		$this->assertSame(1, $bst->count());

		$bst->delete(10);
		$this->assertSame(0, $bst->count());
		$this->assertFalse($bst->itemExists(10));
	}

	public function testCanDeleteRootFromBstWhenTreeIsFull()
	{
		$bst = new DataStructure\BST();
		$bst->fromVector(Vector{10,4,32,6,1,8,66,100,3});

		$this->assertSame(9, $bst->count());

		$bst->delete(10);
		$this->assertSame(8, $bst->count());
		$this->assertFalse($bst->itemExists(10));
		$this->assertTrue($bst->itemExists(4));
		$this->assertTrue($bst->itemExists(32));
	}

	public function testCanDeleteMultipleItemsFromBstWhenTreeIsFull()
	{
		$bst = new DataStructure\BST();
		$bst->fromVector(Vector{10,4,32,6,1,8,66,100,3});

		$this->assertSame(9, $bst->count());

		$bst->delete(4);
		$this->assertSame(8, $bst->count());
		$this->assertFalse($bst->itemExists(4));
		$this->assertTrue($bst->itemExists(3));
		$this->assertTrue($bst->itemExists(1));
		$this->assertTrue($bst->itemExists(6));

		$bst->delete(32);
		$this->assertSame(7, $bst->count());
		$this->assertFalse($bst->itemExists(32));
		$this->assertTrue($bst->itemExists(66));
		$this->assertTrue($bst->itemExists(100));
	}
}
