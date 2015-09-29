<?HH

use HackFastAlgos\DataStructure as DataStructure;

class GraphFormatTest extends \PHPUnit_Framework_TestCase
{
	protected ?DataStructure\EdgeList $edgeList = null;
	protected ?DataStructure\AdjList $adjList = null;
	protected ?DataStructure\AdjMatrix $adjMatrix = null;

	protected ?DataStructure\EdgeList $edgeListWeighted = null;
	protected ?DataStructure\AdjList $adjListWeighted = null;
	protected ?DataStructure\AdjMatrix $adjMatrixWeighted = null;

	/**
	 * @before
	 */
	public function defineTypes()
	{
		$edgeListVector = Vector{
			Vector{1,2},
			Vector{1,3},
			Vector{2,3},
			Vector{3,1},
			Vector{4,0}
		};

		$edgeListVectorWeighted = Vector{
			Vector{1,2,1},
			Vector{1,3,3},
			Vector{2,3,0},
			Vector{3,1,6},
			Vector{4,0,-1}
		};

		$this->edgeList = new DataStructure\EdgeList();
		$this->edgeList->fromVector($edgeListVector);

		$this->edgeListWeighted = new DataStructure\EdgeList(DataStructure\EdgeList::WEIGHTED);
		$this->edgeListWeighted->fromVector($edgeListVectorWeighted);

		$adjListMap = Map{
			1	=> Vector{Vector{2},Vector{3}},
			2	=> Vector{Vector{3}},
			3	=> Vector{Vector{1}},
			4	=> Vector{Vector{0}}
		};

		$adjListMapWeighted = Map{
			1	=> Vector{Vector{2,1},Vector{3,3}},
			2	=> Vector{Vector{3,0}},
			3	=> Vector{Vector{1,6}},
			4	=> Vector{Vector{0,-1}}
		};

		$this->adjList = new DataStructure\AdjList();
		$this->adjList->fromMap($adjListMap);

		$this->adjListWeighted = new DataStructure\AdjList(DataStructure\AdjList::WEIGHTED);
		$this->adjListWeighted->fromMap($adjListMapWeighted);

		$adjMatrixVector = Vector{
			Vector{0,0,0,0,0},
			Vector{0,0,1,1,0},
			Vector{0,0,0,1,0},
			Vector{0,1,0,0,0},
			Vector{1,0,0,0,0}
		};

		$adjMatrixVectorWeighted = Vector{
			Vector{null,null,null,null,null},
			Vector{null,null,1,   3,   null},
			Vector{null,null,null,0,   null},
			Vector{null,6,   null,null,null},
			Vector{-1,  null,null,null,null}
		};

		$this->adjMatrix = new DataStructure\AdjMatrix();
		$this->adjMatrix->fromVector($adjMatrixVector);

		$this->adjMatrixWeighted = new DataStructure\AdjMatrix(DataStructure\AdjMatrix::WEIGHTED);
		$this->adjMatrixWeighted->fromVector($adjMatrixVectorWeighted);
	}

	public function testWillThrowAnExceptionWhenConvertingWithoutData()
	{
		$graph = new \HackFastAlgos\GraphFormat();

		try {
			$graph->toEdgeList();
			$this->fail();
		} catch (\HackFastAlgos\GraphFormatFromTypeNotSetException $e){}
	}

	public function testWillThrowExceptionWhenSettingMultipleFromTypes()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjList($this->adjList);

		try {
			$graph->fromEdgeList($this->edgeList);
			$this->fail();
		} catch (\HackFastAlgos\GraphFormatFromTypeAlreadySetException $e){}
	}

	public function testCanConvertEdgeListToAdjListWithoutWeights()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromEdgeList($this->edgeList);
		$this->assertEquals($this->adjList, $graph->toAdjList());
	}

	public function testCanConvertWeightedEdgeListToAdjList()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromEdgeList($this->edgeListWeighted);
		$this->assertEquals($this->adjListWeighted, $graph->toAdjList());
	}

	public function testCanConvertEdgeListToAdjMatrixWithoutWeights()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromEdgeList($this->edgeList);
		$this->assertEquals($this->adjMatrix, $graph->toAdjMatrix());
	}

	public function testCanConvertWeightedEdgeListToAdjMatrix()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromEdgeList($this->edgeListWeighted);
		$this->assertEquals($this->adjMatrixWeighted, $graph->toAdjMatrix());
	}

	public function testCanConvertAdjListToEdgeListWithoutWeights()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjList($this->adjList);
		$this->assertEquals($this->edgeList, $graph->toEdgeList());
	}

	public function testCanConvertWeightedAdjListToEdgeList()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjList($this->adjListWeighted);
		$this->assertEquals($this->edgeListWeighted, $graph->toEdgeList());
	}

	public function testCanConvertAdjListToAdjMatrixWithoutWeights()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjList($this->adjList);
		$this->assertEquals($this->adjMatrix, $graph->toAdjMatrix());
	}

	public function testCanConvertWeightedAdjListToAdjMatrix()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjList($this->adjListWeighted);
		$this->assertEquals($this->adjMatrixWeighted, $graph->toAdjMatrix());
	}

	public function testCanConvertAdjMatrixToEdgeListWithoutWeights()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjMatrix($this->adjMatrix);
		$this->assertEquals($this->edgeList, $graph->toEdgeList());
	}

	public function testCanConvertWeightedAdjMatrixToEdgeList()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjMatrix($this->adjMatrixWeighted);
		$this->assertEquals($this->edgeListWeighted, $graph->toEdgeList());
	}

	public function testCanConvertAdjMatrixToAdjListWithoutWeights()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjMatrix($this->adjMatrix);
		$this->assertEquals($this->adjList, $graph->toAdjList());
	}

	public function testCanConvertWeightedAdjMatrixToAdjList()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjMatrix($this->adjMatrixWeighted);
		$this->assertEquals($this->adjListWeighted, $graph->toAdjList());
	}
}
