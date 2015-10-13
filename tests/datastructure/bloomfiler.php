<?HH

use HackFastAlgos\DataStructure as DataStructure;

class BloomFilterTest extends \PHPUnit_Framework_TestCase
{
	public function testCanAddItemToBloomFilter()
	{
		$bloom = new DataStructure\BloomFilter(1000);

		$vector = Vector{1, 'a', 7, 3};
		$bloom->insert($vector);

		$this->assertTrue($bloom->exists($vector));
	}

	public function testItemDoesNotExistWhenNotAdded()
	{
		$bloom = new DataStructure\BloomFilter(10);

		$notInBloom = Vector{2, 'a', 7, 3};
		$this->assertFalse($bloom->exists($notInBloom));
	}

	public function testCanGetFalsePositive()
	{
		$bloom = new DataStructure\BloomFilter(10);

		$vector = Vector{'213398ac-92b6-4752-ab77-faecf37d4c9a'};
		$bloom->insert($vector);

		$notInBloom = Vector{'d6172a08-a11a-4dda-d4fa-25cd1135e8e8'};
		$this->assertTrue($bloom->exists($notInBloom));
	}

	public function testCanRemoveItem()
	{
		$bloom = new DataStructure\BloomFilter(1000);

		$vector = Vector{1, 'a', 7, 3};
		$bloom->insert($vector);
		$bloom->delete($vector);

		$this->assertFalse($bloom->exists($vector));
	}

	public function testCanRemoveNonExistantItem()
	{
		$bloom = new DataStructure\BloomFilter(1000);

		$vector = Vector{1, 'a', 7, 3};
		$bloom->delete($vector);

		$this->assertFalse($bloom->exists($vector));
	}

	public function testCanGetFalseNegative()
	{
		$bloom = new DataStructure\BloomFilter(1000);

		$vector1 = Vector{'213398ac-92b6-4752-ab77-faecf37d4c9a'};
		$vector2 = Vector{'d6172a08-a11a-4dda-d4fa-25cd1135e8e8'};
		$bloom->insert($vector1);
		$bloom->insert($vector2);

		$bloom->delete($vector1);

		$this->assertFalse($bloom->exists($vector2));
	}
}
