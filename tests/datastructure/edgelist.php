<?HH

use HackFastAlgos\DataStructure as DataStructure;

class EdgeListTest extends \PHPUnit_Framework_TestCase
{
	public function testCanSetToWeightedList()
	{
		$edgeList = new DataStructure\EdgeList();
		$edgeList->setWeighted();
		$this->assertTrue($edgeList->isWeighted());
	}

	public function testCanSetToNotWeightedList()
	{
		$edgeList = new DataStructure\EdgeList(DataStructure\EdgeList::WEIGHTED);
		$edgeList->setNotWeighted();
		$this->assertFalse($edgeList->isWeighted());
	}

	public function testCanAddNonWeightedEdgesToEdgeList()
	{
		$edgeList = new DataStructure\EdgeList();
		$edgeList->insertEdge(Vector{1,2});
		$edgeList->insertEdge(Vector{2,3});

		$expected = Vector{
			Vector{1,2},
			Vector{2,3}
		};

		$this->assertEquals($expected, $edgeList->toVector());
	}
	public function testCanAddWeightedEdgesToEdgeList()
	{
		$edgeList = new DataStructure\EdgeList(DataStructure\EdgeList::WEIGHTED);
		$edgeList->insertEdge(Vector{1,2,3});
		$edgeList->insertEdge(Vector{2,3,4});

		$expected = Vector{
			Vector{1,2,3},
			Vector{2,3,4}
		};

		$this->assertEquals($expected, $edgeList->toVector());
	}

	public function testEdgeDoesNotExistWhenNotInEdgeList()
	{
		$edgeList = new DataStructure\EdgeList();
		$edgeList->insertEdge(Vector{1,2});
		$this->assertFalse($edgeList->edgeExists(Vector{2,3}));
	}

	public function testEdgeExistsWhenInEdgeList()
	{
		$edgeList = new DataStructure\EdgeList();
		$edgeList->insertEdge(Vector{1,2});
		$this->assertTrue($edgeList->edgeExists(Vector{1,2}));
	}

	public function testCannotAddWeightedEdgeToNonWeightedList()
	{
		$edgeList = new DataStructure\EdgeList();

		try {
			$edgeList->insertEdge(Vector{1,2,3});
			$this->fail();
		} catch (DataStructure\EdgeListEdgeIsWeightedException $e) {}
	}

	public function testCannotAddNonWeightedEdgeToWeightedList()
	{
		$edgeList = new DataStructure\EdgeList(DataStructure\EdgeList::WEIGHTED);

		try {
			$edgeList->insertEdge(Vector{1,2});
			$this->fail();
		} catch (DataStructure\EdgeListEdgeIsNotWeightedException $e) {}
	}

	public function testIsWeightedReturnsTrueWhenWeighted()
	{
		$edgeList = new DataStructure\EdgeList(DataStructure\EdgeList::WEIGHTED);
		$this->assertTrue($edgeList->isWeighted());
	}

	public function testIsWeightedReturnsFalseWhenNotWeighted()
	{
		$edgeList = new DataStructure\EdgeList();
		$this->assertFalse($edgeList->isWeighted());
	}

	public function testCanImportEdgeListFromVector()
	{
		$edgeList = new DataStructure\EdgeList();
		$edges = Vector{
			Vector{1,2},
			Vector{1,3}
		};
		$edgeList->fromVector($edges);
		$this->assertEquals($edges, $edgeList->toVector());
	}

	public function testCannotImportListWhenListIsNotEmpty()
	{
		$edgeList = new DataStructure\EdgeList();
		$edgeList->insertEdge(Vector{1,2});

		try {

			$edges = Vector{
				Vector{1,2},
				Vector{1,3}
			};
			$edgeList->fromVector($edges);
			$this->fail();

		} catch (DataStructure\EdgeListNotEmptyException $e) {}
	}

	public function testCanSortByVertex()
	{
		$edgeList = new DataStructure\EdgeList();

		$edgeList->insertEdge(Vector{1,2});
		$edgeList->insertEdge(Vector{3,4});
		$edgeList->insertEdge(Vector{2,1});
		$edgeList->insertEdge(Vector{1,0});

		$edgeList->sortByVertex();

		$expected = Vector{
			Vector{1,2},
			Vector{1,0},
			Vector{2,1},
			Vector{3,4}
		};

		$this->assertEquals($expected, $edgeList->toVector());
	}

	public function testCanSortByWeight()
	{
		$edgeList = new DataStructure\EdgeList(DataStructure\EdgeList::WEIGHTED);

		$edgeList->insertEdge(Vector{1,2,3});
		$edgeList->insertEdge(Vector{3,4,4});
		$edgeList->insertEdge(Vector{2,1,1});
		$edgeList->insertEdge(Vector{1,0,-1});

		$edgeList->sortByWeights();

		$expected = Vector{
			Vector{1,0,-1},
			Vector{2,1,1},
			Vector{1,2,3},
			Vector{3,4,4}
		};

		$this->assertEquals($expected, $edgeList->toVector());
	}

	public function testCannotSortByWeightWhenNotWeightedList()
	{
		$edgeList = new DataStructure\EdgeList();

		try {

			$edgeList->sortByWeights();
			$this->fail();

		} catch (DataStructure\EdgeListNotWeightedListException $e) {}
	}
}
