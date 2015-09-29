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

		// Handled by insertBeginning()
		$dll->insertBefore('test', 0); // Add node 0

		// Handled by insertBefore()
		$dll->insertBefore('testing', 0); // Add node 1
		$dll->insertBefore('testing2', 0); // Add node 2
		$dll->insertBefore('testing3', 0); // Add node 3

		try {

			// Invalid node
			$dll->insertBefore('testing4', 4);
			$this->fail();

		} catch (DataStructure\DoublyLinkedListInvalidIndexException $e) {}
	}

	public function testInsertAfter()
	{
		$dll = new DataStructure\DoublyLinkedList;

		// Handled by insertBeginning()
		$dll->insertAfter('test', 0);

		// Handled by insertAfter()
		$dll->insertAfter('testing', 0);
		$dll->insertAfter('testing2', 0);
		$dll->insertAfter('testing3', 0);

		try {

			// Invalid node
			$dll->insertAfter('testing4', 4);
			$this->fail();

		} catch (DataStructure\DoublyLinkedListInvalidIndexException $e) {}
	}

	public function testRemoveNode()
	{
		$dll = new DataStructure\DoublyLinkedList;
		$dll->insertBeginning('test');

		// Only node
		$dll->removeNode(0);

		// The node number does not reset.
		$dll->insertBeginning('test1');
		$dll->insertBeginning('test2');
		$dll->insertBeginning('test3');
		$dll->insertBeginning('test4');
		$dll->insertBeginning('test5');

		try {

			// Node counter is at 1.
			$dll->removeNode(0);
			$this->fail();

		} catch (DataStructure\DoublyLinkedListInvalidIndexException $e) {}

		// First
		$dll->removeNode(1);

		// Last
		$dll->removeNode(5);

		// Middle
		$dll->removeNode(3);

		// Verify that we actually removed stuff.
		$this->assertSame(2, $dll->count());

		$dll->insertBeginning('test6');
		$dll->insertBeginning('test7');
		$dll->insertBeginning('test8');

		/*
		 * The additions and removals from this test case make for an excellent DLL
		 * condition for the next text case.
		 */
		return $dll;
	}

	/**
	 * @depends testRemoveNode
	 */
	public function testIteration($dll)
	{
		// State of the DLL
		$state = Map{

			2	=> 'test2',
			4	=> 'test4',
			6	=> 'test6',
			7	=> 'test7',
			8	=> 'test8'

		};

		$test = Map{};

		$dll->rewind();
		while ($dll->valid()) {

			$test[$dll->key()] = $dll->current();
			$dll->next();

		}

		// Does it work forwards?
		$this->assertEquals($state, $test);

		// State of the DLL
		$state2 = Map{

			8	=> 'test8',
			7	=> 'test7',
			6	=> 'test6',
			4	=> 'test4',
			2	=> 'test2'

		};

		// Make it valid.
		$dll->moveToLast();

		$test2 = Map{};
		while ($dll->valid()) {

			$test2[$dll->key()] = $dll->current();
			$dll->prev();

		}

		// Does it work backwards?
		$this->assertEquals($state2, $test2);
	}
}
