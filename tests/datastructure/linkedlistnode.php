<?HH

use \HackFastAlgos\DataStructure\LinkedListNode as LinkedListNode;

class NodeTest extends \PHPUnit_Framework_TestCase
{
	public function testCanSetAndGetNodeValue()
	{
		$node = new LinkedListNode();
		$this->assertSame(null, $node->getValue());

		$node->setValue('test');
		$this->assertSame('test', $node->getValue());

		$node->setValue(1);
		$this->assertSame(1, $node->getValue());
	}

	public function testCanSetAndGetNextNodeWithItsValue()
	{
		$node = new LinkedListNode();
		$nextNode = clone $node;

		$this->assertSame(null, $node->getNext());

		$node->setNext($nextNode);
		$this->assertSame($nextNode, $node->getNext());

		$this->assertSame(null, $node->getNext()->getValue());

		$node->getNext()->setValue('test');
		$this->assertSame('test', $node->getNext()->getValue());

		$this->assertSame(null, $node->getValue());

		$node->setValue('first node');
		$this->assertSame('first node', $node->getValue());
		$this->assertSame('test', $node->getNext()->getValue());
	}

	public function testCanSetAndGetPrevNodeWithItsValue()
	{
		$node = new LinkedListNode();
		$prevNode = clone $node;

		$this->assertSame(null, $node->getPrev());

		$node->setPrev($prevNode);
		$this->assertSame($prevNode, $node->getPrev());

		$this->assertSame(null, $node->getPrev()->getValue());

		$node->getPrev()->setValue('test');
		$this->assertSame('test', $node->getPrev()->getValue());

		$this->assertSame(null, $node->getValue());

		$node->setValue('first node');
		$this->assertSame('first node', $node->getValue());
		$this->assertSame('test', $node->getPrev()->getValue());
	}

	public function testCanGetAndSetKey()
	{
		$node = new LinkedListNode();

		$node->setKey(1);
		$this->assertSame(1, $node->getKey());

		$node->setKey(2);
		$this->assertSame(2, $node->getKey());
	}
}
