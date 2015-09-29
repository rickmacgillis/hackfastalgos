<?HH
/**
 * @author Rick Mac Gillis
 *
 * Adjacency matrix data structure
 * Learn more @link https://en.wikipedia.org/wiki/Adjacency_matrix
 */

namespace HackFastAlgos\DataStructure;

newtype AdjMatrixVector = Vector<Vector<int>>;

class AdjMatrixNotEmptyException extends \Exception{}
class AdjMatrixEdgeIsWeightedException extends \Exception{}
class AdjMatrixEdgeIsNotWeightedException extends \Exception{}

class AdjMatrix implements \HackFastAlgos\Interfaces\GraphFormat
{

	/**
	  * If the data contains weights, then the matrix will use the weights to
	  * signify an edge, and null to signify that no edge exists. If the edge
	  * list is not weighted, then the adjacency matrix will use 1 for a
	  * connection and 0 for no connection.
	  *
	  * Weighted adjacency matrix:
	  * [
	  * 	[3,    null, 4,    88, 0],
	  * 	[null, 4,    null, 20, 1],
	  * 	...
	  * ]
	  *
	  * Non-weighted adjacency matrix:
	  *
	  * [
	  * 	[0, 1, 0, 0, 1, 1],
	  * 	[1, 1, 0, 1, 1, 0],
	  * 	...
	  * ]
	 */

 	protected AdjMatrixVector $adjMatrixData = Vector{};

 	public function __construct(protected int $matrixType = static::NOT_WEIGHTED){}

	public function edgeExists(Vector $edge) : bool
	{
		if ($this->matrixCanContainEdge($edge)) {
			$matrixValue = $this->getMatrixValueFromEdge($edge);
			return $this->matrixValueMatchesEdge($matrixValue, $edge);
		}

		return false;
	}

	/**
	 * Get the matrix width/height. It's always a square.
	 */
	public function getMatrixSize() : int
	{
		return $this->adjMatrixData->count();
	}

	public function isWeighted() : bool
	{
		return $this->matrixType === static::WEIGHTED;
	}

	public function insertEdge(Vector $edge)
	{
		$this->throwIfWrongEdgeType($edge);
		if ($this->matrixCanContainEdge($edge) === false) {
			$newSize = ($edge[0] > $edge[1]) ? $edge[0] : $edge[1];
			$this->resizeMatrixTo($newSize);
		}

		if ($this->isWeighted() === true) {
			$this->insertWeightedEdge($edge);
		} else {
			$this->insertNonWeightedEdge($edge);
		}
	}

	/**
	 * Operates in Theta(n) time where "n" is the size of the matrix.
	 */
	public function resizeMatrixTo(int $size)
	{
		$size++; // Account for zero indexing.
		$this->adjMatrixData->resize($size, 0);
		$matrixSize = $this->getMatrixSize();
		for ($i = 0; $i < $matrixSize; $i++) {
			if ($this->adjMatrixData[$i] === 0) {
				$this->adjMatrixData[$i] = Vector{};
			}
			$this->adjMatrixData[$i]->resize($size, $this->getNoEdgeValue());
		}
	}

	public function fromVector(AdjMatrixVector $adjMatrix)
	{
		$this->throwIfNotEmpty();
		$this->adjMatrixData = $adjMatrix;
	}

	public function toVector() : AdjMatrixVector
	{
		return $this->adjMatrixData;
	}

	protected function matrixCanContainEdge(Vector $edge) : bool
	{
		$matrixSize = $this->getMatrixSize();
		return $matrixSize > $edge[0] && $matrixSize > $edge[1];
	}

	protected function getMatrixValueFromEdge(Vector $edge) : ?int
	{
		return $this->adjMatrixData[$edge[0]][$edge[1]];
	}

	protected function matrixValueMatchesEdge(?int $matrixValue, Vector $edge) : bool
	{
		if ($this->isWeighted() === true && $matrixValue === $edge[2]) {
			return true;
		} else {
			return $matrixValue === 1;
		}

		return false;
	}

	protected function insertWeightedEdge(Vector $edge)
	{
		$this->adjMatrixData[$edge[0]][$edge[1]] = $edge[2];
	}

	protected function insertNonWeightedEdge(Vector $edge)
	{
		$this->adjMatrixData[$edge[0]][$edge[1]] = 1;
	}

	protected function throwIfWrongEdgeType(Vector $edge)
	{
		if ($edge->count() === 2 && $this->isWeighted() === true) {
			$this->throwEdgeIsNotWeightedException();
		}

		if ($edge->count() === 3 && $this->isWeighted() === false) {
			$this->throwEdgeIsWeightedException();
		}
	}

	protected function throwEdgeIsNotWeightedException()
	{
		throw new AdjMatrixEdgeIsNotWeightedException();
	}

	protected function throwEdgeIsWeightedException()
	{
		throw new AdjMatrixEdgeIsWeightedException();
	}

	protected function getNoEdgeValue() : ?int
	{
		return $this->isWeighted() === true ? null : 0;
	}

	protected function throwIfNotEmpty()
	{
		if ($this->adjMatrixData->isEmpty() === false) {
			throw new AdjMatrixNotEmptyException();
		}
	}
}
