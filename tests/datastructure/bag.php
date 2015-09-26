<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class BagTest extends \PHPUnit_Framework_TestCase
{
	public function testBagCanAddItem()
	{
		$bag = new DataStructure\Bag();
		$bag->add('test');

		$this->assertSame(1, $bag->count());
		$this->assertFalse($bag->isEmpty());
	}

	public function testCanIterateThroughTheBag()
	{
		$bag = new Datastructure\Bag();
		$bag->add('test1');
		$bag->add('test2');

		$bag->rewind();
		$this->assertTrue($bag->valid());
		$this->assertSame(0, $bag->key());
		$this->assertSame('test1', $bag->current());

		$bag->next();
		$this->assertTrue($bag->valid());
		$this->assertSame(1, $bag->key());
		$this->assertSame('test2', $bag->current());

		$bag->prev();
		$this->assertTrue($bag->valid());
		$this->assertSame(0, $bag->key());
		$this->assertSame('test1', $bag->current());

		$bag->prev();
		$this->assertFalse($bag->valid());
	}
}
