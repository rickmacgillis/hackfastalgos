<?HH

class ConvexHullTest extends \PHPUnit_Framework_TestCase
{
	public function testCanCalculateConvexHull()
	{
		// Coords from: http://artax.karlin.mff.cuni.cz/~isa_j1am/presentations/repeated_games/convex_hull.png
		$cartesianPointsVector = Vector{
			Vector{0,3},
			Vector{2,1},
			Vector{3,0},
			Vector{2,-3},
			Vector{-1,-3},
			Vector{-2,-3},
			Vector{-1,-2},
			Vector{-2,-1},
			Vector{-2,1}
		};

		$convexHull = Vector{
			Vector{2,-3},
			Vector{3,0},
			Vector{2,1},
			Vector{0,3},
			Vector{-2,1},
			Vector{-2,-1},
			Vector{-2,-3},
			Vector{-1,-3}
		};

		$ch = new \HackFastAlgos\ConvexHull($cartesianPointsVector);
		$response = $ch->grahamScan();
		
		$this->assertEquals($convexHull, $response);
	}
}
