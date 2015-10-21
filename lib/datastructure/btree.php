<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a B-Tree
 * Learn more @link https://en.wikipedia.org/wiki/B-tree
 */

namespace HackFastAlgos\DataStructure;

newtype TreeHeight = int;

class BTree extends BST
{
	private Vector<(T, TreeHeight, Relations)> $bstData = Vector{};

	public function select<T>(int $nthOrderstatistic) : T
	{
		// https://en.wikipedia.org/wiki/Order_statistic_tree
	}

	public function getRank<T>(T $item) : int
	{
		/*
		 * Return the position of the given $item (Not the key; it's the number
		 * of items we iterate over in order from least to greatest up to and
		 * including $item.)
		 */
	}
}
