<?HH

use HackFastAlgos\DataStructure as DataStructure;

class HashTableOATest extends \PHPUnit_Framework_TestCase
{
	public function testCanAddAndRetreiveItems()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('my key', 'he likes it');

		$this->assertSame('he likes it', $hashTable->lookup('my key'));
	}

	public function testCanChangeExistingItem()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('my key', 'he likes it');
		$hashTable->insert('my key', 'he doesn\'t like it');

		$this->assertSame('he doesn\'t like it', $hashTable->lookup('my key'));
	}

	public function testCanGetCorrectValueForKeyWhenCollisionOccurs()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('213398ac-92b6-4752-ab77-faecf37d4c9a', 'cataract oh cataract');
		$hashTable->insert('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 'periti - holy holy ho!');

		$this->assertSame('periti - holy holy ho!', $hashTable->lookup('d6172a08-a11a-4dda-d4fa-25cd1135e8e8'));
	}

	public function testWillThrowExceptionWhenKeyIsOutOfBounds()
	{
		$hashTable = new DataStructure\HashTableOA();

		try {
			$hashTable->lookup('my key');
			$this->fail();
		} catch (DataStructure\HashTableOAOutOfBoundsException $e) {}
	}

	public function testHashTableContainsAddedItem()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('my key', 'he likes it');

		$this->assertTrue($hashTable->contains('my key'));
	}

	public function testHashTableDoesNotContainItemNotAdded()
	{
		$hashTable = new DataStructure\HashTableOA();

		$this->assertFalse($hashTable->contains('my key'));
	}

	public function testCanDeleteItem()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('my key', 'he likes it');
		$hashTable->delete('my key');

		$this->assertFalse($hashTable->contains('my key'));
	}

	public function testCanDeleteItemAndRetrieveAnitemAddedDuringCollisionResolution()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('213398ac-92b6-4752-ab77-faecf37d4c9a', 'cataract oh cataract');
		$hashTable->insert('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 'periti - holy holy ho!');
		$hashTable->delete('213398ac-92b6-4752-ab77-faecf37d4c9a');

		$this->assertTrue($hashTable->contains('d6172a08-a11a-4dda-d4fa-25cd1135e8e8'));
	}

	public function testCanGetNumberOfItems()
	{
		$hashTable = new DataStructure\HashTableOA();

		$this->assertSame(0, $hashTable->count());

		$hashTable->insert('my key', 'he likes it');
		$this->assertSame(1, $hashTable->count());
	}

	public function testCanIterateThroughHashTable()
	{
		$hashTable = new DataStructure\HashTableOA();
		$hashTable->insert('213398ac-92b6-4752-ab77-faecf37d4c9a', 'cataract oh cataract');
		$hashTable->insert('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 'periti - holy holy ho!');
		$hashTable->insert('my key', 'he likes it');

		$hashTable->rewind();
		$this->assertTrue($hashTable->valid());

		$hashTable->prev();
		$this->assertFalse($hashTable->valid());

		$hashTable->rewind();
		$this->assertTrue($hashTable->valid());
		$this->assertSame('213398ac-92b6-4752-ab77-faecf37d4c9a', $hashTable->key());
		$this->assertSame('cataract oh cataract', $hashTable->current());

		$hashTable->next();
		$this->assertSame('periti - holy holy ho!', $hashTable->current());

		$hashTable->next();
		$hashTable->next();
		$this->assertFalse($hashTable->valid());
	}

	public function testCanUseHashTableAsAnArray()
	{
		$hashTable = new DataStructure\HashTableOA();

		$hashTable['my key'] = 'he likes it';
		$this->assertSame('he likes it', $hashTable['my key']);

		$this->assertTrue(isset($hashTable['my key']));

		unset($hashTable['my key']);
		$this->assertFalse(isset($hashTable['my key']));
	}
}
