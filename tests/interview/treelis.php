<?HH

use HackFastAlgos\Interview\TreeLIS as TreeLis;
use HackFastAlgos\DataStructure\TreeNode as TreeNode;

class TreeLisTest extends \PHPUnit_Framework_TestCase
{
	public function testWillThrowExceptionWhenTreeIsTooShallow()
	{
		$treeNode = new TreeNode();

		try {
			$treeLis = new TreeLis($treeNode);
			$this->fail();
		} catch (HackFastAlgos\Interview\TreeLISTreeIsTooShallowException $e) {}

		$treeNode = new TreeNode();
		$treeNode->attachLeftChild(new TreeNode());

		try {
			$treeLis = new TreeLis($treeNode);
			$this->fail();
		} catch (HackFastAlgos\Interview\TreeLISTreeIsTooShallowException $e) {}
	}

	public function testCanFindLISWhenTreeIsDeepEnough()
	{
		/*
		 *              a1
		 *             /  \
		 *            a2   a3
		 *           / \    \
		 *          a4  a5  a6
		 *              / \
		 *             a7  a8
		 */

		$a1 = new TreeNode();
		$a2 = new TreeNode();
		$a3 = new TreeNode();
		$a4 = new TreeNode();
		$a5 = new TreeNode();
		$a6 = new TreeNode();
		$a7 = new TreeNode();
		$a8 = new TreeNode();

		$a1->attachLeftChild($a2);
		$a1->attachRightChild($a3);

		$a2->attachLeftChild($a4);
		$a2->attachRightChild($a5);

		$a3->attachRightChild($a6);

		$a5->attachLeftChild($a7);
		$a5->attachRightChild($a8);

		$treeLis = new TreeLis($a1);
		$this->assertSame(5, $treeLis->getLis());
	}
}
