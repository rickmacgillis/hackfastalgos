<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of an LRU cache
 *
 * All operations are performed in Theta(1) time and the data structure used O(N)
 * or Omega(1) space where N is the maximum capacity of the cache.
 *
 * Learn more @link http://www.cs.uml.edu/~jlu1/doc/codes/lruCache.html
 */

namespace HackFastAlgos\DataStructure;

class LRUCache<T,L>
{
  private Map<T, LinkedListNode> $items = Map{};
  private LinkedListNode<T,L> $head = null;
  private LinkedListNode<T,L> $tail = null;

  public function __construct(private int $maxCapacity){}

  public function hasKey(T $key) : bool
  {
    return $this->items->containsKey($key);
  }

  public function getSize()
  {
    return $this->items->count();
  }

  public function add(T $key, L $value)
  {
    if ($this->hasKey($key)) {
      $this->access($key);
    } else {

      $this->addAsHead($key, $value);
      $this->deleteTail();

    }
  }

  public function access(T $key) : ?L
  {
    if ($this->hasKey($key) === false) {
      return null;
    }

    $node = $this->items[$key];

    if ($node == $this->head) {
      return $node->getValue();
    } else if ($node == $this->tail) {
      $this->deleteTail();
    } else {
      $this->deleteNode($node);
    }

    $node->setNext($this->head);
    $node->setPrev(null);
    $this->head->setPrev($node);

    return $node->getValue();
  }

  private function deleteTail()
  {
    if ($this->tail === null || $this->maxCapacity >= $this->getSize()) {
      return;
    }

    $previousNode = $this->tail->getPrev();
    if ($previousNode !== null) {
      $previousNode->setNext(null);
    } else {
      $this->head = null;
    }

    $nodeKey = $this->tail->getKey();
    $this->items->removeKey($nodeKey);
    $this->tail = $previousNode;
  }

  private function addAsHead(T $key, L $value)
  {
    $node = new LinkedListNode<T,L>();
    $node->setValue($value);
    $node->setNext($this->head);
    $node->setKey($key);

    if ($this->head !== null) {

      $this->head->setPrev($node);
      $this->head = $node;

    } else {

      $this->head = $node;
      $this->tail = $node;

    }

    $this->items[$key] = $node;
  }

  private function deleteNode(LinkedListNode $node)
  {
    $previousNode = $node->getPrev();
    $nextNode = $node->getNext();
    $previousNode->setNext($nextNode);
    $nextNode->setPrev($previousNode);

    $nodeKey = $this->tail->getKey();
    $this->items->removeKey($nodeKey);
  }
}
