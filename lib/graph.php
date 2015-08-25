<?HH
/** Copyright 2015 Rick Mac Gillis
 *
 * Implements various graph algorithms optimized for speed.
 */

namespace HackFastAlgos;

class GraphException extends \Exception{}

type HFAEdgeList	= Vector<Vector<int>>;
type HFAAdjList<T>	= Vector<T>;
type HFAMatrix		= Vector<Vector<int>>;
type HFANode		= int;

type HFAShortestPath	= Vector<shape (
	
	'distance'		=> int,
	'predecessor'	=> (int,int)
	
)>;

class Graph
{	
	/**
	 * Don't sort the resulting graph
	 * @var int SORT_NONE = 0
	 */
	public const SORT_NONE		= 0;
	
	/**
	 * Sort the resulting graph by its vertices (low to high)
	 * @var int SORT_VERTEX = 1
	 */
	public const SORT_VERTEX	= 1;
	
	/**
	 * Sort the resulting graph by its weights (low to high)
	 * @var int SORT_WEIGHTS = 2
	 */
	public const SORT_WEIGHTS	= 2;
	
	public static function matrixTransform(HFAMatrix $matrix, int $degrees = 90, $flip = false) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Transformation_matrix
		switch ($degrees) {
			
			case 0:
				if (true === $flip) {
					
				}
				
				throw new GraphException('To flip a matrix, set the third parameter to boolean true.', 1);
				break;
			
			case 180:
				break;
				
			case 270:
				// No break
			case -90:
				break;
			
			case 90:
				// No break
			default:
				break;
				
		}
	}
	
	/**
	 * Convert an edge list to an adjacency list.
	 * 
	 * Possible forms:
	 * [[vertexU, vertexV],[vertexU, vertexV], ...]
	 * [[vertexU, vertexV, weight],[vertexU, vertexV, weight], ...]
	 * 
	 * For weighted edge lists, the adjacency list will have your adjacent vertex list
	 * as an array in the following form.
	 * 
	 * [vertex][[vertex, weight], [vertex, weight], ...]
	 * [vertex][[vertex, weight], ...]
	 * [vertex][[vertex, weight], ...]
	 * ...
	 * 
	 * Non-weighted edge lists will return an adjacency list in the form of
	 * [vertex][vertex, vertex, vertex, ...]
	 * [vertex][vertex, vertex, ...]
	 * [vertex][vertex, vertex, vertex, ...]
	 * 
	 * Learn more @link https://en.wikipedia.org/wiki/Adjacency_list
	 * 
	 * @param Map<int,Vector<int>> $edges	The edge list array map
	 * @param int $sortMode					One of these: Graph::SORT_NONE (default), Graph::SORT_VERTEX, Graph::SORT_WEIGHTS
	 * @param callable $sortCallback		If you require a specific sorting algorithm, you may set one here. If
	 * 										you don't pass a callback or the callback does not exist, it will default to
	 * 										@see \PHPFastAlgos\Sort\IntelligentSort(). 
	 * 
	 * @return Map<int,Map> The adjacency list
	 */
	public static function edgeListToAdjList<T>(
		HFAEdgeList $edges,
		int $sortMode = static::SORT_NONE,
		?callable $sortCallback = null
	) : HFAAdjList<T>
	{
		
	}
	
	/**
	 * Convert an edge list to an adjacency matrix.
	 * 
	 * In the event of a weighted edge list, the matrix will use the weights to signify the edge, and null to
	 * signify that no edge exists. If the edge list is not weighted, then the adjacency matrix will use 1 for
	 * a connection and 0 for no connection.
	 * 
	 * Weighted matrix:
	 * [
	 * 	[3,    null, 4,    88, 0],
	 * 	[null, 4,    null, 20, 1],
	 * 	...
	 * ]
	 * 
	 * Matrix without weights
	 * 
	 * [
	 * 	[0, 1, 0, 0, 1, 1],
	 * 	[1, 1, 0, 1, 1, 0],
	 * 	...
	 * ]
	 * 
	 * Learn more @link https://en.wikipedia.org/wiki/Adjacency_matrix
	 * 
	 * @param Map<int,Vector<int>> $edges	The edge list @see \PHPFastAlgos\Graph\edgeListToAdjList() for valid
	 * 								edge list formats.
	 * 
	 * @return Map<int,Vector<int>> The Adjacency Matrix
	 */
	public static function edgeListToAdjMatrix(HFAEdgeList $edges) : HFAMatrix
	{
		
	}
	
	public static function adjMatrixToEdgeList(
		HFAMatrix $matrix,
		int $sortMode = static::SORT_NONE,
		?callable $sortCallback = null
	) : HFAEdgeList
	{
		
	}
	
	public static function adjMatrixToAdjList<T>(
		HFAMatrix $matrix,
		int $sortMode = static::SORT_NONE,
		?callable $sortCallback = null
	) : HFAAdjList<T>
	{
		
	}
	
	public static function adjListToEdgeList<T>(
		HFAAdjList<T> $list,
		int $sortMode = static::SORT_NONE,
		?callable $sortCallback = null
	) : HFAEdgeList
	{
		
	}
	
	public static function adjListToAdjMatrix<T>(HFAAdjList<T> $list) : HFAMatrix
	{
		
	}
	
	public static function strassenMatrixMult(HFAMatrix $matrix1, HFAMatrix $matrix2) : HFAMatrix
	{
		// https://en.wikipedia.org/wiki/Strassen_algorithm
	}
	
	public static function closestPoints(Vector<Pair<int,int>> $pairs, ?int $start = null, ?int $length = null)
	{
		// https://en.wikipedia.org/wiki/Closest_pair_of_points_problem
		if (empty($start) || empty($length)) {
			
			$start = 0;
			$length = count($pairs);
			
		}
		
		// BASE CASE NEEDED
		
		$mid = floor(($start+$length)/2);
		
		static::closestPoints($pairs, $start, $mid);
		static::closestPoints($pairs, $mid+1, $length);
		
		//$delta = null;
		//static::closestSplitPoints($pairs, $delta);
	}
	
	public static function minCut(HFAAdjList<T> $adjList) : int
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
	
	public static function bfsShortestPath(
		HFAAdjList<T> $adjList,
		HFANode $sourceNode,
		HFANode $findNode,
		bool &$notConnected = false
	) : HFAShortestPath
	{
		// $notConnected is true when we can't find a path. HFABfs is 0 for both
		// https://en.wikipedia.org/wiki/Breadth-first_search
		if ($adjList[0]->count() > 2) {
			throw new GraphException('The BFS shortest path method does not account for edge lengths. '.
									 'Use dijkstrasShortestPath instead.');
		}
	}
	
	public static function dijkstrasShortestPath(HFAAdjList $adjList, HFANode $sourceNode) : HFAShortestPath
	{
		// https://en.wikipedia.org/wiki/Dijkstra%27s_algorithm
		// Mention that Dijkstra's algorithm uses BFS
		// If the list contains a negative length...
			throw new GraphException('Dijkstra\'s algorithm does not work with negative edge lengths. '.
									 'Use bellmanFordShortestPath instead.');
	}
	
	public static function bellmanFordShortestPath(
		Vector<int> $vertices,
		HFAEdgeList $edgeList,
		HFANode $sourceNode
	) : HFAShortestPath
	{
		// https://en.wikipedia.org/wiki/Bellman%E2%80%93Ford_algorithm
		// Negative edge length safe
	}
	
	public static function dfsTopSort(HFAAdjList<T> $adjList, HFANode $sourceNode) : Vector<HFANode>
	{
		// https://en.wikipedia.org/wiki/Depth-first_search
		// https://en.wikipedia.org/wiki/Topological_sorting
	}
	
	public static function kosarajuSCC(HFAAdjList<T> $adjList, HFANode $sourceNode) : Vector<HFANode>
	{
		// https://en.wikipedia.org/wiki/Kosaraju%27s_algorithm
		// Returns an array of leader nodes
	}
}
