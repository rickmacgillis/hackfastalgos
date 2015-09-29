<?HH

use HackFastAlgos\DataStructure as DataStructure;

class GraphFormatTest extends \PHPUnit_Framework_TestCase
{
	protected ?DataStructure\EdgeList $edgeList = null;
	protected ?DataStructure\AdjList $adjList = null;
	protected ?DataStructure\AdjMatrix $adjMatrix = null;

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

		$this->edgeList = new DataStructure\EdgeList();
		$this->edgeList->fromVector($edgeListVector);

		$adjListMap = Map{
			1	=> Vector{Vector{2},Vector{3}},
			2	=> Vector{Vector{3}},
			3	=> Vector{Vector{1}},
			4	=> Vector{Vector{0}}
		};

		$this->adjList = new DataStructure\AdjList();
		$this->adjList->fromMap($adjListMap);
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
		// $this->assertSame($this->adjList, $graph->toAdjList());
	}
}
