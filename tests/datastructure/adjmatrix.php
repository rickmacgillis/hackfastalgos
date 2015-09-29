<?HH

use HackFastAlgos\DataStructure as DataStructure;

class AdjMatrixTest extends \PHPUnit_Framework_TestCase
{
	public function testCanSetInitialMatrixSizeForNonWeightedMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$adjMatrix->resizeMatrixTo(4);

		$expected = Vector{
			Vector{0,0,0,0,0},
			Vector{0,0,0,0,0},
			Vector{0,0,0,0,0},
			Vector{0,0,0,0,0},
			Vector{0,0,0,0,0}
		};

		$this->assertEquals($expected, $adjMatrix->toVector());
	}

	public function testCanSetInitialMatrixSizeForWeightedMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);
		$adjMatrix->resizeMatrixTo(4);

		$expected = Vector{
			Vector{null,null,null,null,null},
			Vector{null,null,null,null,null},
			Vector{null,null,null,null,null},
			Vector{null,null,null,null,null},
			Vector{null,null,null,null,null}
		};

		$this->assertEquals($expected, $adjMatrix->toVector());
	}

	public function testCanAddNonWeightedEdgeToAdjMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$adjMatrix->insertEdge(Vector{1,2});
		$adjMatrix->insertEdge(Vector{3,4});

		$expected = Vector{
			Vector{0,0,0,0,0},
			Vector{0,0,1,0,0},
			Vector{0,0,0,0,0},
			Vector{0,0,0,0,1},
			Vector{0,0,0,0,0}
		};

		$this->assertEquals($expected, $adjMatrix->toVector());
	}

	public function testCanAddWeightedEdgeToAdjMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);
		$adjMatrix->insertEdge(Vector{1,2,4});
		$adjMatrix->insertEdge(Vector{3,4,2});

		$expected = Vector{
			Vector{null,null,null,null,null},
			Vector{null,null,4,null,null},
			Vector{null,null,null,null,null},
			Vector{null,null,null,null,2},
			Vector{null,null,null,null,null}
		};

		$this->assertEquals($expected, $adjMatrix->toVector());
	}

	public function testCanGetMatrixSize()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$adjMatrix->insertEdge(Vector{1,2});
		$adjMatrix->insertEdge(Vector{3,4});

		$this->assertSame(5, $adjMatrix->getMatrixSize());
	}

	public function testDoesNotExistWhenNotInAdjMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$this->assertFalse($adjMatrix->edgeExists(Vector{1,2}));
	}

	public function testExistsWhenInAdjMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$adjMatrix->insertEdge(Vector{1,2});
		$this->assertTrue($adjMatrix->edgeExists(Vector{1,2}));
	}

	public function testCannotAddWeightedEdgeToNonWeightedMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix();

		try {
			$adjMatrix->insertEdge(Vector{1,2,3});
			$this->fail();
		} catch (DataStructure\AdjMatrixEdgeIsWeightedException $e) {}
	}

	public function testCannotAddNonWeightedEdgeToWeightedMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);

		try {
			$adjMatrix->insertEdge(Vector{1,2});
			$this->fail();
		} catch (DataStructure\AdjMatrixEdgeIsNotWeightedException $e) {}
	}

	public function testIsWeightedReturnsTrueWhenWeighted()
	{
		$adjMatrix = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);
		$this->assertTrue($adjMatrix->isWeighted());
	}

	public function testIsWeightedReturnsFalseWhenNotWeighted()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$this->assertFalse($adjMatrix->isWeighted());
	}

	public function testCanImportFromVector()
	{
		$adjMatrix = new DataStructure\AdjMatrix();

		$adjMatrixVector = Vector{
			Vector{0,0,0,0,0},
			Vector{0,0,1,0,0},
			Vector{0,0,0,0,0},
			Vector{0,0,0,0,1},
			Vector{0,0,0,0,0}
		};

		$adjMatrix->fromVector($adjMatrixVector);
		$this->assertSame($adjMatrixVector, $adjMatrix->toVector());
	}

	public function testCannotImportFromVectorWhenNotEmpty()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$adjMatrix->insertEdge(Vector{1,2});

		try {

			$adjMatrixVector = Vector{
				Vector{0,0,0,0,0},
				Vector{0,0,1,0,0},
				Vector{0,0,0,0,0},
				Vector{0,0,0,0,1},
				Vector{0,0,0,0,0}
			};

			$adjMatrix->fromVector($adjMatrixVector);
			$this->fail();

		} catch (DataStructure\AdjMatrixNotEmptyException $e) {}
	}

	public function testCanGetEdgeWeight()
	{
		$adjMatrix = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);
		$adjMatrix->insertEdge(Vector{1,2,3});
		$adjMatrix->insertEdge(Vector{1,3,4});

		$this->assertSame(3, $adjMatrix->getEdgeWeight(Vector{1,2}));
	}

	public function testCanGetNoEdgeValueForNonWeightedMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix();
		$this->assertSame(0, $adjMatrix->getNoEdgeValue());
	}

	public function testCanGetNoEdgeValueForWeightedMatrix()
	{
		$adjMatrix = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);
		$this->assertSame(null, $adjMatrix->getNoEdgeValue());
	}
}
