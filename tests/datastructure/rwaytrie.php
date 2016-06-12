<?HH

use HackFastAlgos\DataStructure\RWayTrie as RWayTrie;

class RWayTrieTest extends \PHPUnit_Framework_TestCase
{
	public function testCanPutAndGetSameString()
	{
		$trie = new RWayTrie();
		$this->assertSame(null, $trie->get('test'));

		$trie->put('test', 0);
		$this->assertSame(0, $trie->get('test'));
	}

	public function testTrieContainsStringWhenItExists()
	{
		$trie = new RWayTrie();
		$this->assertFalse($trie->contains('test'));

		$trie->put('test', 0);
		$this->assertTrue($trie->contains('test'));
	}

	public function testReturnsNullWhenEmtyString()
	{
		$trie = new RWayTrie();
		$this->assertSame(null, $trie->get(''));
	}

	public function testReturnsNullWhenRetrievinguninsertedPrefixOfExistingWord()
	{
		$trie = new RWayTrie();
		$trie->put('test', 0);

		$this->assertSame(null, $trie->get('te'));
	}

	public function testCanInsertAndRetrieveMultipleWords()
	{
		$trie = new RWayTrie();

		$trie->put('test', 0);
		$trie->put('try', 1);
		$trie->put('te', 2);
		$trie->put('testing', 3);
		$trie->put('apple', 4);
		$trie->put('zebra', 5);
		$trie->put('ali-zebu', 6);

		$this->assertSame(0, $trie->get('test'));
		$this->assertSame(1, $trie->get('try'));
		$this->assertSame(2, $trie->get('te'));
		$this->assertSame(3, $trie->get('testing'));
		$this->assertSame(4, $trie->get('apple'));
		$this->assertSame(5, $trie->get('zebra'));
		$this->assertSame(6, $trie->get('ali-zebu'));

		$this->assertTrue($trie->contains('test'));
		$this->assertTrue($trie->contains('try'));
		$this->assertTrue($trie->contains('te'));
		$this->assertTrue($trie->contains('testing'));
		$this->assertTrue($trie->contains('apple'));
		$this->assertTrue($trie->contains('zebra'));
		$this->assertTrue($trie->contains('ali-zebu'));
	}

	public function testCanDeleteStringWhileRetainingOtherStrings()
	{
		$trie = new RWayTrie();

		$trie->put('test', 0);
		$trie->put('try', 1);
		$trie->put('te', 2);
		$trie->put('testing', 3);
		$trie->put('apple', 4);
		$trie->put('zebra', 5);
		$trie->put('ali-zebu', 6);

		$trie->delete('test');

		$this->assertSame(null, $trie->get('test'));
		$this->assertFalse($trie->contains('test'));

		$this->assertSame(1, $trie->get('try'));
		$this->assertSame(2, $trie->get('te'));
		$this->assertSame(3, $trie->get('testing'));
		$this->assertSame(4, $trie->get('apple'));
		$this->assertSame(5, $trie->get('zebra'));
		$this->assertSame(6, $trie->get('ali-zebu'));

		$trie->delete('zebra');

		$this->assertSame(null, $trie->get('zebra'));
		$this->assertFalse($trie->contains('zebra'));

		$this->assertSame(1, $trie->get('try'));
		$this->assertSame(2, $trie->get('te'));
		$this->assertSame(3, $trie->get('testing'));
		$this->assertSame(4, $trie->get('apple'));
		$this->assertSame(6, $trie->get('ali-zebu'));
	}

	public function testCanGetAllKeysInTheTST()
	{
		$trie = new RWayTrie();

		$trie->put('test', 0);
		$trie->put('try', 1);
		$trie->put('te', 2);
		$trie->put('testing', 3);
		$trie->put('apple', 4);
		$trie->put('zebra', 5);
		$trie->put('ali-zebu', 6);

		$expected = new Vector();
		$expected[] = 'te';
		$expected[] = 'test';
		$expected[] = 'testing';
		$expected[] = 'try';
		$expected[] = 'apple';
		$expected[] = 'ali-zebu';
		$expected[] = 'zebra';

		$this->assertEquals($expected, $trie->getKeys());
	}

	public function testCanGetKeysWithAGivenPrefix()
	{
		$trie = new RWayTrie();

		$trie->put('test', 0);
		$trie->put('try', 1);
		$trie->put('te', 2);
		$trie->put('testing', 3);
		$trie->put('apple', 4);
		$trie->put('zebra', 5);
		$trie->put('ali-zebu', 6);

		$expected = new Vector();
		$expected[] = 'te';
		$expected[] = 'test';
		$expected[] = 'testing';

		$this->assertEquals($expected, $trie->getKeysWithPrefix('te'));
	}

	public function testCanGetTheLongestPrefixOfAString()
	{
		$trie = new RWayTrie();

		$trie->put('test', 0);
		$trie->put('try', 1);
		$trie->put('te', 2);
		$trie->put('testing', 3);

		$this->assertSame('test', $trie->getLongestPrefixOf('tester'));
		$this->assertSame('test', $trie->getLongestPrefixOf('test'));
		$this->assertSame('tes', $trie->getLongestPrefixOf('tes'));
		$this->assertSame('tes', $trie->getLongestPrefixOf('tesa'));
		$this->assertSame('tes', $trie->getLongestPrefixOf('tesu'));
		$this->assertSame('testing', $trie->getLongestPrefixOf('testings'));
		$this->assertSame('', $trie->getLongestPrefixOf('and'));
	}
}
