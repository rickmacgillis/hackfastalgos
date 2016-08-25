<?HH

use HackFastalgos\DataStructure\LRUCache as LRUCache;

class LRUCacheTest extends \PHPUnit_Framework_TestCase
{
  public function testHasKeyReturnsFalseWhenEmpty()
  {
    $lruCache = new LRUCache<int,String>(10);
    $this->assertFalse($lruCache->hasKey(1));
  }

  public function testCanAddAndRetrieveItemFromCache()
  {
    $lruCache = new LRUCache<int,String>(10);
    $lruCache->add(1, "test");

    $this->assertSame("test", $lruCache->access(1));
  }

  public function testCanCheckSizeOfLRUCache()
  {
    $lruCache = new LRUCache<int,String>(10);

    $this->assertSame(0, $lruCache->getSize());

    $lruCache->add(1, "test");
    $this->assertSame(1, $lruCache->getSize());


    $lruCache->add(2, "test2");
    $this->assertSame(2, $lruCache->getSize());
  }

  public function testAccessWillReturnNullWhenItemDoesNotExist()
  {
    $lruCache = new LRUCache<int,String>(10);

    $this->assertSame(null, $lruCache->access(10));

    $lruCache->add(1, "test");
    $this->assertSame(null, $lruCache->access(10));

    $lruCache->add(2, "test2");
    $this->assertSame(null, $lruCache->access(10));
  }

  public function testWillNotDuplicateItemsInLRUCache()
  {
    $lruCache = new LRUCache<int,String>(10);

    $lruCache->add(1, "test");
    $this->assertSame(1, $lruCache->getSize());

    $lruCache->add(1, "test");
    $this->assertSame(1, $lruCache->getSize());

    $lruCache->add(2, "test2");
    $this->assertSame(2, $lruCache->getSize());

    $lruCache->add(2, "test2");
    $this->assertSame(2, $lruCache->getSize());

    $lruCache->add(3, "same");
    $this->assertSame(3, $lruCache->getSize());

    $lruCache->add(3, "same");
    $this->assertSame(3, $lruCache->getSize());

    $lruCache->add(4, "same");
    $this->assertSame(4, $lruCache->getSize());

    $lruCache->add(4, "same");
    $this->assertSame(4, $lruCache->getSize());
  }

  public function testWillNotExceedMaximumCacheCapacity()
  {
    $lruCache = new LRUCache<int,String>(5);

    $lruCache->add(1, "test1");
    $lruCache->add(2, "test2");
    $lruCache->add(3, "test3");
    $lruCache->add(4, "test4");
    $lruCache->add(5, "test5");
    $this->assertSame(5, $lruCache->getSize());

    $lruCache->add(6, "test6");
    $this->assertSame(5, $lruCache->getSize());
  }
}
