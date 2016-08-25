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

	public function testCanSetAndGetMiddleChild()
	{
		$treeNode = new TreeNode();
		$treeNodeMiddleChild = new TreeNode();

		$this->assertSame(null, $treeNode->middleChild);

		$treeNode->middleChild = $treeNodeMiddleChild;
		$this->assertSame($treeNodeMiddleChild, $treeNode->middleChild);
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
		$treeNodeLeftChild->attachLeftChild(null);

		$this->assertSame($treeNodeLeftChild, $treeNode->leftChild);
		$this->assertSame($treeNode, $treeNodeLeftChild->parent);
		$this->assertSame(null, $treeNodeLeftChild->leftChild);
	}

	public function testCanAttachMiddleChild()
	{
		$treeNode = new TreeNode();
		$treeNodeMiddleChild = new TreeNode();

		$treeNode->attachMiddleChild($treeNodeMiddleChild);
		$treeNodeMiddleChild->attachMiddleChild(null);

		$this->assertSame($treeNodeMiddleChild, $treeNode->middleChild);
		$this->assertSame($treeNode, $treeNodeMiddleChild->parent);
		$this->assertSame(null, $treeNodeMiddleChild->middleChild);
	}

	public function testCanAttachRightChild()
	{
		$treeNode = new TreeNode();
		$treeNodeRightChild = new TreeNode();

		$treeNode->attachRightChild($treeNodeRightChild);
		$treeNodeRightChild->attachRightChild(null);

		$this->assertSame($treeNodeRightChild, $treeNode->rightChild);
		$this->assertSame($treeNode, $treeNodeRightChild->parent);
		$this->assertSame(null, $treeNodeRightChild->rightChild);
	}

	public function testCanAttachSelfAsLeftChild()
	{
		$treeNode = new TreeNode();
		$treeNodeLeftChild = new TreeNode();

		$treeNodeLeftChild->attachAsLeftChildOf($treeNode);

		$this->assertSame($treeNodeLeftChild, $treeNode->leftChild);
		$this->assertSame($treeNode, $treeNodeLeftChild->parent);
	}

	public function testCanAttachSelfAsMiddleChild()
	{
		$treeNode = new TreeNode();
		$treeNodeMiddleChild = new TreeNode();

		$treeNodeMiddleChild->attachAsMiddleChildOf($treeNode);

		$this->assertSame($treeNodeMiddleChild, $treeNode->middleChild);
		$this->assertSame($treeNode, $treeNodeMiddleChild->parent);
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
		$treeNodeMiddleChild = new TreeNode();
		$treeNode->attachMiddleChild($treeNodeMiddleChild);
		$this->assertTrue($treeNode->hasChild());

		$treeNode = new TreeNode();
		$treeNodeLeftChild = new TreeNode();
		$treeNode->attachLeftChild($treeNodeLeftChild);
		$this->assertTrue($treeNode->hasChild());
	}

	public function testCanGetAndSetKey()
	{
		$treeNode = new TreeNode();
		$this->assertSame(null, $treeNode->key);

		$treeNode->key = 'a';
		$this->assertSame('a', $treeNode->key);
	}

	public function testCanGetAndSetNodeColor()
	{
		$treeNode = new TreeNode();

		$this->assertFalse($treeNode->isRed());

		$treeNode->color = TreeNode::RED;
		$this->assertTrue($treeNode->isRed());
	}

	public function testCanMakeParentDisownItsLeftChild()
	{
		$parent = new TreeNode();
		$leftChild = new TreeNode();
		$rightChild = new TreeNode();

		$parent->attachLeftChild($leftChild);
		$parent->attachRightChild($rightChild);

		$this->assertSame($leftChild, $parent->leftChild);

		$leftChild->disownMe();
		$this->assertSame(null, $parent->leftChild);
	}

	public function testCanMakeParentDisownItsRightChild()
	{
		$parent = new TreeNode();
		$leftChild = new TreeNode();
		$rightChild = new TreeNode();

		$parent->attachLeftChild($leftChild);
		$parent->attachRightChild($rightChild);

		$this->assertSame($rightChild, $parent->rightChild);

		$rightChild->disownMe();
		$this->assertSame(null, $parent->rightChild);
	}

	public function testCanChangeHeight()
	{
		$node = new TreeNode();

		$this->assertSame(0, $node->height);

		$node->height = 1;
		$this->assertSame(1, $node->height);
	}

	public function testCanChangeSize()
	{
		$node = new TreeNode();

		$this->assertSame(0, $node->size);

		$node->size = 1;
		$this->assertSame(1, $node->size);
	}
}
