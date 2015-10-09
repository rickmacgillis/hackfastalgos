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

	public function setWeighted()
	{
		$this->listType = static::WEIGHTED;
	}

	public function setNotWeighted()
	{
		$this->listType = static::NOT_WEIGHTED;
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
				if ($this->adjEdgeIsTheSameAsExistingEdge($edge, $adjEdges[$i])) {
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

	private function startingVertexExists(int $vertex) : bool
	{
		return $this->adjListData->containsKey($vertex);
	}

	private function getAdjacentEdgesForVertex(int $vertex) : Vector
	{
		return $this->adjListData[$vertex];
	}

	private function adjEdgeIsTheSameAsExistingEdge(Vector $adjEdge, Vector $existingEdge) : bool
	{
		if ($this->isWeighted() === true) {
			return $existingEdge[0] === $adjEdge[1] && $existingEdge[1] === $adjEdge[2];
		}

		return $existingEdge[0] === $adjEdge[1];
	}

	private function isWeightedEdge(Vector $edge) : bool
	{
		return $edge->count() === 3;
	}

	private function insertWeightedEdge(Vector $edge)
	{
		$this->insertStartingVertexIfNotExists($edge[0]);
		$this->adjListData[$edge[0]][] = Vector{$edge[1], $edge[2]};
	}

	private function insertNonWeightedEdge(Vector $edge)
	{
		$this->insertStartingVertexIfNotExists($edge[0]);
		$this->adjListData[$edge[0]][] = Vector{$edge[1]};
	}

	private function insertStartingVertexIfNotExists(int $vertex)
	{
		if ($this->startingVertexExists($vertex) === false) {
			$this->adjListData[$vertex] = Vector{};
		}
	}

	private function throwIfWrongEdgeType(Vector $edge)
	{
		if ($edge->count() === 3 && $this->listType === static::NOT_WEIGHTED) {
			$this->throwEdgeIsWeightedException();
		}

		if ($edge->count() === 2 && $this->listType === static::WEIGHTED) {
			$this->throwEdgeIsNotWeightedException();
		}
	}

	private function throwEdgeIsWeightedException()
	{
		throw new AdjListEdgeIsWeightedException();
	}

	private function throwEdgeIsNotWeightedException()
	{
		throw new AdjListEdgeIsNotWeightedException();
	}

	private function throwIfListNotEmpty()
	{
		if ($this->adjListData->isEmpty() === false) {
			throw new AdjListNotEmptyException();
		}
	}

	/**
	 * Operates in O(E log n) or Omega(E) time.
	 */
	private function queueEdgesByPriorityIndex(?int $priorityIndex)
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

	private function getEdgeFromVertexAndAdjacentEdge(int $vertex, Vector $adjEdge) : Vector
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
	private function queueToAdjList()
	{
		$numEdges = $this->edgeQueue->count();
		$this->adjListData = Map{};
		for ($i = 0; $i < $numEdges; $i++) {
			$this->insertEdge($this->edgeQueue->dequeue());
		}
	}

	private function throwExceptionIfNotWeightedList()
	{
		if ($this->isWeighted() === false) {
			throw new AdjListNotWeightedListException();
		}
	}
}
