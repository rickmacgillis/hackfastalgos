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

	public function setSortVertex()
	{
		$this->sortMode = static::SORT_VERTEX;
	}

	public function setSortWeights()
	{
		$this->sortMode = static::SORT_WEIGHTS;
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
		$this->createEmptyAdjListOfWeightedType($this->edgeList->isWeighted());
		$this->insertEdgeListEdgesIntoObject($this->adjList);
		$this->sortObjectIfSortingEnabled($this->adjList);
	}

	protected function createEmptyAdjListOfWeightedType(bool $isWeighted)
	{
		$weighted = ($isWeighted === true) ? DataStructure\AdjList::WEIGHTED : DataStructure\AdjList::NOT_WEIGHTED;
		$this->adjList = new DataStructure\AdjList($weighted);
	}

	/**
	 * Operates in Theta(n*E) time for adjacency matrixes, where n is the size
	 * of the adjacency matrix. E is the number of edges.
	 * Operates in Theta(E) time for adjacency lists.
	 */
	protected function insertEdgeListEdgesIntoObject<T>(T $object)
	{
		$edgeListVector = $this->edgeList->toVector();
		$edgeListCount = $edgeListVector->count();

		for ($i = 0; $i < $edgeListCount; $i++) {
			$object->insertEdge($edgeListVector[$i]);
		}
	}

	protected function sortObjectIfSortingEnabled<T>(T $object)
	{
		switch ($this->sortMode) {
			case static::SORT_VERTEX: $object->sortByVertex(); break;
			case static::SORT_WEIGHTS: $object->sortByWeights(); break;
		}
	}

	protected function edgeListToAdjMatrix()
	{
		$this->createEmptyAdjMatrixOfWeightedType($this->edgeList->isWeighted());
		$this->insertEdgeListEdgesIntoObject($this->adjMatrix);
	}

	protected function createEmptyAdjMatrixOfWeightedType(bool $isWeighted)
	{
		$weighted = ($isWeighted === true) ? DataStructure\AdjMatrix::WEIGHTED : DataStructure\AdjMatrix::NOT_WEIGHTED;
		$this->adjMatrix = new DataStructure\AdjMatrix($weighted);
	}

	protected function adjListToEdgeList<T>()
	{
		$this->createEmptyEdgeListOfWeightedType($this->adjList->isWeighted());
		$this->insertAdjListEdgesIntoObject($this->edgeList);
		$this->sortObjectIfSortingEnabled($this->edgeList);
	}

	protected function insertAdjListEdgesIntoObject<T>(T $object)
	{
		$adjListMap = $this->adjList->toMap();
		foreach ($adjListMap as $firstCoord => $adjEdges) {

			$numAdjEdges = $adjEdges->count();
			for ($i = 0; $i < $numAdjEdges; $i++) {

				$edge = $this->getEdgeFromAdjEdgeVector($adjEdges[$i], $firstCoord);
				$object->insertEdge($edge);

			}

		}
	}

	protected function createEmptyEdgeListOfWeightedType(bool $isWeighted)
	{
		$weighted = ($isWeighted === true) ? DataStructure\EdgeList::WEIGHTED : DataStructure\EdgeList::NOT_WEIGHTED;
		$this->edgeList = new DataStructure\EdgeList($weighted);
	}

	protected function getEdgeFromAdjEdgeVector(Vector $adjEdge, int $firstCoord) : Vector
	{
		if ($adjEdge->count() === 2) {
			return Vector{$firstCoord, $adjEdge[0], $adjEdge[1]};
		}

		return Vector{$firstCoord, $adjEdge[0]};
	}

	protected function adjListToAdjMatrix<T>()
	{
		$this->createEmptyAdjMatrixOfWeightedType($this->adjList->isWeighted());
		$this->insertAdjListEdgesIntoObject($this->adjMatrix);
	}

	protected function adjMatrixToEdgeList()
	{
		$this->createEmptyEdgeListOfWeightedType($this->adjMatrix->isWeighted());
		$this->insertAdjMatrixEdgesIntoObject($this->edgeList);
		$this->sortObjectIfSortingEnabled($this->edgeList);
	}

	protected function insertAdjMatrixEdgesIntoObject<T>(T $object)
	{
		$matrixVector = $this->adjMatrix->toVector();
		$matrixSize = $matrixVector->count();
		for ($i = 0; $i < $matrixSize; $i++) {

			for ($j = 0; $j < $matrixSize; $j++) {
				$this->insertEdgeOnObjectIfExistsInMatrix(Vector{$i, $j}, $object);
			}

		}
	}

	protected function insertEdgeOnObjectIfExistsInMatrix<T>(Vector $edge, T $object)
	{
		$edgeWeight = $this->adjMatrix->getEdgeWeight($edge);
		if ($edgeWeight !== $this->adjMatrix->getNoEdgeValue()) {

			$edge = $this->adjMatrix->isWeighted() ? Vector{$edge[0], $edge[1], $edgeWeight} : $edge;
			$object->insertEdge($edge);

		}
	}

	protected function adjMatrixToAdjList<T>()
	{
		$this->createEmptyAdjListOfWeightedType($this->adjMatrix->isWeighted());
		$this->insertAdjMatrixEdgesIntoObject($this->adjList);
		$this->sortObjectIfSortingEnabled($this->adjList);
	}
}
