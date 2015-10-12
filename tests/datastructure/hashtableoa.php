<?HH

use HackFastAlgos\DataStructure as DataStructure;

class HashTableOATest extends \HashTableTest
{
	protected ?HashTableOA $hashTable = null;

	/**
	 * @before
	 */
	public function createHashTable()
	{
		$this->hashTable = new DataStructure\HashTableOA(10, 1);
	}
}
