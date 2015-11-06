<?HH

class MatrixRotateTest extends \PHPUnit_Framework_TestCase
{
	private Vector<Vector<int>> $matrix = Vector{};

	/**
	 * @before
	 */
	public function setUp()
	{
		$this->oddMatrix = Vector{
			Vector{1,2,3},
			Vector{4,5,6},
			Vector{7,8,9}
		};

		$this->evenMatrix = Vector{
			Vector{1,2,3,4},
			Vector{5,6,7,8},
			Vector{9,10,11,12},
			Vector{13,14,15,16}
		};
	}

	public function testWillThrowExceptionIfNotASquareMatrix()
	{
		$matrix = Vector{
			Vector{1,2,3},
			Vector{4,5,6}
		};

		try {
			$matrixRotate = new \HackFastAlgos\MatrixRotate($matrix);
			$this->fail();
		} catch (\HackFastAlgos\MatrixRotateNotASquareMatrixException $e) {}
	}

	public function testCanRotateOddMatrix90()
	{
		$rotated90 = Vector{
			Vector{7,4,1},
			Vector{8,5,2},
			Vector{9,6,3}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->oddMatrix);
		$this->assertEquals($rotated90, $matrixRotate->rotate90());
	}

	public function testCanRotateEvenMatrix90()
	{
		$rotated90 = Vector{
			Vector{13,9,5,1},
			Vector{14,10,6,2},
			Vector{15,11,7,3},
			Vector{16,12,8,4}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->evenMatrix);
		$this->assertEquals($rotated90, $matrixRotate->rotate90());
	}

	public function testCanRotateOddMatrixNeg90Degrees()
	{
		$rotatedNeg90 = Vector{
			Vector{3,6,9},
			Vector{2,5,8},
			Vector{1,4,7}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->oddMatrix);
		$this->assertEquals($rotatedNeg90, $matrixRotate->rotateNeg90());
	}

	public function testCanRotateEvenMatrixNeg90Degrees()
	{
		$rotatedNeg90 = Vector{
			Vector{4,8,12,16},
			Vector{3,7,11,15},
			Vector{2,6,10,14},
			Vector{1,5,9,13}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->evenMatrix);
		$this->assertEquals($rotatedNeg90, $matrixRotate->rotateNeg90());
	}

	public function testCanRotateOddMatrix180()
	{
		$rotated180 = Vector{
			Vector{9,8,7},
			Vector{6,5,4},
			Vector{3,2,1}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->oddMatrix);
		$this->assertEquals($rotated180, $matrixRotate->rotate180());
	}

	public function testCanRotateEvenMatrix180()
	{
		$rotated180 = Vector{
			Vector{16,15,14,13},
			Vector{12,11,10,9},
			Vector{8,7,6,5},
			Vector{4,3,2,1}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->evenMatrix);
		$this->assertEquals($rotated180, $matrixRotate->rotate180());
	}

	public function testCanFlipOddMatrixVertically()
	{
		$flippedVert = Vector{
			Vector{7,8,9},
			Vector{4,5,6},
			Vector{1,2,3}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->oddMatrix);
		$this->assertEquals($flippedVert, $matrixRotate->flipVertically());
	}

	public function testCanFlipEvenMatrixVertically()
	{
		$flippedVert = Vector{
			Vector{13,14,15,16},
			Vector{9,10,11,12},
			Vector{5,6,7,8},
			Vector{1,2,3,4}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->evenMatrix);
		$this->assertEquals($flippedVert, $matrixRotate->flipVertically());
	}

	public function testCanFlipOddMatrixHorizontally()
	{
		$flippedHoriz = Vector{
			Vector{3,2,1},
			Vector{6,5,4},
			Vector{9,8,7}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->oddMatrix);
		$this->assertEquals($flippedHoriz, $matrixRotate->flipHorizontally());
	}

	public function testCanFlipEvenMatrixHorizontally()
	{
		$flippedHoriz = Vector{
			Vector{4,3,2,1},
			Vector{8,7,6,5},
			Vector{12,11,10,9},
			Vector{16,15,14,13}
		};

		$matrixRotate = new \HackFastAlgos\MatrixRotate($this->evenMatrix);
		$this->assertEquals($flippedHoriz, $matrixRotate->flipHorizontally());
	}
}
