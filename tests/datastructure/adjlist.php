<?HH

use HackFastAlgos\DataStructure as DataStructure;

class AdjListTest extends \PHPUnit_Framework_TestCase
{
	public function testCanAddNonWeightedEdgeToAdjList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->insertEdge(Vector{1,2});
		$adjList->insertEdge(Vector{3,4});

		$expected = Map{
			1	=> Vector{Vector{2}},
			3	=> Vector{Vector{4}},
		};

		$this->assertEquals($expected, $adjList->toMap());
	}

	public function testCanAddWeightedEdgeToAdjList()
	{
		$adjList = new DataStructure\AdjList(DataStructure\AdjList::WEIGHTED);
		$adjList->insertEdge(Vector{1,2,3});
		$adjList->insertEdge(Vector{3,4,5});

		$expected = Map{
			1	=> Vector{Vector{2,3}},
			3	=> Vector{Vector{4,5}},
		};

		$this->assertEquals($expected, $adjList->toMap());
	}

	public function testDoesNotExistWhenNotInAdjList()
	{
		$adjList = new DataStructure\AdjList();
		$this->assertFalse($adjList->edgeExists(Vector{1,2}));
	}

	public function testExistsWhenInAdjList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->insertEdge(Vector{1,2});
		$this->assertTrue($adjList->edgeExists(Vector{1,2}));
	}

	public function testCannotAddWeightedEdgeToNonWeightedList()
	{
		$adjList = new DataStructure\AdjList();

		try {
			$adjList->insertEdge(Vector{1,2,3});
			$this->fail();
		} catch (DataStructure\AdjListEdgeIsWeightedException $e) {}
	}

	public function testCannotAddNonWeightedEdgeToWeightedList()
	{
		$adjList = new DataStructure\AdjList(DataStructure\AdjList::WEIGHTED);

		try {
			$adjList->insertEdge(Vector{1,2});
			$this->fail();
		} catch (DataStructure\AdjListEdgeIsNotWeightedException $e) {}
	}

	public function testIsWeightedReturnsTrueWhenWeighted()
	{
		$adjList = new DataStructure\AdjList(DataStructure\AdjList::WEIGHTED);
		$this->assertTrue($adjList->isWeighted());
	}

	public function testIsWeightedReturnsFalseWhenNotWeighted()
	{
		$adjList = new DataStructure\AdjList();
		$this->assertFalse($adjList->isWeighted());
	}

	public function testCanImportFromMap()
	{
		$adjList = new DataStructure\AdjList();
		$map = Map{
			1	=> Vector{Vector{2,3}},
			3	=> Vector{Vector{4,5}},
		};
		$adjList->fromMap($map);
		$this->assertEquals($map, $adjList->toMap());
	}

	public function testCannotImportFromMapWhenListNotempty()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->insertEdge(Vector{1,2});

		try {

			$map = Map{
				1	=> Vector{Vector{2,3}},
				3	=> Vector{Vector{4,5}},
			};
			$adjList->fromMap($map);
			$this->fail();

		} catch (DataStructure\AdjListNotEmptyException $e) {}
	}
}
