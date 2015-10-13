<?HH

use HackFastAlgos\DataStructure as DataStructure;

class SetTest extends \PHPUnit_Framework_TestCase
{
	public function testCanAddItemToSet()
	{
		$set = new DataStructure\Set(1);
		$set->insert('entry');

		$this->assertTrue($set->contains('entry'));
	}

	public function testCanRemoveItem()
	{
		$set = new DataStructure\Set(1);
		$set->insert('entry');
		$set->delete('entry');

		$this->assertFalse($set->contains('entry'));
	}

	public function testCanCountItemsInSet()
	{
		$set = new DataStructure\Set(1);
		$this->assertSame(0, $set->count());

		$set->insert('entry');
		$this->assertSame(1, $set->count());

		$set->delete('entry');
		$this->assertSame(0, $set->count());
	}

	public function testCanIterateThroughSet()
	{
		$set = new DataStructure\Set(3);
		$set->insert('entry1');
		$set->insert('entry2');
		$set->insert('entry3');

		$set->rewind();
		$this->assertTrue($set->valid());

		$set->prev();
		$this->assertFalse($set->valid());

		$set->rewind();
		$this->assertTrue($set->valid());
		$this->assertSame('entry1', $set->key());
		$this->assertSame('entry1', $set->current());

		$set->next();
		$this->assertSame('entry2', $set->key());
		$this->assertSame('entry2', $set->current());

		$set->next();
		$this->assertTrue($set->valid());
		$this->assertSame('entry3', $set->key());
		$this->assertSame('entry3', $set->current());

		/**
		 * @TODO Using Set with hashTableChain results in this entry being wrong sometimes.
		 * - Currently testing with HashTableOA to see if the issue persists before troubleshooting further
		 */
		$set->prev();
		$this->assertSame('entry2', $set->key());
		$this->assertSame('entry2', $set->current());

		$set->next();
		$set->next();
		$this->assertFalse($set->valid());
	}
}
