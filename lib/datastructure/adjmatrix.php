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

	/**
 	 * The adjacency matrix Vector
 	 * @type AdjListMap $adjListData
 	 */
 	protected AdjMatrixVector $adjMatrixData = Vector{};

 	/**
 	 * Construct the adjacency matrix.
 	 *
 	 * @param  protected int $matrixType = static::NOT_WEIGHTED
 	 */
 	public function __construct(protected int $matrixType = static::NOT_WEIGHTED){}

	/**
	 * Check if an edge exists.
	 *
	 * @param  {[type]} Vector $edge         [description]
	 * @return {[type]}        [description]
	 */
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
	 *
	 * @return int
	 */
	public function getMatrixSize() : int
	{
		return $this->adjMatrixData->count();
	}

	/**
	 * Check if the adjacency matrix is weighted.
	 *
	 * @return bool
	 */
	public function isWeighted() : bool
	{
		return $this->matrixType === static::WEIGHTED;
	}

	/**
	 * Insert an edge into the matrix.
	 *
	 * @param  Vector $edge
	 */
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
	 * Resize the matrix to the given size.
	 *
	 * Operates in Theta(n) time where "n" is the size of the matrix.
	 *
	 * @param  int $size
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

	/**
	 * Import the adjacency matrix from a vector.
	 * @param  {[type]} AdjMatrixVector $adjMatrix    [description]
	 * @return {[type]}                 [description]
	 */
	public function fromVector(AdjMatrixVector $adjMatrix)
	{
		$this->throwIfNotEmpty();
		$this->adjMatrixData = $adjMatrix;
	}

	/**
	 * Export the adjacency matrix to a vector.
	 * @return {[type]} [description]
	 */
	public function toVector() : AdjMatrixVector
	{
		return $this->adjMatrixData;
	}

	/**
	 * Check if the matrix is large enough to contain the given edge.
	 *
	 * @param  Vector $edge
	 *
	 * @return bool
	 */
	protected function matrixCanContainEdge(Vector $edge) : bool
	{
		$matrixSize = $this->getMatrixSize();
		return $matrixSize > $edge[0] && $matrixSize > $edge[1];
	}

	/**
	 * Get the value from the matrix at the given edge coordinates.
	 *
	 * @param  Vector $edge
	 *
	 * @return ?int
	 */
	protected function getMatrixValueFromEdge(Vector $edge) : ?int
	{
		return $this->adjMatrixData[$edge[0]][$edge[1]];
	}

	/**
	 * Check if the value stored in the matrix matches the given edge.
	 *
	 * @param  ?int $matrixValue
	 * @param  ?int $edge
	 *
	 * @return bool
	 */
	protected function matrixValueMatchesEdge(?int $matrixValue, Vector $edge) : bool
	{
		if ($this->isWeighted() === true && $matrixValue === $edge[2]) {
			return true;
		} else {
			return $matrixValue === 1;
		}

		return false;
	}

	/**
	 * Insert a weighted edge.
	 *
	 * @param Vector $edge
	 */
	protected function insertWeightedEdge(Vector $edge)
	{
		$this->adjMatrixData[$edge[0]][$edge[1]] = $edge[2];
	}

	/**
	 * Insert a non-weighted edge.
	 *
	 * @param Vector $edge
	 */
	protected function insertNonWeightedEdge(Vector $edge)
	{
		$this->adjMatrixData[$edge[0]][$edge[1]] = 1;
	}

	/**
	 * Throw an exception if the edge type is incorrect.
	 *
	 * @param  Vector $edge
	 */
	protected function throwIfWrongEdgeType(Vector $edge)
	{
		if ($edge->count() === 2 && $this->isWeighted() === true) {
			$this->throwEdgeIsNotWeightedException();
		}

		if ($edge->count() === 3 && $this->isWeighted() === false) {
			$this->throwEdgeIsWeightedException();
		}
	}

	/**
	 * @throws AdjMatrixEdgeIsNotWeightedException
	 */
	protected function throwEdgeIsNotWeightedException()
	{
		throw new AdjMatrixEdgeIsNotWeightedException();
	}

	/**
	 * @throws AdjMatrixEdgeIsWeightedException
	 */
	protected function throwEdgeIsWeightedException()
	{
		throw new AdjMatrixEdgeIsWeightedException();
	}

	/**
	 * Get the value that sigifies that no edge exists.
	 *
	 * @return ?int
	 */
	protected function getNoEdgeValue() : ?int
	{
		return $this->isWeighted() === true ? null : 0;
	}

	/**
	 * Throw an exception if the adjacency matrix is not empty.
	 *
	 * @throws AdjMatrixNotEmptyException
	 */
	protected function throwIfNotEmpty()
	{
		if ($this->adjMatrixData->isEmpty() === false) {
			throw new AdjMatrixNotEmptyException();
		}
	}
}
