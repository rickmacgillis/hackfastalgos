<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class DoublyLinkedListTest extends PHPUnit_Framework_TestCase
{
	public function testInsertBeginning()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$dll->insertBeginning('test');
		$dll->insertBeginning('test2');
		$dll->insertBeginning('test3');
	}

	public function testCount()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$this->assertSame(0, $dll->count());

		$dll->insertBeginning('test');
		$this->assertSame(1, $dll->count());
	}

	public function testInsertEnd()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$dll->insertEnd('test');
		$dll->insertEnd('test2');
		$dll->insertEnd('test3');
	}

	public function testInsertBefore()
	{
		$dll = new DataStructure\DoublyLinkedList;

		$dll->insertBeginning('test');

		$dll->rewind();
		$firstNode = $dll->key();

		$dll->insertBefore('testing', $firstNode);

		$dll->rewind();
		$secondNode = $dll->key();
		$dll->insertBefore('testing2', $secondNode);

		$dll->rewind();
		$thirdNode = $dll->key();
		$dll->insertBefore('testing3', $thirdNode);
	}

	public function testInsertAfter()
	{
		$dll = new DataStructure\DoublyLinkedList;

		$dll->insertEnd('test');

		$dll->moveToLast();
		$lastNode = $dll->key();
		$dll->insertAfter('testing', $lastNode);

		$dll->moveToLast();
		$secondNode = $dll->key();
		$dll->insertAfter('testing2', $secondNode);

		$dll->moveToLast();
		$thirdNode = $dll->key();
		$dll->insertAfter('testing3', $thirdNode);
	}

	public function testRemoveNode()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$dll->insertBeginning('test');
		$dll->insertBeginning('test1');

		$dll->rewind();
		$firstNode = $dll->key();

		$dll->removeNode($firstNode); // Down to one entry

		$dll->rewind();
		$firstNode = $dll->key();
		$dll->removeNode($firstNode); // Empty list

		try {

			$dll->removeNode($firstNode);
			$this->fail();

		} catch (DataStructure\DoublyLinkedListIsEmptyException $e) {}

		// Verify that we actually removed stuff.
		$this->assertSame(0, $dll->count());
	}

	public function testForwardIteration()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$dll->insertBeginning('test');
		$dll->insertBeginning('test1');
		$dll->insertBeginning('test2');
		$dll->insertBeginning('test3');

		$shouldBe = ['test3', 'test2', 'test1', 'test'];
		$test = [];

		$dll->rewind();
		while ($dll->valid()) {

			$test[] = $dll->current();
			$dll->next();

		}

		$this->assertEquals($shouldBe, $test);

		$dll->moveToLast();
		$this->assertInstanceOf('\\HackFastAlgos\\DataStructure\\LinkedListNode', $dll->key());
	}

	public function testBackwardsIteration()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$dll->insertBeginning('test');
		$dll->insertBeginning('test1');
		$dll->insertBeginning('test2');
		$dll->insertBeginning('test3');

		$dll->moveToLast();

		$shouldBe = ['test', 'test1', 'test2', 'test3'];
		$test = [];
		while ($dll->valid()) {

			$test[] = $dll->current();
			$dll->prev();

		}

		$this->assertEquals($shouldBe, $test);
	}

	public function testCanCheckIfempty()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$this->assertTrue($dll->isEmpty());

		$dll->insertBeginning('test');
		$this->assertFalse($dll->isEmpty());
	}

	public function testCangetCorrectCount()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$this->assertSame(0, $dll->count());

		$dll->insertBeginning('test');
		$this->assertSame(1, $dll->count());

		$dll->insertBeginning('test1');
		$this->assertSame(2, $dll->count());

		$dll->rewind();
		$node = $dll->key();
		$dll->removeNode($node);
		$this->assertSame(1, $dll->count());

		$dll->rewind();
		$node = $dll->key();
		$dll->removeNode($node);
		$this->assertSame(0, $dll->count());
	}
}
