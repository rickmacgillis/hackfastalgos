<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various graph algorithms optimized for speed.
 */

namespace HackFastAlgos;

class GraphHasEdgeLengthsException extends \Exception{}
class GraphHasNegativeedgeLengthsException extends \Exception{}

type HFAEdgeList	= Vector<Vector<int>>;
type HFAAdjList<T>	= Vector<T>;
type HFAMatrix		= Vector<Vector<int>>;
type HFANode		= int;

type HFAShortestPath	= Vector<shape (

	'distance'			=> Vector<int>,
	'predecessor'		=> Vector<(int,int)>

)>;

class Graph
{
	public static function transformMatrix180(HFAMatrix $matrix) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function transformMatrix270(HFAMatrix $matrix) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function transformMatrix90(HFAMatrix $matrix) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function transformMatrixNeg90(HFAMatrix $matrix) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function flipMatrixHorizontally(HFAMatrix $matrix) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function flipMatrixVertically(HFAMatrix $matrix) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function findClosestPoints(Vector<Pair<int,int>> $pairs)
	{
		// https://en.wikipedia.org/wiki/Closest_pair_of_points_problem
		$start = 0;
		$length = count($pairs);

		// BASE CASE NEEDED

		$mid = floor(($start+$length)/2);

		static::closestPoints($pairs, $start, $mid);
		static::closestPoints($pairs, $mid+1, $length);

		//$delta = null;
		//static::closestSplitPoints($pairs, $delta);
	}

	public static function numberOfMinCuts(HFAAdjList<T> $adjList) : int
	{
		// https://gist.github.com/MastaP/2314166
		// https://en.wikipedia.org/wiki/Karger%27s_algorithm
		// https://github.com/jinhw1989/MinCutAlgo/blob/master/algo/MinCut.py
		/**
		 * Karger-Stein
		 *
		 * Page 37: http://mypages.iit.edu/~hjin15/talks/MATH565Pre.pdf
		 * @TODO Make it always reliable and faster with Mac Gillis' Algorithm?
		 */
	}

	public static function findBfsShortestPath(
		HFAAdjList<T> $adjList,
		HFANode $sourceNode,
		HFANode $findNode
	) : HFAShortestPath
	{
		// When we can't find a path, throw an exception.
		// https://en.wikipedia.org/wiki/Breadth-first_search
		if ($adjList[0]->count() > 2) {
			throw new GraphHasEdgeLengthsException();
		}
	}

	public static function findDijkstrasShortestPath(HFAAdjList $adjList, HFANode $sourceNode) : HFAShortestPath
	{
		// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
		// Mention that Dijkstra's algorithm uses BFS
		// If the list contains a negative length...
			throw new GraphHasNegativeedgeLengthsException();
	}

	public static function findBellmanFordShortestPath(
		Vector<int> $vertices,
		HFAEdgeList $edgeList,
		HFANode $sourceNode,
		int $maxEdges = 0
	) : HFAShortestPath
	{
		// https://en.wikipedia.org/wiki/Bellman%E2%80%93Ford_algorithm
		// Negative edge length safe
		// If there's a negative edge loop, throw an exception.
		// If $maxEdges is not 0, then limit the number of edges the algorithm traverses to find the shortest path.
	}

	public static function findFloydWarshallAPSP(HFAAdjList $adjList)
	{
		// https://en.wikipedia.org/wiki/Floyd%E2%80%93Warshall_algorithm
		// Returns a Shortest Path Tree https://en.wikipedia.org/wiki/Shortest-path_tree
	}

	public static function findJohnsonsAPSP(HFAAdjList $adjList)
	{
		// https://en.wikipedia.org/wiki/Johnson%27s_algorithm
		// Returns a Shortest Path Tree https://en.wikipedia.org/wiki/Shortest-path_tree
	}

	public static function runDfsTopSort(HFAAdjList<T> $adjList, HFANode $sourceNode) : Vector<HFANode>
	{
		// https://en.wikipedia.org/wiki/Depth-first_search
		// https://en.wikipedia.org/wiki/Topological_sorting
	}

	public static function findAllKosarajuSCC(HFAAdjList<T> $adjList, HFANode $sourceNode) : Vector<HFANode>
	{
		// https://en.wikipedia.org/wiki/Kosaraju%27s_algorithm
		// Returns an array of leader nodes
	}

	public static function findPrimMST(HFAAdjList $adjList) : int
	{
		// https://en.wikipedia.org/wiki/Prim%27s_algorithm
		// Use a heap.
		// Accepts a connected undirected graph with different edge weights.
		// Returns the minimum possible total edge weights when connecting vertexes spanning the full tree. (MST)
	}

	public static function findKruskalMST(HFAAdjList $adjList) : int
	{
		// https://en.wikipedia.org/wiki/Kruskal%27s_algorithm
		// Use Union-Find
	}

	public static function makeSingleLinkCluster(HFAAdjList $adjList) : HFAAdjList
	{
		// Use Kruskal's MST
		// @TODO What format does it return?
		// https://en.wikipedia.org/wiki/Single-linkage_clustering
	}

	public static function getVertexCover(HFAAdjList $adjList) : HFAAdjList
	{
		// https://en.wikipedia.org/wiki/Vertex_cover
	}

	public static function calculateTSP(HFAAdjList $adjList) : Vector<int>
	{
		// https://en.wikipedia.org/wiki/Travelling_salesman_problem
	}

	public static function maxCuts(HFAAdjList $adjList) : int
	{
		// https://en.wikipedia.org/wiki/Maximum_cut
		// Papadimitriou's algorithm
	}

	public static function maxFlow()
	{
		// https://en.wikipedia.org/wiki/Ford%E2%80%93Fulkerson_algorithm
	}
}
