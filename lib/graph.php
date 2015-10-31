<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various graph algorithms optimized for speed.
 */

use HackFastAlgos\DataStructure as DataStructure;

namespace HackFastAlgos;

class GraphHasEdgeLengthsException extends \Exception{}
class GraphHasNegativeedgeLengthsException extends \Exception{}

type Node = int;
type ShortestPath = Vector<shape (

	'distance'			=> Vector<int>,
	'predecessor'		=> Vector<(int,int)>

)>;

class Graph
{
	public static function transformMatrix180(AdjMatrix $matrix) : AdjMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function transformMatrix270(AdjMatrix $matrix) : AdjMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function transformMatrix90(AdjMatrix $matrix) : AdjMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function transformMatrixNeg90(AdjMatrix $matrix) : AdjMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function flipMatrixHorizontally(AdjMatrix $matrix) : AdjMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
	}

	public static function flipMatrixVertically(AdjMatrix $matrix) : AdjMatrix
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

	public static function numberOfMinCuts(AdjList $adjList) : int
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

	public static function findDijkstrasShortestPath(AdjList $adjList, Node $sourceNode) : ShortestPath
	{
		// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
		// Mention that Dijkstra's algorithm uses BFS
		// If the list contains a negative length...
			throw new GraphHasNegativeedgeLengthsException();
	}

	public static function findBellmanFordShortestPath(
		Vector<int> $vertices,
		EdgeList $edgeList,
		Node $sourceNode,
		int $maxEdges = 0
	) : ShortestPath
	{
		// https://en.wikipedia.org/wiki/Bellman%E2%80%93Ford_algorithm
		// Negative edge length safe
		// If there's a negative edge loop, throw an exception.
		// If $maxEdges is not 0, then limit the number of edges the algorithm traverses to find the shortest path.
	}

	public static function findFloydWarshallAPSP(AdjList $adjList)
	{
		// https://en.wikipedia.org/wiki/Floyd%E2%80%93Warshall_algorithm
		// Returns a Shortest Path Tree https://en.wikipedia.org/wiki/Shortest-path_tree
	}

	public static function findJohnsonsAPSP(AdjList $adjList)
	{
		// https://en.wikipedia.org/wiki/Johnson%27s_algorithm
		// Returns a Shortest Path Tree https://en.wikipedia.org/wiki/Shortest-path_tree
	}

	public static function findPrimMST(AdjList $adjList) : int
	{
		// https://en.wikipedia.org/wiki/Prim%27s_algorithm
		// Use a heap.
		// Accepts a connected undirected graph with different edge weights.
		// Returns the minimum possible total edge weights when connecting vertexes spanning the full tree. (MST)
	}

	public static function findKruskalMST(AdjList $adjList) : int
	{
		// https://en.wikipedia.org/wiki/Kruskal%27s_algorithm
		// Use Union-Find
	}

	public static function makeSingleLinkCluster(AdjList $adjList) : AdjList
	{
		// Use Kruskal's MST
		// @TODO What format does it return?
		// https://en.wikipedia.org/wiki/Single-linkage_clustering
	}

	public static function getVertexCover(AdjList $adjList) : AdjList
	{
		// https://en.wikipedia.org/wiki/Vertex_cover
	}

	public static function maxCuts(AdjList $adjList) : int
	{
		// https://en.wikipedia.org/wiki/Maximum_cut
		// Papadimitriou's algorithm
	}

	public static function maxFlow()
	{
		// https://en.wikipedia.org/wiki/Ford%E2%80%93Fulkerson_algorithm
	}
}
