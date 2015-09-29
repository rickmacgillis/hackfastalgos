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

	/**
	 * The adjacency list map
	 * @type AdjListMap $adjListData
	 */
	protected AdjListMap $adjListData = Map{};

	/**
	 * Contruct the adjacency list.
	 *
	 * @param  protected int $listType = static::NOT_WEIGHTED
	 */
	public function __construct(protected int $listType = static::NOT_WEIGHTED){}

	/**
	 * Check if a given edge exists in the adjacency list.
	 *
	 * Operates in O(E) time where E is the number of edges adjacent to
	 * the first vertex in the edge. At its best it operates in Omega(1) time.
	 *
	 * @param  Vector $edge
	 *
	 * @return bool
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

	/**
	 * Check if the adjacency list is weighted.
	 *
	 * @return bool
	 */
	public function isWeighted() : bool
	{
		return $this->listType === static::WEIGHTED;
	}

	/**
	 * Insert an edge into the adjacency list.
	 *
	 * @param  Vector $edge
	 */
	public function insertEdge(Vector $edge)
	{
		$this->throwIfWrongEdgeType($edge);
		if ($this->isWeightedEdge($edge)) {
			$this->insertWeightedEdge($edge);
		} else {
			$this->insertNonWeightedEdge($edge);
		}
	}

	/**
	 * Import the adjacency list from a map.
	 *
	 * @param  AdjListMap $adjList
	 */
	public function fromMap(AdjListMap $adjList)
	{
		$this->throwIfListNotEmpty();
		$this->adjListData = $adjList;
	}

	/**
	 * Get the adjacency list data as a map.
	 *
	 * @return AdjListMap
	 */
	public function toMap() : AdjListMap
	{
		return $this->adjListData;
	}

	/**
	 * Check if the starting vertex exists.
	 *
	 * @param  int $vertex
	 *
	 * @return bool
	 */
	protected function startingVertexExists(int $vertex) : bool
	{
		return $this->adjListData->containsKey($vertex);
	}

	/**
	 * Get the list of edges involving a given vertex.
	 *
	 * @param  int $vertex
	 *
	 * @return Vector
	 */
	protected function getAdjacentEdgesForVertex(int $vertex) : Vector
	{
		return $this->adjListData[$vertex];
	}

	/**
	 * Check if an edge in the list matches a given edge.
	 *
	 * @param  Vertex $existingEdge
	 * @param  Vertex $compareTo
	 *
	 * @return bool
	 */
	protected function edgesAreTheSame(Vector $existingEdge, Vector $compareTo) : bool
	{
		if ($this->isWeighted() === true) {
			return $existingEdge[0] === $compareTo[1] && $existingEdge[1] === $compareTo[2];
		}

		return $existingEdge[0] === $compareTo[1];
	}

	/**
	 * Check if an edge is a weighted edge.
	 *
	 * @param  Vector $edge
	 *
	 * @return bool
	 */
	protected function isWeightedEdge(Vector $edge) : bool
	{
		return $edge->count() === 3;
	}

	/**
	 * Insert a weighted edge.
	 *
	 * @param  Vector $edge
	 */
	protected function insertWeightedEdge(Vector $edge)
	{
		$this->insertStartingVertexIfNotExists($edge[0]);
		$this->adjListData[$edge[0]][] = Vector{$edge[1], $edge[2]};
	}

	/**
	 * Insert a non-weighted edge.
	 *
	 * @param  Vector $edge
	 */
	protected function insertNonWeightedEdge(Vector $edge)
	{
		$this->insertStartingVertexIfNotExists($edge[0]);
		$this->adjListData[$edge[0]][] = Vector{$edge[1]};
	}

	/**
	 * Insert the starting vector if it doesn't exist.
	 *
	 * @param  int $vertex
	 */
	protected function insertStartingVertexIfNotExists(int $vertex)
	{
		if ($this->startingVertexExists($vertex) === false) {
			$this->adjListData[$vertex] = Vector{};
		}
	}

	/**
	 * Throw an exception if the edge is not of the correct type.
	 *
	 * @param  Vector $edge
	 */
	protected function throwIfWrongEdgeType(Vector $edge)
	{
		if ($edge->count() === 3 && $this->listType === static::NOT_WEIGHTED) {
			$this->throwEdgeIsWeightedException();
		}

		if ($edge->count() === 2 && $this->listType === static::WEIGHTED) {
			$this->throwEdgeIsNotWeightedException();
		}
	}

	/**
	 * @throws AdjListEdgeIsWeightedException
	 */
	protected function throwEdgeIsWeightedException()
	{
		throw new AdjListEdgeIsWeightedException();
	}

	/**
	 * @throws AdjListEdgeIsNotWeightedException
	 */
	protected function throwEdgeIsNotWeightedException()
	{
		throw new AdjListEdgeIsNotWeightedException();
	}

	/**
	 * Throw an exception if the adjacency list is not empty.
	 *
	 * @throws AdjListNotEmptyException
	 */
	protected function throwIfListNotEmpty()
	{
		if ($this->adjListData->isEmpty() === false) {
			throw new AdjListNotEmptyException();
		}
	}
}
