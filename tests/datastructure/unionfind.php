<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class UnionFindTest extends \PHPUnit_Framework_TestCase
{
	public function testMakeSet()
	{
		$uf = new DataStructure\UnionFind;
		$uf->makeSet(1);
	}

	public function testFind()
	{
		$uf = new DataStructure\UnionFind;
		$uf->makeSet(1);

		// The new item should be it's own mom. *Scratches head*
		$this->assertSame(1, $uf->find(1));

		// If something doesn't exist, it needs to throw an exception.
		try {

			$uf->find(2);
			$this->fail();

		} catch (DataStructure\UnionFindItemDoesNotExistException $e) {}
	}

	public function testUnion()
	{
		$uf = new DataStructure\UnionFind;
		$uf->makeSet(1);
		$uf->makeSet(2);

		// Combine the two sets. They're of equal height, so the first item in the set gets the increment.
		$uf->union(1,2);
		$this->assertSame(1, $uf->find(2));

		// Check if 3 becomes a child of 1.
		$uf->makeSet(3);
		$uf->union(2, 3);
		$this->assertSame(1, $uf->find(3));

		// Make sure that order does not matter with the union() parameters.
		$uf->makeSet(4);
		$uf->union(4, 1);
		$this->assertSame(1, $uf->find(4));
	}

	public function testIsConnected()
	{
		$uf = new DataStructure\UnionFind;
		$uf->makeSet(1);
		$uf->makeSet(2);

		$this->assertSame(false, $uf->isConnected(1, 2));
		$this->assertSame(false, $uf->isConnected(1, 3));

		$uf->union(1, 2);
		$this->assertSame(true, $uf->isConnected(1, 2));
	}

	public function testCountSets()
	{
		$uf = new DataStructure\UnionFind;

		$this->assertSame(0, $uf->countSets());

		$uf->makeSet(1);
		$uf->makeSet(2);

		$this->assertSame(2, $uf->countSets());

		$uf->union(1, 2);

		$this->assertSame(1, $uf->countSets());
	}
}
