<?HH
/**
 * @author Rick Mac Gillis
 *
 * Adjacency list data structure
 * Learn more @link https://en.wikipedia.org/wiki/Adjacency_list
 */

namespace HackFastAlgos\DataStructure;

newtype AdjListMap = Map<int,Vector<Vector<int>>>;

class AdjListNotEmptyException extends \Exception{}
class AdjListEdgeIsWeightedException extends \Exception{}
class AdjListEdgeIsNotWeightedException extends \Exception{}
class AdjListNotWeightedListException extends \Exception{}

class AdjList implements \HackFastAlgos\Interfaces\GraphFormat
{
	/**
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
	 */

	private AdjListMap $adjListData = Map{};
	private ?PriorityQueue $edgeQueue = null;

	public function __construct(protected int $listType = static::NOT_WEIGHTED){
		$this->edgeQueue = new PriorityQueue();
	}

	/**
	 * Operates in O(E) time where E is the number of edges adjacent to
	 * the first vertex in the edge. At its best it operates in Omega(1) time.
	 */
	public function edgeExists(Vector $edge) : bool
	{
		if ($this->startingVertexExists($edge[0])) {

			$adjEdges = $this->getAdjacentEdgesForVertex($edge[0]);
			$numAdjEdges = $adjEdges->count();
			for ($i = 0; $i < $numAdjEdges; $i++) {
				if ($this->edgesAreTheSame($adjEdges[$i], $edge)) {
					return true;
				}
			}

		}

		return false;
	}

	public function isWeighted() : bool
	{
		return $this->listType === static::WEIGHTED;
	}

	public function insertEdge(Vector $edge)
	{
		$this->throwIfWrongEdgeType($edge);
		if ($this->isWeightedEdge($edge)) {
			$this->insertWeightedEdge($edge);
		} else {
			$this->insertNonWeightedEdge($edge);
		}
	}

	public function fromMap(AdjListMap $adjList)
	{
		$this->throwIfListNotEmpty();
		$this->adjListData = $adjList;
	}

	public function toMap() : AdjListMap
	{
		return $this->adjListData;
	}

	/**
	 * Operates in Theta(n log n) time.
	 */
	public function sortByVertex()
	{
		// Heap sort is not stable, so we cannot multisort by the second vertex this way.
		$this->queueEdgesByPriorityIndex(null);
		$this->queueToAdjList();
	}

	/**
	 * Operates in Theta(n log n) time.
	 */
	public function sortByWeights()
	{
		$this->throwExceptionIfNotWeightedList();
		$this->queueEdgesByPriorityIndex(1);
		$this->queueToAdjList();
	}

	protected function startingVertexExists(int $vertex) : bool
	{
		return $this->adjListData->containsKey($vertex);
	}

	protected function getAdjacentEdgesForVertex(int $vertex) : Vector
	{
		return $this->adjListData[$vertex];
	}

	protected function edgesAreTheSame(Vector $existingEdge, Vector $compareTo) : bool
	{
		if ($this->isWeighted() === true) {
			return $existingEdge[0] === $compareTo[1] && $existingEdge[1] === $compareTo[2];
		}

		return $existingEdge[0] === $compareTo[1];
	}

	protected function isWeightedEdge(Vector $edge) : bool
	{
		return $edge->count() === 3;
	}

	protected function insertWeightedEdge(Vector $edge)
	{
		$this->insertStartingVertexIfNotExists($edge[0]);
		$this->adjListData[$edge[0]][] = Vector{$edge[1], $edge[2]};
	}

	protected function insertNonWeightedEdge(Vector $edge)
	{
		$this->insertStartingVertexIfNotExists($edge[0]);
		$this->adjListData[$edge[0]][] = Vector{$edge[1]};
	}

	protected function insertStartingVertexIfNotExists(int $vertex)
	{
		if ($this->startingVertexExists($vertex) === false) {
			$this->adjListData[$vertex] = Vector{};
		}
	}

	protected function throwIfWrongEdgeType(Vector $edge)
	{
		if ($edge->count() === 3 && $this->listType === static::NOT_WEIGHTED) {
			$this->throwEdgeIsWeightedException();
		}

		if ($edge->count() === 2 && $this->listType === static::WEIGHTED) {
			$this->throwEdgeIsNotWeightedException();
		}
	}

	protected function throwEdgeIsWeightedException()
	{
		throw new AdjListEdgeIsWeightedException();
	}

	protected function throwEdgeIsNotWeightedException()
	{
		throw new AdjListEdgeIsNotWeightedException();
	}

	protected function throwIfListNotEmpty()
	{
		if ($this->adjListData->isEmpty() === false) {
			throw new AdjListNotEmptyException();
		}
	}

	/**
	 * Operates in O(E log n) or Omega(E) time.
	 */
	protected function queueEdgesByPriorityIndex(?int $priorityIndex)
	{
		foreach ($this->adjListData as $vertex => $adjEdges) {

			$numAdjEdges = $adjEdges->count();
			for ($i = 0; $i < $numAdjEdges; $i++) {

				$adjEdge = $adjEdges[$i];
				$edge = $this->getEdgeFromVertexAndAdjacentEdge($vertex, $adjEdge);
				$priority = ($priorityIndex === null) ? $vertex : $adjEdge[$priorityIndex];
				$this->edgeQueue->enqueue($edge, -$priority);

			}
		}
	}

	protected function getEdgeFromVertexAndAdjacentEdge(int $vertex, Vector $adjEdge) : Vector
	{
		$edge = Vector{$vertex, $adjEdge[0]};
		if ($this->isWeighted()) {
			$edge[] = $adjEdge[1];
		}
		return $edge;
	}

	/**
	 * Operates in O(E log n) or Omega(E) time.
	 */
	protected function queueToAdjList()
	{
		$numEdges = $this->edgeQueue->count();
		$this->adjListData = Map{};
		for ($i = 0; $i < $numEdges; $i++) {
			$this->insertEdge($this->edgeQueue->dequeue());
		}
	}

	protected function throwExceptionIfNotWeightedList()
	{
		if ($this->isWeighted() === false) {
			throw new AdjListNotWeightedListException();
		}
	}
}
