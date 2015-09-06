<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implementation of a Union-Find data structure (Also called Disjoint-Set or Merge-Find)
 * Lean more @link https://en.wikipedia.org/wiki/Disjoint-set_data_structure
 */

namespace HackFastAlgos\DataStructure;

class UnionFindException extends \Exception{}

class UnionFind
{
	/**
	 * Union Find contents
	 * @var Map<int, Vector<int>> $unionFindData
	 */
	protected Map<int, Vector<int>> $unionFindData = Map{};

	/**
	 * The number of connected components
	 * @type int
	 */
	protected int $totalComponents = 0;

	/**
	 * Add a disjointed set of one item to the data structure. If the existing node
	 * ($item) exists, it will throw an exception. If you overwrite a leader node,
	 * its children will be attached to the new disjoint set with the leader node set
	 * to rank 0. Thus, the tree will be out of balance since its children will have
	 * a higher rank than the leader node.
	 *
	 * Use union() to add it to a new set.
	 *
	 * Operates in Theta(1) time.
	 *
	 * @param int $item The item to add to its own set.
	 */
	public function makeSet(int $item)
	{
		if ($this->itemExists($item)) {
			throw new UnionFindException('Node '.$item.' already exists in a set.');
		}

		$this->setItemData($item, $item, 0);
		$this->totalComponents++;
	}

	/**
	 * Find the leader node for the set. This method also speeds up further calls
	 * to find the leader node through path compression.
	 *
	 * Operates in O(log n) time.
	 *
	 * @param int $item The item for which to find the leader node
	 *
	 * @return int The leader node
	 */
	public function find(int $item) : int
	{
		if (!$this->itemExists($item)) {
			throw new UnionFindException('The item '.$item.' does not exist.');
		}

		// Find its parent. Prevent tall trees so we don't have to recurse every time.
		$parent = $this->getParent($item);
		if ($parent !== $item) {

			$this->setParent($item, $parent);
			$parent = $this->getParent($item);

		}

		return $parent;
	}

	/**
	 * Check if two items are connected to each other.
	 *
	 * @param  int $item1	The first item to find
	 * @param  int $item2	The second item to find
	 *
	 * @return bool True if they're connected, false if they aren't or one of
	 *              the items does not exist.
	 */
	public function isConnected(int $item1, int $item2) : bool
	{
		try {
			$item1Leader = $this->find($item1);
			$item2Leader = $this->find($item2);
		} catch (UnionFindException $e) {
			return false;
		}

		if ($item1Leader === $item2Leader) {
			return true;
		}

		return false;
	}

	/**
	 * Return the number of connected components
	 *
	 * @return int
	 */
	public function countComponents() : int
	{
		return $this->totalComponents;
	}

	/**
	 * Combine two disjointed sets into one. We use rank to decide which leader node to use
	 * as the new set's leader node.
	 *
	 * Operates in O(log n) time as it relies on find().
	 *
	 * @param int $item1	Any item from the first set.
	 * @param int $item2	Any item from the second set.
	 */
	public function union(int $item1, int $item2)
	{
		$root1 = $this->find($item1);
		$root2 = $this->find($item2);

		// Compare the rank. Make the shorter tree/set the child of the taller tree.
		if ($this->getRank($root1) > $this->getRank($root2)) {

			$this->setParent($root2, $root1);

		} else if ($this->getRank($root1) < $this->getRank($root2)) {

			$this->setParent($root1, $root2);

		} else {

			/*
			 * Both trees are of equal size, so we'll bump one of the trees up a rank so we
			 * can store the other tree under it.
			 */
			$this->setRank($root1, $this->getRank($root1) + 1);
			$this->setParent($root2, $root1);

		}

		$this->totalComponents--;
	}

	/**
	 * Set an item's data.
	 *
	 * @param  int $item	The item data
	 * @param  int $rank	The rank of the $item
	 */
	protected function setItemData(int $item, int $parent, int $rank)
	{
		$this->unionFindData[$item] = Vector{$parent, $rank};
	}

	/**
	 * Check if an item exists.
	 *
	 * @param  int $item	the item to locate
	 * @return bool	True if the item exists r false if it does not
	 */
	protected function itemExists(int $item) : bool
	{
		return $this->unionFindData->containsKey($item);
	}

	/**
	 * Get the parent node for an item.
	 * @param  int $item	The item for which to locate its parent
	 * @return int	The parent of the $item
	 */
	protected function getParent(int $item) : int
	{
		return $this->unionFindData[$item][0];
	}

	/**
	 * Set the parent for an item
	 * @param int $item		The item for which to set its parent
	 * @param int $parent	The parent to set for the $item
	 */
	protected function setParent(int $item, int $parent)
	{
		$this->unionFindData[$item][0] = $this->find($parent);
	}

	/**
	 * Get the rank of an item.
	 * @param int $item		The item for which to get its rank
	 * @return int	The rank of the $item
	 */
	protected function getRank(int $item) : int
	{
		return $this->unionFindData[$item][1];
	}

	/**
	 * Set the rank of an item.
	 * @param int $item	The item for which to set its rank
	 * @param int $rank	The rank to set for the $item
	 */
	protected function setRank(int $item, int $rank)
	{
		$this->unionFindData[$item][1] = $rank;
	}
}
