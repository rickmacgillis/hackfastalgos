<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various search algorithms optimized for speed.
 */

namespace HackFastAlgos;

type HFAAdjList<T>	= Map<int,T>;
type HFABfsSP		= Vector<shape (
	
	'distance'		=> int,
	'predecessor'	=> (int,int)
	
)>;
type HFANode		= int;

class Search
{
	public static function binarySearch<T>(Map<int,T> $subject, T $find) : int
	{
		
	}
	
	public static function bruteForceSearch<T>(Map<int,T> $subject, T $find) : int
	{
		
	}
	
	public static function bfsShortestPath(HFAAdjList<T> $adjList, HFANode $startNode, HFANode $findNode, bool &$notConnected = false) : HFABfsSP
	{
		// $notConnected is true when we can't find a path. HFABfs is 0 for both
		// https://en.wikipedia.org/wiki/Breadth-first_search
	}
	
	public static function dfsTopSort(HFAAdjList<T> $adjList, HFANode $startNode) : Vector<HFANode>
	{
		// https://en.wikipedia.org/wiki/Depth-first_search
		// https://en.wikipedia.org/wiki/Topological_sorting
	}
	
	public static function dfsKosarajuSCC(HFAAdjList<T> $adjList, HFANode $startNode) : Vector<HFANode>
	{
		// https://en.wikipedia.org/wiki/Kosaraju%27s_algorithm
		// Returns an array of leader nodes
	}
}
