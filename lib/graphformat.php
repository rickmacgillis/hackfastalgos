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
	const SORT_NONE = 0;
	const SORT_VERTEX = 1;
	const SORT_WEIGHTS = 2;

	protected int $sortMode = 0;

	protected ?DataStructure\EdgeList $edgeList = null;
	protected ?DataStructure\AdjList $adjList = null;
	protected ?DataStructure\Matrix $adjMatrix = null;

	protected function setSortMode(int $sortMode)
	{
		$this->sortMode = $sortMode;
	}

	public function fromEdgeList(DataStructure\EdgeList $edgeList)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->edgeList = $edgeList;
	}

	public function fromAdjList(DataStructure\AdjList $adjList)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->adjList = $adjList;
	}

	public function fromAdjMatrix(DataStructure\AdjMatrix $adjMatrix)
	{
		$this->throwIfFromFormatAlreadySet();
		$this->adjMatrix = $adjMatrix;
	}

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

	protected function throwIfFromFormatAlreadySet()
	{
		if ($this->getFromFormat() !== null) {
			throw new GraphFormatFromTypeAlreadySetException();
		}
	}

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
