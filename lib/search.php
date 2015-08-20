<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various search algorithms optimized for speed.
 */

namespace HackFastAlgos;

type HFABfsDynamics	= shape (
	
	'distance'		=> int,
	'predecessor'	=> int
	
);

type HFAAdjList<T>	= Map<int,T>;
type HFABfs			= Map<int, HFABfsDynamics>;

class Search
{
	public static function binarySearch<T>(Map<int,T> $subject, T $find) : int
	{
		
	}
	
	public static function bruteForceSearch<T>(Map<int,T> $subject, T $find) : int
	{
		
	}
	
	public static function bfsSearch(HFAAdjList<T> $adjList) : HFABfs
	{
		
	}
}
