<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of various algorithms using Breadth-First Search
 *
 * Learn more
 * @link http://algs4.cs.princeton.edu/41graph/BreadthFirstPaths.java.html
 * @link https://en.wikipedia.org/wiki/Breadth-first_search
 */

class BFS
{
	public function __construct(private AdjList $adjList){}

	public function singleSource(int $source)
	{

	}

	public function sources(Vector<int> $sources)
	{

	}

	public function hasPath(int $start, int $finish) : bool
	{

	}

	public function getPath(int $start, int $finish) : int
	{

	}

	public function distance(int $start, int $finish) : int
	{

	}

	public static function findBfsShortestPath(AdjList $adjList, int $sourceNode, int $findNode) : ShortestPath
	{
		// When we can't find a path, throw an exception.
		// https://en.wikipedia.org/wiki/Breadth-first_search
		if ($adjList[0]->count() > 2) {
			throw new GraphHasEdgeLengthsException();
		}
	}
}
