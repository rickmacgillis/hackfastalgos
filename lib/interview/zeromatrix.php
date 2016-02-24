<?HH
/**
 * Hack Fast Algos
 *
 * Puzzle: Write an algorithm into existence that will check an MxN matrix to find an element who's value is zero.
 * Every time a zero entry is discovered, make its row and column all zeros.
 */

namespace HackFastAlgos\Interview;

type Matrix = Vector<Vector<int>>;

class ZeroMatrixEmptyMatrixException extends \Exception{}

class ZeroMatrix
{
	private Map<int, bool> $zeroRows = Map{};
	private Map<int, bool> $zeroCols = Map{};

	public function __construct(private Matrix $matrix)
	{
		$this->throwIfEmptyMatrix();
	}

	/**
	 * Operates in Theta(M*N) time where M is the number of rows, and N is the number of columns.
	 */
	public function run() : Matrix
	{
		$this->setZeroMaps();
		$this->setRowsAndColumnsToZero();

		return $this->matrix;
	}

	private function throwIfEmptyMatrix()
	{
		if ($this->matrix->count() === 0) {
			throw new ZeroMatrixEmptyMatrixException();
		}
	}

	/**
	 * Operates in Theta(M*N) time where M is the number of rows, and N is the number of columns.
	 */
	private function setZeroMaps()
	{
		$rows = $this->matrix->count();
		$cols = $this->matrix[0]->count();

		for ($row = 0; $row < $rows; $row++) {

			for ($col = 0; $col < $cols; $col++) {

				$value = $this->matrix[$row][$col];
				if ($value === 0) {

					$this->zeroCols[$col] = true;
					$this->zeroRows[$row] = true;

				}

			}

		}
	}

	/**
	 * Operates in O(M*N) or Omega(M) time where M is the number of rows, and N is the number of columns.
	 */
	private function setRowsAndColumnsToZero()
	{
		$rows = $this->matrix->count();
		$cols = $this->matrix[0]->count();

		for ($row = 0; $row < $rows; $row++) {

			if ($this->zeroRows->containsKey($row)) {

				$this->setRowToZeros($row);
				continue;

			}

			for ($col = 0; $col < $cols; $col++) {

				if ($this->zeroCols->containsKey($col)) {
					$this->matrix[$row][$col] = 0;
				}

			}

		}
	}

	private function setRowToZeros(int $row)
	{
		$count = $this->matrix[$row]->count();
		$this->matrix[$row] = Vector{};
		$this->matrix[$row]->resize($count, 0);
	}
}
