<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Union-Find data structure (Also called Disjoint-Set or Merge-Find)
 * Lean more @link https://en.wikipedia.org/wiki/Disjoint-set_data_structure
 */

namespace HackFastAlgos\DataStructure;

class UnionFindItemExistsException extends \Exception{}
class UnionFindItemDoesNotExistException extends \Exception{}

class UnionFind
{
	private Map<int, Vector<int>> $unionFindData = Map{};
	private int $totalSets = 0;

	/**
	 * Operates in Theta(1) time.
	 */
	public function makeSet(int $item)
	{
		if ($this->itemExists($item)) {
			throw new UnionFindItemExistsException($item);
		}

		$this->setItemData($item, $item, 0);
		$this->totalSets++;
	}

	/**
	 * Operates in O(log n) time.
	 */
	public function find(int $item) : int
	{
		if (!$this->itemExists($item)) {
			throw new UnionFindItemDoesNotExistException($item);
		}

		// Find its parent. Prevent tall trees so we don't have to recurse every time.
		$parent = $this->getParent($item);
		if ($parent !== $item) {

			$this->setParent($item, $parent);
			$parent = $this->getParent($item);

		}

		return $parent;
	}

	public function isConnected(int $item1, int $item2) : bool
	{
		try {
			$item1Leader = $this->find($item1);
			$item2Leader = $this->find($item2);
		} catch (UnionFindItemDoesNotExistException $e) {
			return false;
		}

		if ($item1Leader === $item2Leader) {
			return true;
		}

		return false;
	}

	public function countSets() : int
	{
		return $this->totalSets;
	}

	/**
	 * Operates in O(log n) time as it relies on find().
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

		$this->totalSets--;
	}

	private function setItemData(int $item, int $parent, int $rank)
	{
		$this->unionFindData[$item] = Vector{$parent, $rank};
	}

	private function itemExists(int $item) : bool
	{
		return $this->unionFindData->containsKey($item);
	}

	private function getParent(int $item) : int
	{
		return $this->unionFindData[$item][0];
	}

	private function setParent(int $item, int $parent)
	{
		$this->unionFindData[$item][0] = $this->find($parent);
	}

	private function getRank(int $item) : int
	{
		return $this->unionFindData[$item][1];
	}

	private function setRank(int $item, int $rank)
	{
		$this->unionFindData[$item][1] = $rank;
	}
}
