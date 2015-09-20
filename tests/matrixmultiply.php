<?HH

class MatrixMultiplyTest extends \PHPUnit_Framework_TestCase
{
	public function testCanMultiplyTwoMatrixes()
	{
		$matrix1 = Vector{Vector{1, 2}, Vector{3, 4}};
		$matrix2 = Vector{Vector{1, 2}, Vector{3, 4}};

		/*
		[1,2] * [1,2]
		[3,4]   [3,4]

		Result:
		[7,10]
		[15,22]
		*/

		$expectedOutput = Vector{Vector{7, 10}, Vector{15, 22}};

		$mm = new \HackFastAlgos\MatrixMultiply($matrix1, $matrix2);
		$this->assertEquals($expectedOutput, $mm->multiply());
	}
}
