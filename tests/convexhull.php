<?HH

class ConvexHullTest extends \PHPUnit_Framework_TestCase
{
	public function testCanCalculateConvexHull()
	{
		$cartesianPointsVector = Vector{
			Vector{1,2},
			Vector{4,5},
			Vector{2,3},
			Vector{8,40},
			Vector{44,2},
			Vector{33,33},
			Vector{-20,-30}
		};

		$convexHull = Vector{
			Vector{-20,-30},
			Vector{44,2},
			Vector{33,33},
			Vector{8,40},
			Vector{1,2}
		};

		$ch = new \HackFastAlgos\ConvexHull($cartesianPointsVector);
		$response = $ch->grahamScan();
		var_dump($response);
		$this->assertEquals($convexHull, $response);
	}
}
