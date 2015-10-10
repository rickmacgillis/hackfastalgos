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

	public function testCanPreventDdosByChangingSeed()
	{
		$murmur = new \HackFastAlgos\MurmurHash3();
		$collisionHash1 = $murmur->hash('213398ac-92b6-4752-ab77-faecf37d4c9a');
		$collisionHash2 = $murmur->hash('d6172a08-a11a-4dda-d4fa-25cd1135e8e8');

		$this->assertSame($collisionHash1, $collisionHash2);

		$uniqueHash1 = $murmur->hash('213398ac-92b6-4752-ab77-faecf37d4c9a', 8758765);
		$uniqueHash2 = $murmur->hash('d6172a08-a11a-4dda-d4fa-25cd1135e8e8', 8758765);

		$this->assertNotSame($uniqueHash1, $uniqueHash2);
	}
}
