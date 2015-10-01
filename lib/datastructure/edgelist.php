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
class EdgeListNotWeightedListException extends \Exception{}

class EdgeList implements \HackFastAlgos\Interfaces\GraphFormat
{

	/**
	 * Weighted edge list:
	 * [[vertexU, vertexV, weight],[vertexU, vertexV, weight], ...]
	 *
	 * Non-weighted edge list:
	 * [[vertexU, vertexV],[vertexU, vertexV], ...]
	 */

	private EdgeListVector $edgeListData = Vector{};
	private ?PriorityQueue $edgeQueue = null;

	public function __construct(protected int $listType = static::NOT_WEIGHTED){
		$this->edgeQueue = new PriorityQueue();
	}

	/**
	 * Operates in O(E) time where E is the number of edges.
	 * At its best it operates in Omega(1) time.
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

	public function isWeighted() : bool
	{
		return $this->listType === static::WEIGHTED;
	}

	public function insertEdge(Vector $edge)
	{
		$this->throwIfEdgeIsTheWrongFormat($edge);
		$this->edgeListData[] = $edge;
	}

	public function fromVector(EdgeListVector $edgeList)
	{
		$this->throwIfListNotEmpty();
		$this->edgeListData = $edgeList;
	}

	public function toVector() : EdgeListVector
	{
		return $this->edgeListData;
	}

	/**
	 * Operates in Theta(n log n) time.
	 */
	public function sortByVertex()
	{
		// Heap sort is not stable, so we cannot multisort by the second vertex this way.
		$this->queueEdgesByPriorityIndex(0);
		$this->queueToEdgeList();
	}

	/**
	 * Operates in Theta(n log n) time.
	 */
	public function sortByWeights()
	{
		$this->throwExceptionIfNotWeightedList();
		$this->queueEdgesByPriorityIndex(2);
		$this->queueToEdgeList();
	}

	protected function throwIfEdgeIsTheWrongFormat(Vector $edge)
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
		throw new EdgeListEdgeIsWeightedException();
	}

	protected function throwEdgeIsNotWeightedException()
	{
		throw new EdgeListEdgeIsNotWeightedException();
	}

	protected function throwIfListNotEmpty()
	{
		if ($this->edgeListData->isEmpty() === false) {
			throw new EdgeListNotEmptyException();
		}
	}

	/**
	 * Operates in O(E log n) or Omega(E) time.
	 */
	protected function queueEdgesByPriorityIndex(int $priorityIndex)
	{
		$edgeCount = $this->edgeListData->count();
		for ($i = 0; $i < $edgeCount; $i++) {
			$edge = $this->edgeListData[$i];
			$this->edgeQueue->enqueue($edge, -$edge[$priorityIndex]);
		}
	}

	/**
	 * Operates in O(E log n) or Omega(E) time.
	 */
	protected function queueToEdgeList()
	{
		$numEdges = $this->edgeQueue->count();
		$this->edgeListData = Vector{};
		for ($i = 0; $i < $numEdges; $i++) {
			$this->insertEdge($this->edgeQueue->dequeue());
		}
	}

	protected function throwExceptionIfNotWeightedList()
	{
		if ($this->isWeighted() === false) {
			throw new EdgeListNotWeightedListException();
		}
	}
}
