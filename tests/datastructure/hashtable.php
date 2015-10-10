<?HH

use HackFastAlgos\DataStructure as DataStructure;

abstract class HashTableTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @before
	 */
	abstract public function createHashTable();

	public function testCanAddAndRetreiveItems()
	{
		$this->hashTable->insert('my key', 'he likes it');
		$this->assertSame('he likes it', $this->hashTable->lookup('my key'));
	}

	public function testCanChangeExistingItem()
	{
		$this->hashTable->insert('my key', 'he likes it');
		$this->hashTable->insert('my key', 'he doesn\'t like it');

		$this->assertSame('he doesn\'t like it', $this->hashTable->lookup('my key'));
	}

	public function testCanGetCorrectValueForKeyWhenCollisionOccurs()
	{
		$this->hashTable->insert('213398ac-92b6-4752-ab77-faecf37d4c9a', 'cataract oh cataract');
		$this->hashTable->insert('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 'periti - holy holy ho!');

		$this->assertSame('periti - holy holy ho!', $this->hashTable->lookup('d6172a08-a11a-4dda-d4fa-25cd1135e8e8'));
	}

	public function testWillThrowExceptionWhenKeyIsOutOfBounds()
	{
		try {
			$this->hashTable->lookup('my key');
			$this->fail();
		} catch (DataStructure\HashTableOutOfBoundsException $e) {}
	}

	public function testHashTableContainsAddedItem()
	{
		$this->hashTable->insert('my key', 'he likes it');
		$this->assertTrue($this->hashTable->contains('my key'));
	}

	public function testHashTableDoesNotContainItemNotAdded()
	{
		$this->assertFalse($this->hashTable->contains('my key'));
	}

	public function testCanDeleteItem()
	{
		$this->hashTable->insert('my key', 'he likes it');
		$this->hashTable->delete('my key');

		$this->assertFalse($this->hashTable->contains('my key'));
	}

	public function testCountDecreasesAfterDelete()
	{
		$this->assertSame(0, $this->hashTable->count());

		$this->hashTable->insert('my key', 'he likes it');
		$this->assertSame(1, $this->hashTable->count());

		$this->hashTable->delete('my key');
		$this->assertSame(0, $this->hashTable->count());
	}

	public function testCannotDeleteNonexistantItem()
	{
		$this->hashTable->insert('different key', 'he likes it');
		$this->assertSame(1, $this->hashTable->count());

		$this->hashTable->delete('my key');
		$this->assertSame(1, $this->hashTable->count());
	}

	public function testCanDeleteItemAndRetrieveAnitemAddedDuringCollisionResolution()
	{
		$this->hashTable->insert('213398ac-92b6-4752-ab77-faecf37d4c9a', 'cataract oh cataract');
		$this->hashTable->insert('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 'periti - holy holy ho!');
		$this->hashTable->delete('213398ac-92b6-4752-ab77-faecf37d4c9a');

		$this->assertTrue($this->hashTable->contains('d6172a08-a11a-4dda-d4fa-25cd1135e8e8'));
	}

	public function testCanGetNumberOfItems()
	{
		$this->assertSame(0, $this->hashTable->count());

		$this->hashTable->insert('my key', 'he likes it');
		$this->assertSame(1, $this->hashTable->count());
	}

	public function testCanIterateThroughHashTable()
	{
		$this->hashTable->insert('213398ac-92b6-4752-ab77-faecf37d4c9a', 'cataract oh cataract');
		$this->hashTable->insert('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 'periti - holy holy ho!');
		$this->hashTable->insert('my key', 'he likes it');

		$this->hashTable->rewind();
		$this->assertTrue($this->hashTable->valid());

		$this->hashTable->prev();
		$this->assertFalse($this->hashTable->valid());

		$this->hashTable->rewind();
		$this->assertTrue($this->hashTable->valid());
		$this->assertSame('213398ac-92b6-4752-ab77-faecf37d4c9a', $this->hashTable->key());
		$this->assertSame('cataract oh cataract', $this->hashTable->current());

		$this->hashTable->next();
		$this->assertSame('periti - holy holy ho!', $this->hashTable->current());

		$this->hashTable->prev();
		$this->assertSame('cataract oh cataract', $this->hashTable->current());

		$this->hashTable->next();
		$this->hashTable->next();
		$this->assertSame('he likes it', $this->hashTable->current());

		$this->hashTable->next();
		$this->assertFalse($this->hashTable->valid());
	}

	public function testCanUseHashTableAsAnArray()
	{
		$this->hashTable['my key'] = 'he likes it';
		$this->assertSame('he likes it', $this->hashTable['my key']);

		$this->assertTrue(isset($this->hashTable['my key']));

		unset($this->hashTable['my key']);
		$this->assertFalse(isset($this->hashTable['my key']));
	}
}
