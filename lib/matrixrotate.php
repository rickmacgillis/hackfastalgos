<?HH
/**
 * Hack Fast Algos
 *
 * Algorithms to efficiently rotate a matrix
 * Learn more
 * @link http://stackoverflow.com/questions/3488691/how-to-rotate-a-matrix-90-degrees-without-using-any-extra-space
 * @link https://en.wikipedia.org/wiki/XOR_swap_algorithm
 */

namespace HackFastAlgos;

class MatrixRotateNotASquareMatrixException extends \Exception{}

type RotatableMatrix = Vector<Vector<int>>;
type Coords = Vector<int>;

class MatrixRotate
{
	public function __construct(private RotatableMatrix $matrix) {
		$this->throwIfNotSquareMatrix();
	}

	public function rotate90() : RotatableMatrix
	{
		return $this->rotate([$this, 'rotateCoordinatesClockwise']);
	}

	public function rotateNeg90() : RotatableMatrix
	{
		return $this->rotate([$this, 'rotateCoordinatesCounterClockwise']);
	}

	public function rotate180() : RotatableMatrix
	{
		return $this->rotate(function (int $x, int $y, int $size) {

			$this->rotateCoordinatesClockwise($x, $y, $size);
			$this->rotateCoordinatesClockwise($x, $y, $size);

		});
	}

	public function flipHorizontally() : RotatableMatrix
	{
		return $this->rotate(function (int $x, int $y, int $size) {

			$xCompliment = $size - $x;
			$yCompliment = $size - $y;

			$this->swap(Vector{$x, $y}, Vector{$xCompliment, $y});

			if ($y !== $yCompliment && $x !== $xCompliment) {
				$this->swap(Vector{$x, $yCompliment}, Vector{$xCompliment, $yCompliment});
			}

		});
	}

	public function flipVertically() : RotatableMatrix
	{
		return $this->rotate(function (int $x, int $y, int $size) {

			$xCompliment = $size - $x;
			$yCompliment = $size - $y;

			$this->swap(Vector{$y, $x}, Vector{$y, $xCompliment});

			if ($y !== $yCompliment && $x !== $xCompliment) {
				$this->swap(Vector{$yCompliment, $x}, Vector{$yCompliment, $xCompliment});
			}

		});
	}

	private function throwIfNotSquareMatrix()
	{
		// This method does not check the length of each element so as to avoid Theta(n) running time.
		if ($this->matrix->containsKey(0) === false || $this->matrix->count() !== $this->matrix[0]->count()) {
			throw new MatrixRotateNotASquareMatrixException();
		}
	}

	private function rotate((function(int, int, int) : void) $callback) : RotatableMatrix
	{
		$size = $this->matrix->count()-1;
		$floor = (int) floor(($size+1)/2);
		$ceil = (int) ceil(($size+1)/2);
		for ($x = 0; $x < $floor; $x++) {
			for ($y = 0; $y < $ceil; $y++) {
				$callback($x, $y, $size);
			}
		}

		return $this->matrix;
	}

	private function rotateCoordinatesClockwise(int $x, int $y, int $matrixSize)
	{
		$xCompliment = $matrixSize - $x;
		$yCompliment = $matrixSize - $y;

		$this->swap(Vector{$xCompliment, $yCompliment}, Vector{$y, $xCompliment});
		$this->swap(Vector{$yCompliment, $x}, Vector{$xCompliment, $yCompliment});
		$this->swap(Vector{$x, $y}, Vector{$yCompliment, $x});
	}

	private function rotateCoordinatesCounterClockwise(int $x, int $y, int $matrixSize)
	{
		$xCompliment = $matrixSize - $x;
		$yCompliment = $matrixSize - $y;

		$this->swap(Vector{$x, $y}, Vector{$yCompliment, $x});
		$this->swap(Vector{$yCompliment, $x}, Vector{$xCompliment, $yCompliment});
		$this->swap(Vector{$xCompliment, $yCompliment}, Vector{$y, $xCompliment});
	}

	private function swap(Coords $first, Coords $second)
	{
		$this->matrix[$first[1]][$first[0]] ^= $this->matrix[$second[1]][$second[0]];
		$this->matrix[$second[1]][$second[0]] ^= $this->matrix[$first[1]][$first[0]];
		$this->matrix[$first[1]][$first[0]] ^= $this->matrix[$second[1]][$second[0]];
	}
}
