<?HH
/**
 * @author Rick Mac Gillis
 *
 * Conversions between various graph data representations
 * Learn more:
 * @link https://en.wikipedia.org/wiki/Adjacency_list
 * @link https://en.wikipedia.org/wiki/Adjacency_matrix
 */

namespace HackFastAlgos;

class GraphFormatFromTypeAlreadySetException extends \Exception{}
class GraphFormatFromTypeNotSetException extends \Exception{}

class GraphFormat
{
	/**
	 * Don't sort the resulting graph
	 * @var int SORT_NONE = 0
	 */
	const SORT_NONE = 0;

	/**
	 * Sort the resulting graph by its vertices (low to high)
	 * @var int SORT_VERTEX = 1
	 */
	const SORT_VERTEX = 1;

	/**
	 * Sort the resulting graph by its weights (low to high)
	 * @var int SORT_WEIGHTS = 2
	 */
	const SORT_WEIGHTS = 2;

	/**
	 * The sorting mode for all formats
	 * @type int $sortMode
	 */
	protected int $sortMode = 0;

	/**
	 * The defined edge list
	 * @type ?EdgeList
	 */
	protected ?DataStructure\EdgeList $edgeList = null;

	/**
	 * The defined adjacency list
	 * @type ?AdjList
	 */
	protected ?DataStructure\AdjList $adjList = null;

	/**
	 * The defined adjacency matrix
	 * @type ?Matrix
	 */
	protected ?DataStructure\Matrix $adjMatrix = null;

	/**
	 * Set the sorting mode for all converted data formats.
	 *
	 * @param int $sortMode	One of the class defined constants:
	 *                      SORT_NONE (default), SORT_VERTEX, or SORT_WEIGHTS
	 */
	protected function setSortMode(int $sortMode)
	{
		$this->sortMode = $sortMode;
	}

	/**
	 * Set the edge list.
	 *
	 * @param EdgeList $edgeList
	 */
	public function fromEdgeList(DataStructure\EdgeList $edgeList)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->edgeList = $edgeList;
	}

	/**
	 * Set the adjacency list.
	 *
	 * @param AdjList $adjList
	 */
	public function fromAdjList(DataStructure\AdjList $adjList)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->adjList = $adjList;
	}

	/**
	 * Set the adjacency matrix.
	 *
	 * @param AdjMatrix $adjMatrix
	 */
	public function fromAdjMatrix(DataStructure\AdjMatrix $adjMatrix)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->adjMatrix = $adjMatrix;
	}

	/**
	 * Convert the data to an edge list.
	 *
	 * @return EdgeList
	 */
	public function toEdgeList() : DataStructure\EdgeList
	{
		$this->throwIfFromFormatNotSet();

		if ($this->edgeList !== null) {
			return $this->edgeList;
		}

		if ($this->getFromFormat() === 'adjList') {
			$this->adjListToEdgeList();
			return $this->edgeList;
		}

		if ($this->getFromFormat() === 'adjMatrix') {
			$this->adjMatrixToEdgeList();
			return $this->edgeList;
		}
	}

	/**
	 * Convert the data to an adjacency list.
	 *
	 * @return AdjList
	 */
	public function toAdjList() : DataStructure\AdjList
	{
		$this->throwIfFromFormatNotSet();

		if ($this->adjList !== null) {
			return $this->adjList;
		}

		if ($this->getFromFormat() === 'edgeList') {
			$this->edgeListToAdjList();
			return $this->adjList;
		}

		if ($this->getFromFormat() === 'adjMatrix') {
			$this->adjMatrixToAdjList();
			return $this->adjList;
		}
	}

	/**
	 * Convert the data to an adjacency matrix.
	 *
	 * @return AdjMatrix
	 */
	public function toAdjMatrix() : DataStructure\AdjMatrix
	{
		$this->throwIfFromFormatNotSet();

		if ($this->adjMatrix !== null) {
			return $this->adjMatrix;
		}

		if ($this->getFromFormat() === 'edgeList') {
			$this->edgeListToAdjMatrix();
			return $this->adjMatrix;
		}

		if ($this->getFromFormat() === 'adjList') {
			$this->adjListToAdjMatrix();
			return $this->adjMatrix;
		}
	}

	/**
	 * Throw an exception if the from format is already set.
	 *
	 * @throws GraphFormatFromTypeAlreadySet
	 */
	protected function throwIfFromFormatAlreadySet()
	{
		if ($this->getFromFormat() !== null) {
			throw new GraphFormatFromTypeAlreadySetException();
		}
	}

	/**
	 * Get the format to convert from or return null;
	 *
	 * @return ?string
	 */
	protected function getFromFormat() : ?string
	{
		if ($this->edgeList !== null) {
			return 'edgeList';
		}

		if ($this->adjList !== null) {
			return 'adjList';
		}

		if ($this->adjMatrix !== null) {
			return 'adjMatrix';
		}

		return null;
	}

	/**
	 * Throw an exception if the from format type is not set.
	 *
	 * @throws GraphFormatFromTypeNotSetException
	 */
	protected function throwIfFromFormatNotSet()
	{
		if ($this->getFromFormat() === null) {
			throw new GraphFormatFromTypeNotSetException();
		}
	}

	protected function edgeListToAdjList<T>()
	{
		$this->sortMode;
		$this->edgeList;
	}

	protected function edgeListToAdjMatrix()
	{
		$this->edgeList;
	}

	protected function adjListToEdgeList<T>()
	{
		$this->sortMode;
		$this->adjList;
	}

	protected function adjListToAdjMatrix<T>()
	{
		$this->adjList;
	}

	protected function adjMatrixToEdgeList()
	{
		$this->sortMode;
		$this->adjMatrix;
	}

	protected function adjMatrixToAdjList<T>()
	{
		$this->sortMode;
		$this->adjMatrix;
	}
}
