<?HH

use \HackFastAlgos\Interview as Interview;

class ZeroMatrixTest extends \PHPUnit_Framework_TestCase
{
	public function testCanSetRowsAndColumnsToZeroOnZeroElement()
	{
		$matrix = Vector{
			Vector{1,2,3,0,4,5},
			Vector{9,9,8,9,2,9},
			Vector{9,7,6,3,9,1},
		};

		$expected = Vector{
			Vector{0,0,0,0,0,0},
			Vector{9,9,8,0,2,9},
			Vector{9,7,6,0,9,1},
		};

		$zeroMatrix = new Interview\ZeroMatrix($matrix);
		$this->assertEquals($expected, $zeroMatrix->run());

		$matrix = Vector{
			Vector{1,2,3,0,4,5},
			Vector{9,0,8,9,2,9},
			Vector{9,7,6,3,9,1},
		};

		$expected = Vector{
			Vector{0,0,0,0,0,0},
			Vector{0,0,0,0,0,0},
			Vector{9,0,6,0,9,1},
		};

		$zeroMatrix = new Interview\ZeroMatrix($matrix);
		$this->assertEquals($expected, $zeroMatrix->run());

		$matrix = Vector{
			Vector{1,2,0,0,4,5},
			Vector{9,0,8,9,2,9},
			Vector{9,7,6,3,9,1},
		};

		$expected = Vector{
			Vector{0,0,0,0,0,0},
			Vector{0,0,0,0,0,0},
			Vector{9,0,0,0,9,1},
		};

		$zeroMatrix = new Interview\ZeroMatrix($matrix);
		$this->assertEquals($expected, $zeroMatrix->run());

		$matrix = Vector{
			Vector{1,2,0,0,4,5},
			Vector{9,0,8,9,2,9},
			Vector{9,7,6,0,9,1},
		};

		$expected = Vector{
			Vector{0,0,0,0,0,0},
			Vector{0,0,0,0,0,0},
			Vector{0,0,0,0,0,0},
		};

		$zeroMatrix = new Interview\ZeroMatrix($matrix);
		$this->assertEquals($expected, $zeroMatrix->run());

		$matrix = Vector{
			Vector{1,2,8,8,4,5},
			Vector{9,0,8,9,2,9},
			Vector{9,7,6,0,9,1},
		};

		$expected = Vector{
			Vector{1,0,8,0,4,5},
			Vector{0,0,0,0,0,0},
			Vector{0,0,0,0,0,0},
		};

		$zeroMatrix = new Interview\ZeroMatrix($matrix);
		$this->assertEquals($expected, $zeroMatrix->run());
	}

	public function testCannotUseEmptyMatrixWithZeroMatrix()
	{
		try {

			$zeroMatrix = new Interview\ZeroMatrix(Vector{});
			$this->fail();
			
		} catch (Interview\ZeroMatrixEmptyMatrixException $e){}
	}
}
