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
}
