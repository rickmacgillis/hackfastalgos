<?HH
/**
 * Hack Fast Algos
 *
 * Implementations of various shortest path algorithms
 * Learn more
 */

use \HackFastAlgos\DataStructure as DataStructure;

namespace HackFastAlgos;

class ShortestPathHasNegativeedgeLengthsException extends \Exception{}

type Node = int;
type ShortestPath = Vector<shape (

	'distance'		=> Vector<int>,
	'predecessor'	=> Vector<(int,int)>

)>;

class ShortestPath
{
	public function __construct(private DataStructure\AdjList $adjList) {}

	public function findDijkstrasShortestPath(Node $sourceNode) : ShortestPath
	{
		// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
		// http://algs4.cs.princeton.edu/44sp/DijkstraSP.java.html
		// Mention that Dijkstra's algorithm uses BFS
		// If the list contains a negative length...
			throw new ShortestPathHasNegativeedgeLengthsException();
	}

	public function findBellmanFordShortestPath(Vector<int> $vertices, Node $sourceNode, int $maxEdges = 0) : ShortestPath
	{
		// https://en.wikipedia.org/wiki/Bellman%E2%80%93Ford_algorithm
		// http://algs4.cs.princeton.edu/44sp/BellmanFordSP.java.html
		// Negative edge length safe
		// If there's a negative edge loop, throw an exception.
		// If $maxEdges is not 0, then limit the number of edges the algorithm traverses to find the shortest path.
	}

	public function findFloydWarshallAPSP()
	{
		// https://en.wikipedia.org/wiki/Floyd%E2%80%93Warshall_algorithm
		// http://algs4.cs.princeton.edu/44sp/FloydWarshall.java.html
		// Returns a Shortest Path Tree https://en.wikipedia.org/wiki/Shortest-path_tree
	}

	public function findJohnsonsAPSP()
	{
		// https://en.wikipedia.org/wiki/Johnson%27s_algorithm
		// Returns a Shortest Path Tree https://en.wikipedia.org/wiki/Shortest-path_tree
	}

	public function criticalPathMethod()
	{
		// http://algs4.cs.princeton.edu/44sp/CPM.java.html
	}

	public function acyclicShortestPath(int $multiplier = 1)
	{
		// http://algs4.cs.princeton.edu/44sp/AcyclicSP.java.html
	}

	public function acyclicLongestPath()
	{
		// http://algs4.cs.princeton.edu/44sp/AcyclicLP.java.html
		// Negate the edge weights to get the longest path.
		return $this->acyclicShortestPath(-1);
	}
}
