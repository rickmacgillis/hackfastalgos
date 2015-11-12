<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Koraraju's Strongly Connected Components
 *
 * Learn more
 * @link https://en.wikipedia.org/wiki/Kosaraju%27s_algorithm
 * @link http://algs4.cs.princeton.edu/42digraph/KosarajuSharirSCC.java.html
 */

namespace HackFastAlgos;

type AdjList = Map<int, Vector<int>>;

class Kosaraju
{
	private ?DataStructure\Queue $postOrder = null;
	private Map<int, int> $postOrderCounter = Map{};
	private int $totalScc = 0;
	private Map<int, int> $sccSizes = Map{};

	public function __construct(private AdjList $adjList, private int $source){}

	public function run()
	{
		$reversed = $this->reverseGraph();
		$reversePostOrder = $this->getReversePostOrder($reversed);

		while ($reversePostOrder->count() > 0) {

			$node = $reversePostOrder->pop();
			if ($this->visited->containsKey($node) === false) {

				$this->search($this->adjList, $node);
				$this->totalScc++;

			}

		}
	}

	public function getTotalScc() : int
	{
		return $this->totalScc;
	}

	private function dfs(AdjList $graph, int $source)
	{
		// Finish me.

		$this->sccSizes[$source] = $this->totalScc;

		// Algo
		
		$this->postOrder->enqueue($source);
		$this->incrementPostorderCounterForVertex($source);
	}

	private function incrementPostorderCounterForVertex(int $vertex)
	{
		if ($this->postOrderCounter->containsKey($vertex) === false) {
			$this->postOrderCounter[$vertex] = 0;
		}

		$this->postOrderCounter[$vertex]++;
	}

	private function reverseGraph() : AdjList
	{
		$reversed = Map{};
		foreach ($this->adjList as $node => $adjVertexVector) {

			foreach ($adjVertexVector as $adjVertex) {

				if ($reversed->containsKey($adjVertex) === false) {
					$reversed[$adjVertex] = Vector{};
				}

				$reversed[$adjVertex][] = $node;

			}

		}

		return $reversed;
	}

	private function getReversePostOrder(AdjList $reversed) : DataStructure\Stack
	{
		$dfs = $this->dfs($reversed, $this->source);
		$postOrder = $dfs->getPostOrder();

		$stack = new DataStructure\Stack();
		while ($this->postOrder->count() > 0) {
			$stack->push($this->postOrder->dequeue());
		}

		return $stack;
	}
}
