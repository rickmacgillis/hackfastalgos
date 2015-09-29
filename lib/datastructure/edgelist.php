<?HH
/**
 * @author Rick Mac Gillis
 *
 * Edge list data structure
 */

namespace HackFastAlgos\DataStructure;

newtype EdgeListVector = Vector<Vector<int>>;

class EdgeListEdgeIsWeightedException extends \Exception{}
class EdgeListEdgeIsNotWeightedException extends \Exception{}
class EdgeListNotEmptyException extends \Exception{}

class EdgeList implements \HackFastAlgos\Interfaces\GraphFormat
{

	/**
	 * Weighted edge list:
	 * [[vertexU, vertexV, weight],[vertexU, vertexV, weight], ...]
	 *
	 * Non-weighted edge list:
	 * [[vertexU, vertexV],[vertexU, vertexV], ...]
	 */

	/**
	 * The list of edges
	 * @type EdgeListVector $edgeListData
	 */
	protected EdgeListVector $edgeListData = Vector{};

	/**
	 * Contruct the edge list.
	 *
	 * @param  protected int $listType = static::NOT_WEIGHTED
	 */
	public function __construct(protected int $listType = static::NOT_WEIGHTED){}

	/**
	 * Check if an edge exists in the list.
	 *
	 * Operates in O(E) time where E is the number of edges.
	 * At its best it operates in Omega(1) time.
	 *
	 * @param  Vector $edge
	 *
	 * @return bool
	 */
	public function edgeExists(Vector $edge) : bool
	{
		$edgeCount = $this->edgeListData->count();
		for ($i = 0; $i < $edgeCount; $i++) {

			if ($this->edgeListData[$i] == $edge) {
				return true;
			}

		}

		return false;
	}

	/**
	 * Check if the edge list is a weighted edge list.
	 *
	 * @return bool
	 */
	public function isWeighted() : bool
	{
		return $this->listType === static::WEIGHTED;
	}

	/**
	 * Insert an edge into the edge list.
	 *
	 * @param  Vector $edge
	 */
	public function insertEdge(Vector $edge)
	{
		$this->throwIfEdgeIsTheWrongFormat($edge);
		$this->edgeListData[] = $edge;
	}

	/**
	 * Import an edge list vector into the object.
	 *
	 * @param  EdgeListVector $edgeList
	 */
	public function fromVector(EdgeListVector $edgeList)
	{
		$this->throwIfListNotEmpty();
		$this->edgeListData = $edgeList;
	}

	/**
	 * Get the edge list as a Vector.
	 *
	 * @return EdgeListVector
	 */
	public function toVector() : EdgeListVector
	{
		return $this->edgeListData;
	}

	/**
	 * Throw an exception if the edge is not the proper format for the edge list.
	 *
	 * @param  Vector $edge
	 */
	protected function throwIfEdgeIsTheWrongFormat(Vector $edge)
	{
		if ($edge->count() === 3 && $this->listType === static::NOT_WEIGHTED) {
			$this->throwEdgeIsWeightedException();
		}

		if ($edge->count() === 2 && $this->listType === static::WEIGHTED) {
			$this->throwEdgeIsNotWeightedException();
		}
	}

	/**
	 * @throws EdgeListEdgeIsWeightedException
	 */
	protected function throwEdgeIsWeightedException()
	{
		throw new EdgeListEdgeIsWeightedException();
	}

	/**
	 * @throws EdgeListEdgeIsNotWeightedException
	 */
	protected function throwEdgeIsNotWeightedException()
	{
		throw new EdgeListEdgeIsNotWeightedException();
	}

	/**
	 * Throw an exception if the edge list is not empty.
	 *
	 * @throws EdgeListNotEmptyException
	 */
	protected function throwIfListNotEmpty()
	{
		if ($this->edgeListData->isEmpty() === false) {
			throw new EdgeListNotEmptyException();
		}
	}
}
