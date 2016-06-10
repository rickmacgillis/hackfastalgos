<?HH

use HackFastAlgos\DataStructure\TreeNode as TreeNode;

class TreeNodeTest extends \PHPUnit_Framework_TestCase
{
	public function testCanSetandGetValue()
	{
		$treeNode = new TreeNode();

		$treeNode = 1;
		$this->assertSame(1, $treeNode);

		$treeNode = 'a';
		$this->assertSame('a', $treeNode);
	}

	public function testCanSetAndGetParent()
	{
		$treeNode = new TreeNode();
		$treeNodeParent = new TreeNode();

		$this->assertSame(null, $treeNode->parent);

		$treeNode->parent = $treeNodeParent;
		$this->assertSame($treeNodeParent, $treeNode->parent);
	}

	public function testCanSetAndGetLeftChild()
	{
		$treeNode = new TreeNode();
		$treeNodeLeftChild = new TreeNode();

		$this->assertSame(null, $treeNode->leftChild);

		$treeNode->leftChild = $treeNodeLeftChild;
		$this->assertSame($treeNodeLeftChild, $treeNode->leftChild);
	}

	public function testCanSetAndGetRightChild()
	{
		$treeNode = new TreeNode();
		$treeNodeRightChild = new TreeNode();

		$this->assertSame(null, $treeNode->rightChild);

		$treeNode->rightChild = $treeNodeRightChild;
		$this->assertSame($treeNodeRightChild, $treeNode->rightChild);
	}

	public function testCanAttachLeftChild()
	{
		$treeNode = new TreeNode();
		$treeNodeLeftChild = new TreeNode();

		$treeNode->attachLeftChild($treeNodeLeftChild);

		$this->assertSame($treeNodeLeftChild, $treeNode->leftChild);
		$this->assertSame($treeNode, $treeNodeLeftChild->parent);
	}

	public function testCanAttachRightChild()
	{
		$treeNode = new TreeNode();
		$treeNodeRightChild = new TreeNode();

		$treeNode->attachRightChild($treeNodeRightChild);

		$this->assertSame($treeNodeRightChild, $treeNode->rightChild);
		$this->assertSame($treeNode, $treeNodeRightChild->parent);
	}

	public function testCanAttachSelfAsLeftChild()
	{
		$treeNode = new TreeNode();
		$treeNodeLeftChild = new TreeNode();

		$treeNodeLeftChild->attachAsLeftChildOf($treeNode);

		$this->assertSame($treeNodeLeftChild, $treeNode->leftChild);
		$this->assertSame($treeNode, $treeNodeLeftChild->parent);
	}

	public function testCanAttachSelfAsRightChild()
	{
		$treeNode = new TreeNode();
		$treeNodeRightChild = new TreeNode();

		$treeNodeRightChild->attachAsRightChildOf($treeNode);

		$this->assertSame($treeNodeRightChild, $treeNode->rightChild);
		$this->assertSame($treeNode, $treeNodeRightChild->parent);
	}

	public function testReturnsFalseWhenNoChildIsPresent()
	{
		$treeNode = new TreeNode();

		$this->assertFalse($treeNode->hasChild());
	}

	public function testReturnsTrueWhenNodeHasAtLeastOneChild()
	{
		$treeNode = new TreeNode();
		$treeNodeRightChild = new TreeNode();
		$treeNode->attachRightChild($treeNodeRightChild);
		$this->assertTrue($treeNode->hasChild());

		$treeNode = new TreeNode();
		$treeNodeLeftChild = new TreeNode();
		$treeNode->attachLeftChild($treeNodeLeftChild);
		$this->assertTrue($treeNode->hasChild());

		$treeNode->attachRightChild($treeNodeRightChild);
		$this->assertTrue($treeNode->hasChild());
	}
}
