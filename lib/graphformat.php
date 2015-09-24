<?HH
/**
 * @author Rick Mac Gillis
 *
 * Conversions between various graph data representations
 * Learn more:
 * @link https://en.wikipedia.org/wiki/Adjacency_list
 * @link https://en.wikipedia.org/wiki/Adjacency_matrix
 */

/**
 * Format types:
 *
 * Weighted edge list:
 * [[vertexU, vertexV, weight],[vertexU, vertexV, weight], ...]
 *
 * Non-weighted edge list:
 * [[vertexU, vertexV],[vertexU, vertexV], ...]
 *
 * Weighted adjacency list:
 * [vertex][[vertex, weight], [vertex, weight], ...]
 * [vertex][[vertex, weight], ...]
 * [vertex][[vertex, weight], ...]
 * ...
 *
 * Non-weighted adjacency list:
 * [vertex][[vertex], [vertex], [vertex], ...]
 * [vertex][[vertex], [vertex], ...]
 * [vertex][[vertex], [vertex], [vertex], ...]
 * ...
 *
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

namespace HackFastAlgos;

type HFAEdgeList	= Vector<Vector<int>>;
type HFAAdjList<T>	= Vector<T>;
type HFAMatrix		= Vector<Vector<int>>;

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
	 * @type HFAEdgeList
	 */
	protected ?HFAEdgeList $edgeList = null;

	/**
	 * The defined adjacency list
	 * @type HFAAdjList
	 */
	protected ?HFAAdjList $adjList = null;

	/**
	 * The defined adjacency matrix
	 * @type HFAMatrix
	 */
	protected ?HFAMatrix $adjMatrix = null;

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
	 * @param HFAEdgeList $edgeList
	 */
	public function fromEdgeList(HFAEdgeList $edgeList)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->edgeList = $edgeList;
	}

	/**
	 * Set the adjacency list.
	 *
	 * @param HFAAdjList $adjList
	 */
	public function fromAdjList(HFAAdjList $adjList)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->adjList = $adjList;
	}

	/**
	 * Set the adjacency matrix.
	 *
	 * @param HFAMatrix $adjMatrix
	 */
	public function fromAdjMatrix(HFAMatrix $adjMatrix)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->adjMatrix = $adjMatrix;
	}

	/**
	 * Convert the data to an edge list.
	 *
	 * @return HFAEdgeList
	 */
	public function toEdgeList() : HFAEdgeList
	{
		$this->throwIfFromFormatNotSet();

		if ($this->edgeList !== null) {
			return $this->edgeList;
		}

		if ($this->getFromFormat() === 'adjList') {
			$this->edgeList = $this->adjListToEdgeList();
			return $this->edgeList;
		}

		if ($this->getFromFormat() === 'adjMatrix') {
			$this->edgeList = $this->adjMatrixToEdgeList();
			return $this->edgeList;
		}
	}

	/**
	 * Convert the data to an adjacency list.
	 *
	 * @return HFAAdjList
	 */
	public function toAdjList() : HFAAdjList
	{
		$this->throwIfFromFormatNotSet();

		if ($this->adjList !== null) {
			return $this->adjList;
		}

		if ($this->getFromFormat() === 'edgeList') {
			$this->adjList = $this->edgeListToAdjList();
			return $this->adjList;
		}

		if ($this->getFromFormat() === 'adjMatrix') {
			$this->adjList = $this->adjMatrixToAdjList();
			return $this->adjList;
		}
	}

	/**
	 * Convert the data to an adjacency matrix.
	 *
	 * @return HFAMatrix
	 */
	public function toAdjMatrix() : HFAMatrix
	{
		$this->throwIfFromFormatNotSet();

		if ($this->adjMatrix !== null) {
			return $this->adjMatrix;
		}

		if ($this->getFromFormat() === 'edgeList') {
			$this->adjMatrix = $this->edgeListToAdjMatrix();
			return $this->adjMatrix;
		}

		if ($this->getFromFormat() === 'adjList') {
			$this->adjMatrix = $this->adjListToAdjMatrix();
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

	protected function edgeListToAdjList<T>() : HFAAdjList<T>
	{
		$this->sortMode;
		$this->edgeList;
	}

	protected function edgeListToAdjMatrix() : HFAMatrix
	{
		$this->edgeList;
	}

	protected function adjListToEdgeList<T>() : HFAEdgeList
	{
		$this->sortMode;
		$this->adjList;
	}

	protected function adjListToAdjMatrix<T>() : HFAMatrix
	{
		$this->adjList;
	}

	protected function adjMatrixToEdgeList() : HFAEdgeList
	{
		$this->sortMode;
		$this->adjMatrix;
	}

	protected function adjMatrixToAdjList<T>() : HFAAdjList<T>
	{
		$this->sortMode;
		$this->adjMatrix;
	}
}
