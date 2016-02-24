<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of DFS and other algorithms based on DFS
 *
 * Learn more
 * @link http://algs4.cs.princeton.edu/41graph/CC.java.html
 * @link https://en.wikipedia.org/wiki/Depth-first_search
 * @link http://algs4.cs.princeton.edu/41graph/DepthFirstPaths.java.html
 * @link https://en.wikipedia.org/wiki/Kosaraju%27s_algorithm
 * @link http://algs4.cs.princeton.edu/42digraph/KosarajuSharirSCC.java.html
 */

namespace HackFastAlgos;

class DFSNoPathExistsException extends \Exception{}
class DFSVertexDoesNotExistException extends \Exception{}
class DFSGraphHasCyclesException extends \Exception{}

type AdjList = Map<int, Vector<int>>;
type EdgeList = Map<int, int>;

class DFS
{
	private Map<int, bool> $visited = Map{};
	private EdgeList $edgeList = Map{};
	private Map<int, int> $componentIds = Map{};
	private Map<int, int> $componentSizes = Map{};
	private Map<int, bool> $vertexColors = Map{};
	private int $totalComponents = 0;
	private bool $hasCycles = false;
	private bool $isBipartite = true;

	public function __construct(private AdjList $adjList, private int $source)
	{
		$this->postOrder = new DataStructure\Queue();
	}

	public function resetDFSForSource(int $source)
	{
		$this->resetDFS();
		$this->source = $source;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	public function search(?int $source = null, int $componentId = 0)
	{
		$source = $source === null ? $this->source: $source;
		$this->visited[$source] = true;

		$this->incrementComponentSizeForId($componentId);
		$this->componentIds[$source] = $componentId;
		
		if ($this->adjList->containsKey($source) === false) {
			return;
		}

		foreach ($this->adjList[$source] as $adjVertex) {

			if ($this->visited->containsKey($adjVertex) === false) {

				$this->edgeList[$adjVertex] = $source;
				$this->vertexColors[$adjVertex] = !$this->getVertexColor($source);
				$this->search($adjVertex, $componentId);

			} else {

				$this->setHasCyclesIfDifferentEdgeSourceInList($adjVertex, $source);
				$this->setNotBipartiteIfColorsAreTheSame($adjVertex, $source);

			}

		}
	}

	public function getEdgeList() : EdgeList
	{
		return $this->edgeList;
	}

	public function hasPath(int $destination) : bool
	{
		return $this->visited->containsKey($destination) || $destination === $this->source;
	}

	/**
	 * Operates in Theta(e) time where e is the number of edges conncting $start to $finish.
	 */
	public function getPath(int $start, int $finish) : DataStructure\Stack
	{
		$this->throwIfNoPathExists($start, $finish);

		$stack = new DataStructure\Stack();
		for ($node = $finish; $node !== $start; $node = $this->edgeList[$node]) {
			$stack->push($node);
		}

		$stack->push($start);
		return $stack;
	}

	public function countComponents()
	{
		$this->resetDFS();

		$componentId = 0;
		foreach ($this->adjList as $node => $adjNodes) {

			if ($this->visited->containsKey($node) === false) {
				$this->search($node, $componentId++);
			}

		}

		$this->totalComponents = $componentId;
	}

	public function getComponentSizeFromVertex(int $vertex) : int
	{
		$this->throwIfVertexIsNotInComponentIdList($vertex);
		$componentId = $this->componentIds[$vertex];
		return $this->componentSizes[$componentId];
	}

	public function getTotalComponents() : int
	{
		return $this->totalComponents;
	}

	public function isConnectedTo(int $vertexA, int $vertexB) : bool
	{
		$this->throwIfVertexIsNotInComponentIdList($vertexA);
		$this->throwIfVertexIsNotInComponentIdList($vertexB);

		return $this->componentIds[$vertexA] === $this->componentIds[$vertexB];
	}

	public function hasCycles() : bool
	{
		return $this->hasCycles;
	}

	public function isBipartite() : bool
	{
		return $this->isBipartite;
	}

	public function topSort(AdjList $adjList, Node $sourceNode) : Vector<Node>
	{
		$this->throwIfHasCycles();

		// https://en.wikipedia.org/wiki/Topological_sorting
	}

	private function resetDFS()
	{
		$this->visited = Map{};
		$this->edgeList = Map{};
		$this->componentIds = Map{};
		$this->componentSizes = Map{};
		$this->vertexColors = Map{};
	}

	private function incrementComponentSizeForId(int $componentId)
	{
		if ($this->componentSizes->containsKey($componentId) === false) {
			$this->componentSizes[$componentId] = 0;
		}

		$this->componentSizes[$componentId]++;
	}

	private function getVertexColor(int $vertex) : bool
	{
		if ($this->vertexColors->containsKey($vertex)) {
			return $this->vertexColors[$vertex];
		}

		return true;
	}

	private function setHasCyclesIfDifferentEdgeSourceInList(int $vertex, int $currentSource)
	{
		if ($this->edgeList->containsKey($vertex) === false || $this->edgeList[$vertex] !== $currentSource) {
			$this->hasCycles = true;
		}
	}

	private function setNotBipartiteIfColorsAreTheSame(int $vertexA, int $vertexB)
	{
		if ($this->getVertexColor($vertexA) === $this->getVertexColor($vertexB)) {
			$this->isBipartite = false;
		}
	}

	private function throwIfNoPathExists(int $start, int $finish)
	{
		if ($this->hasPath($start) === false || $this->hasPath($finish) === false) {
			throw new DFSNoPathExistsException();
		}
	}

	private function throwIfVertexIsNotInComponentIdList(int $vertex)
	{
		if ($this->componentIds->containsKey($vertex) === false) {
			throw new DFSVertexDoesNotExistException($vertex);
		}
	}

	private function throwIfHasCycles()
	{
		if ($this->hasCycles()) {
			throw new DFSGraphHasCyclesException();
		}
	}
}
