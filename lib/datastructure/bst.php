<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a Binary Search Tree (BST)
 * Learn more @link https://en.wikipedia.org/wiki/Binary_search_tree
 */

namespace HackFastAlgos\DataStructure;

class BSTItemNotFoundException extends \Exception{}
class BSTItemExistsException extends \Exception{}

newtype BSTParent		= int;
newtype BSTLeftChild	= int;
newtype BSTRightChild	= int;
newtype Relations		= Vector<(?BSTParent, ?BSTLeftChild, ?BSTRightChild)>;

class BST implements \Countable
{
	private Vector<(T, Relations)> $bstData = Vector{};
	private int $totalItems = 0;

	public function insert<T>(T $item)
	{
		if (!$this->bstData->containsKey(0)) {

			$relations = $this->makeRelations(null, null, null);
			$this->addItemToTree($item, $relations);
			$this->totalItems++;

		} else {

			$parentIndex = $this->getParentForNewItemStartingAt($item, 0);
			$relations = $this->makeRelations($parentIndex, null, null);
			$this->addItemToTree($item, $relations);
			$this->totalItems++;
			$this->addLastChildToParent($parentIndex);

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
		$index = $this->getItemIndex($item);

		$parent = $this->getParent($index);
		$leftChild = $this->getLeftChild($index);
		$rightChild = $this->getRightChild($index);

		if ($this->hasChildren($index)) {

			// Finish this

		}

		$this->bstData[$index] = null;
		$this->totalItems--;
	}

	public function getMin<T>() : T
	{
		$mindex = $this->getMinIndexStartingAt(0);
		return $this->getItemAtIndex($mindex);
	}

	public function getMax<T>() : T
	{
		$maxdex = $this->getMaxIndexStartingAt(0);
		return $this->getItemAtIndex($maxdex);
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

	public function count() : int
	{
		return $this->totalItems;
	}

	private function makeRelations(?BSTParent $parent, ?BSTLeftChild $leftChild, ?BSTRightChild $rightChild) : array
	{
		return tuple($parent, $leftChild, $rightChild);
	}

	private function getParentForNewItemStartingAt<T>(T $newItem, int $parentIndex) : int
	{
		$compareItem = $this->getItemAtIndex($parentIndex);
		$comparison = $this->compare($newItem, $compareItem);

		$newItemsParent = $this->getChildFromComparison($comparison, $parentIndex);

		if ($newItemsParent !== $parentIndex) {
			return $this->getParentForNewItemStartingAt($newItem, $newItemsParent);
		}

		return $parentIndex;
	}

	private function getChildFromComparison(int $comparison, int $parent) : int
	{
		$parentIndex = $parent;

		if ($comparison === -1) {

			$leftChild = $this->getLeftChild($parent);
			$parentIndex = $leftChild === null ? $parent : $leftChild;

		} elseif ($comparison === 1) {

			$rightChild = $this->getRightChild($parent);
			$parentIndex = $rightChild === null ? $parent : $rightChild;

		} else {
			$this->throwItemExistsException();
		}

		return $parentIndex;
	}

	private function throwItemExistsException()
	{
		throw new BSTItemExistsException();
	}

	private function addItemToTree<T>(T $item, array $relations)
	{
		$this->bstData[] = tuple($item, $relations);
	}

	private function addLastChildToParent(int $parent)
	{
		$lastChildIndex = $this->count()-1;
		if ($this->compareValuesByIndex($lastChildIndex, $parent) < 0) {
			$this->setLeftChildForParent($lastChildIndex, $parent);
		} else {
			$this->setRightChildForParent($lastChildIndex, $parent);
		}
	}

	private function setLeftChildForParent(int $childIndex, int $parentIndex)
	{
		$relations = $this->getRelations($parentIndex);
		$relations[1] = $childIndex;
		$this->setItemRelations($parentIndex, $relations);
	}

	private function setItemRelations(int $itemIndex, array $relations)
	{
		$this->bstData[$itemIndex][1] = $relations;
	}

	private function setRightChildForParent(int $childIndex, int $parentIndex)
	{
		$relations = $this->getRelations($parentIndex);
		$relations[2] = $childIndex;
		$this->setItemRelations($parentIndex, $relations);
	}

	private function isLeftChild(int $index)
	{
		$parent = $this->getParent($index);
		$leftChild = $this->getLeftChild($parent);

		return $index === $leftChild;
	}

	private function isRightChild(int $index)
	{
		$parent = $this->getParent($index);
		$rightChild = $this->getRightChild($parent);

		return $index === $rightChild;
	}

	private function hasChildren(int $index) : bool
	{
		$leftChild = $this->getLeftChild($index);
		$rightChild = $this->getRightChild($index);

		return $leftChild !== null || $rightChild !== null;
	}

	private function getMinIndexStartingAt(int $index) : int
	{
		while (($leftChild = $this->getLeftChild($index)) !== null) {
			$index = $leftChild;
		}

		return $index;
	}

	private function getMaxIndexStartingAt(int $index) : int
	{
		while (($rightChild = $this->getRightChild($index)) !== null) {
			$index = $rightChild;
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
		switch ($this->compare($item, $candidateItem)) {

			case 0:
				return $startingIndex;

			case -1:
				return $this->getItemIndex($item, $this->getLeftChild($startingIndex));

			case 1:
				return $this->getItemIndex($item, $this->getRightChild($startingIndex));

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
		return $this->bstData[$index][1];
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
}
