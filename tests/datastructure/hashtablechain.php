<?HH

use HackFastAlgos\DataStructure as DataStructure;

class HashTableChainTest extends \HashTableTest
{
	protected ?HashTableChain $hashTable = null;

	/**
	 * @before
	 */
	public function createHashTable()
	{
		$this->hashTable = new DataStructure\HashTableChain(10, 1);
	}
}
