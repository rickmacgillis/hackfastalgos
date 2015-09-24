<?HH

class GraphFormatTest extends \PHPUnit_Framework_TestCase
{
	public function testWillThrowAnExceptionWhenConvertingWithoutData()
	{
		$graph = new \HackFastAlgos\GraphFormat();

		try {
			$graph->toEdgeList();
			$this->fail();
		} catch (\HackFastAlgos\GraphFormatFromTypeNotSetException $e){}
	}

	public function testWillThrowExceptionWhenSettingTwoFromTypes()
	{
		$graph = new \HackFastAlgos\GraphFormat();
		$graph->fromAdjList(Vector{Vector{1},Vector{2}});

		try {
			$graph->fromEdgeList(Vector{Vector{1,1},Vector{1,2}});
			$this->fail();
		} catch (\HackFastAlgos\GraphFormatFromTypeAlreadySetException $e){}
	}
}
