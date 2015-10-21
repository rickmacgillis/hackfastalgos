<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class BSTTest extends \PHPUnit_Framework_TestCase
{
	public function testCanInsertItemIntoBST()
	{
		$bst = new DataStructure\BST();
		$bst->insert(10);

		$this->assertSame(1, $bst->count());
		$this->assertTrue($bst->itemExists(10));
	}

	public function testCanInsertMultipleItemsIntoBSTAtOnceAndFindEachItem()
	{
		$bst = new DataStructure\BST();
		$bst->fromVector(Vector{10,4,32,6,1,8,66,100,3});

		$this->assertSame(9, $bst->count());
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
}
