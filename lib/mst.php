<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of various MST algorithms
 * Learn more
 * @link https://en.wikipedia.org/wiki/Prim%27s_algorithm
 * @link http://algs4.cs.princeton.edu/43mst/LazyPrimMST.java.html
 * @link http://algs4.cs.princeton.edu/43mst/PrimMST.java.html
 * @link https://en.wikipedia.org/wiki/Kruskal%27s_algorithm
 * @link http://algs4.cs.princeton.edu/43mst/KruskalMST.java.html
 */

use \HackFastAlgos\DataStructure as DataStructure;

namespace HackFastAlgos;

class MST
{
	private ?DataStructure\AdjList $mstData = null;

	public function (private DataStructure\AdjList $adjList)
	{
		$this->mstData = new DataStructure\AdjList();
		$this->mstData->setWeighted();
	}

	public function findLazyPrimMST() : DataStructure\AdjList
	{

	}

	public function findEagerPrimMST() : DataStructure\AdjList
	{

	}

	public function findKruskalMST() : DataStructure\AdjList
	{

	}
}
