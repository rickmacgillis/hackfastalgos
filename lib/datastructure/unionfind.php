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
		if (!empty($this->unionFindData[$item])) {
			throw new UnionFindException('Node '.$item.' already exists in a set.');
		}
		
		$this->unionFindData[$item] = Vector{$item, 0};
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
		if (empty($this->unionFindData[$item])) {
			throw new UnionFindException('The item '.$item.' does not exist.');
		}
		
		// Find its parent. Prevent tall trees so we don't have to recurse every time.
		$parent = $this->unionFindData[$item][0];
		if ($parent !== $item) {
			$parent = $this->unionFindData[$item][0] = $this->find($parent);
		}
		
		return $parent;
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
		if ($this->unionFindData[$root1][1] > $this->unionFindData[$root2][1]) {
			
			$this->unionFindData[$root2][0] = $root1;
			
		} else if ($this->unionFindData[$root1][1] < $this->unionFindData[$root2][1]) {
			
			$this->unionFindData[$root1][0] = $root2;
			
		} else {
			
			/*
			 * Both trees are of equal size, so we'll bump one of the trees up a rank so we
			 * can store the other tree under it.
			 */
			$this->unionFindData[$root1][1]++;
			$this->unionFindData[$root2][0] = $root1;
			
		}
	}
}
