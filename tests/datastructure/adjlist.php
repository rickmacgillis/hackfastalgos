<?HH

use HackFastAlgos\DataStructure as DataStructure;

class AdjListTest extends \PHPUnit_Framework_TestCase
{
	public function testCanSetToWeightedList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setWeighted();
		$this->assertTrue($adjList->isWeighted());
	}

	public function testCanSetToNotWeightedList()
	{
		$adjList = new DataStructure\AdjList(DataStructure\AdjList::WEIGHTED);
		$adjList->setNotWeighted();
		$this->assertFalse($adjList->isWeighted());
	}

	public function testCanAddNonWeightedEdgeToAdjList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();
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
		$adjList = new DataStructure\AdjList();
		$adjList->setWeighted();

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
		$adjList->setNotWeighted();
		$this->assertFalse($adjList->edgeExists(Vector{1,2}));
	}

	public function testExistsWhenInAdjList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();
		$adjList->insertEdge(Vector{1,2});
		$this->assertTrue($adjList->edgeExists(Vector{1,2}));
	}

	public function testCannotAddWeightedEdgeToNonWeightedList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();

		try {
			$adjList->insertEdge(Vector{1,2,3});
			$this->fail();
		} catch (DataStructure\AdjListEdgeIsWeightedException $e) {}
	}

	public function testCannotAddNonWeightedEdgeToWeightedList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setWeighted();

		try {
			$adjList->insertEdge(Vector{1,2});
			$this->fail();
		} catch (DataStructure\AdjListEdgeIsNotWeightedException $e) {}
	}

	public function testIsWeightedReturnsTrueWhenWeighted()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setWeighted();

		$this->assertTrue($adjList->isWeighted());
	}

	public function testIsWeightedReturnsFalseWhenNotWeighted()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();

		$this->assertFalse($adjList->isWeighted());
	}

	public function testCanImportFromMap()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();

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
		$adjList->setNotWeighted();

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

	public function testCanSortByVertex()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();

		$adjList->insertEdge(Vector{1,2});
		$adjList->insertEdge(Vector{3,4});
		$adjList->insertEdge(Vector{0,3});
		$adjList->insertEdge(Vector{-1,5});
		$adjList->insertEdge(Vector{3,6});

		$adjList->sortByVertex();

		$expected = Map{
			-1	=> Vector{Vector{5}},
			0	=> Vector{Vector{3}},
			1	=> Vector{Vector{2}},
			3	=> Vector{Vector{6},Vector{4}}
		};

		$this->assertEquals($expected, $adjList->toMap());
	}

	public function testCanSortByWeight()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setWeighted();

		$adjList->insertEdge(Vector{1,2,3});
		$adjList->insertEdge(Vector{3,4,6});
		$adjList->insertEdge(Vector{0,3,1});
		$adjList->insertEdge(Vector{-1,5,-1});
		$adjList->insertEdge(Vector{3,6,0});

		$adjList->sortByWeights();

		$expected = Map{
			-1	=> Vector{Vector{5,-1}},
			3	=> Vector{Vector{6,0},Vector{4,6}},
			0	=> Vector{Vector{3,1}},
			1	=> Vector{Vector{2,3}}
		};

		$this->assertEquals($expected, $adjList->toMap());
	}

	public function testCannotSortByWeightWhenNotWeightedList()
	{
		$adjList = new DataStructure\AdjList();
		$adjList->setNotWeighted();
		$adjList->insertEdge(Vector{1,2});

		try {
			$adjList->sortByWeights();
			$this->fail();
		} catch (DataStructure\AdjListNotWeightedListException $e) {}
	}
}
