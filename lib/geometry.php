<?HH
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various graph algorithms optimized for speed.
 */

namespace HackFastAlgos;

class GeometryException extends \Exception{}

type HFAEdgeList	= Map<int,Vector<int>>;
type HFAAdjList<T>	= Map<int,T>;
type HFAMatrix		= Map<int,Vector<int>>;

class Geometry
{	
	public const SORT_NONE		= 0;
	public const SORT_VERTEX	= 1;
	public const SORT_WEIGHTS	= 2;
	
	public static function matrixTransform(HFAMatrix $matrix, int $degrees = 90, $flip = false) : HFAMatrix
	{
		switch ($degrees) {
			
			case 0:
				if (true === $flip) {
					
				}
				
				throw new GeometryException('To flip a matrix, set the third parameter to boolean true.', 1);
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
		
	}
	
	public static function closestPoints(Map<int,Pair<int,int>> &$pairs, ?int $start = null, ?int $length = null)
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
		/**
		 * Karger-Stein
		 * 
		 * Page 37: http://mypages.iit.edu/~hjin15/talks/MATH565Pre.pdf
		 */
	}
}
