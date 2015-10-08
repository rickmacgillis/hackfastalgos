<?HH

class MurmurHash3 extends \PHPUnit_Framework_TestCase
{
	public function testCanCreateMurmurHashFromStringWithoutSeed()
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$this->assertSame(3226270321, $murmur->hash('Wild eep heap'));
	}

	public function testCanCreateSeededMurmurHashFromString()
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$this->assertSame(1460137558, $murmur->hash('Wild eep heap', 2376));
	}

	public function testCanCreateMurmurHashFromInt()
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$this->assertSame(792436826, $murmur->hash(35453));
	}

	public function testCanCreateMurmurHashFromBooleanTrue()
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$this->assertSame(2484513939, $murmur->hash(true));
	}

	public function testCanCreateMurmurHashFromBooleanFalse()
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$this->assertSame(0, $murmur->hash(false));
	}
}
