<?HH
/**
 * Hack Fast Algos
 *
 * Implements various graph algorithms optimized for speed.
 */

use HackFastAlgos\DataStructure as DataStructure;

namespace HackFastAlgos;

class Graph
{
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
}
