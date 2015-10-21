<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Binary Search Tree (BST)
 * Learn more @link https://en.wikipedia.org/wiki/Binary_search_tree
 */

namespace HackFastAlgos\DataStructure;

class BSTItemNotFoundException extends \Exception{}

newtype BSTParent		= int;
newtype BSTLeftChild	= int;
newtype BSTRightChild	= int;
newtype Relations		= Vector<(?BSTParent, ?BSTLeftChild, ?BSTRightChild)>;

class BST implements \Countable, \Iterator
{
	private Vector<(T, Relations)> $bstData = Vector{};
	private int $iteratorPtr = 0;

	public function insert<T>(T $item)
	{
		if (!$this->bstData->containsKey(0)) {

			$relations = $this->makeRelations(null, null, null);
			$this->bstData[] = Vector{$item, $relations};

		} else {

			// Keep the tree statistics balanced.

		}
	}

	public function fromVector<T>(Vector<T> $vector)
	{
		foreach ($vector as $item) {
			$this->insert($item);
		}
	}

	public function delete<T>(T $item)
	{
		// Delete an item from the tree
	}

	public function getMin<T>() : T
	{
		$mindex = $this->getMinIndexStartingAt(0);
		return $mindex[0];
	}

	public function getMax<T>() : T
	{
		// Return the maximum value in the heap (Lowest right child)
	}

	public function itemExists<T>(T $item) : bool
	{
		try {
			$index = $this->getItemIndex($item);
			return true;
		} catch (BSTItemNotFoundException $e) {
			return false;
		}
	}

	public function rotateLeft(int $node)
	{
		// https://en.wikipedia.org/wiki/Tree_rotation
		// Swap $node with its right child.
	}

	public function rotateRight(int $node)
	{
		// https://en.wikipedia.org/wiki/Tree_rotation
		// Swap $node with its left child.
	}

	public function count() : int
	{
		return $this->bstData->count();
	}

	public function rewind()
	{
		$this->iteratorPtr = $this->getMinIndex();
	}

	public function current() : int
	{
		return $this->getItemAtIndex($this->iteratorPtr);
	}

	public function key() : int
	{
		return $this->iteratorPtr;
	}

	public function valid() : bool
	{
		return $this->bstData->containsKey($this->iteratorPtr);
	}

	public function next()
	{
		$originalPtr = $this->iteratorPtr;
		$this->useSmallestChild();

		if ($originalPtr === $this->iteratorPtr) {
			$this->useParent();
		}

		if ($originalPtr === $this->iteratorPtr) {
			$this->iterationPtr = -1;
		}
	}

	public function prev()
	{
		// Rewind to the last proper value.
	}

	private function makeRelations(?BSTParent $parent, ?BSTLeftChild $leftChild, ?BSTRightChild $rightChild) : array
	{
		return tuple($parent, $leftChild, $rightChild);
	}

	private function getMinIndexStartingAt(int $index) : int
	{
		while (($leftChild = $this->getLeftChild($index)) !== null) {
			$index = $leftChild;
		}

		return $index;
	}

	private function getItemAtIndex<T>(int $index) : T
	{
		return $this->bstData[$index][0];
	}

	private function getItemIndex<T>(T $item, ?int $startingIndex = 0) : ?int
	{
		if ($startingIndex === null) {
			$this->throwItemNotFoundException();
		}

		$candidateItem = $this->getItemAtIndex($startingIndex);
		switch ($this->compare($candidateItem, $item)) {

			case 0:
				return $startingIndex;

			case -1:
				return $this->getItemIndex($item, $this->getLeftChild());

			case 1:
				return $this->getItemIndex($item, $this->getRightChild());

		}
	}

	private function throwItemNotFoundException()
	{
		throw new BSTItemNotFoundException();
	}

	private function getParent(int $index) : ?int
	{
		$relations = $this->getRelations($index);
		return $relations[0];
	}

	private function getLeftChild(int $index) : ?int
	{
		$relations = $this->getRelations($index);
		return $relations[1];
	}

	private function getRightChild(int $index) : ?int
	{
		$relations = $this->getRelations($index);
		return $relations[2];
	}

	private function getRelations(int $index) : array
	{
		return $this->bstData[$index][2];
	}

	private function compareValuesByIndex(int $item1, int $item2) : int
	{
		return $this->compare($this->getItemAtIndex($item1), $this->getItemAtIndex($item2));
	}

	protected function compare<T>(T $item1, T $item2) : int
	{
		if ($item1 < $item2) {
			return -1;
		}

		if ($item1 > $item2) {
			return 1;
		}

		return 0;
	}

	private function candidateIsGreaterThanCurrent(?int $candidate) : bool
	{
		if ($candidate !== null) {
			if ($this->compareValuesByIndex($candidate, $this->iteratorPtr) > 0) {
				return true;
			}
		}

		return false;
	}

	private function useSmallestChild()
	{
		$originalPtr = $this->iteratorPtr;
		$this->useSmallestLeftChildStartingAt($this->iteratorPtr);

		$rightChild = $this->getRightChild($this->iteratorPtr);
		if ($rightChild !== null && $originalPtr === $this->iteratorPtr) {
			$this->useSmallestLeftChildStartingAt($rightChild);
		}
	}

	private function useSmallestLeftChildStartingAt(int $index)
	{
		$smallestLeftChild = $this->getMinIndexStartingAt($index);
		if ($this->candidateIsGreaterThanCurrent($smallestLeftChild) === true) {
			$this->iteratorPtr = $smallestLeftChild;
		}
	}

	private function useParent()
	{
		$parent = $this->getparent($this->iteratorPtr);
		if ($parent !== null) {

			$this->iteratorPtr = $parent;
			if ($this->compareValuesByIndex($parent, $this->iteratorPtr) < 0) {
				$this->next();
			}

		}
	}
}
