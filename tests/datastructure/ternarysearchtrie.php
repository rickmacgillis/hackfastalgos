<?HH

use HackFastAlgos\DataStructure\TernarySearchTrie as TernarySearchTrie;

class TernarySearchTrieTest extends \PHPUnit_Framework_TestCase
{
	public function testCanPutAndGetSameString()
	{
		$tst = new TernarySearchTrie();
		$this->assertSame(null, $tst->get('test'));

		$tst->put('test', 0);
		$this->assertSame(0, $tst->get('test'));
	}

	public function testTrieContainsStringWhenItExists()
	{
		$tst = new TernarySearchTrie();
		$this->assertFalse($tst->contains('test'));

		$tst->put('test', 0);
		$this->assertTrue($tst->contains('test'));
	}

	public function testReturnsNullWhenEmtyString()
	{
		$tst = new TernarySearchTrie();
		$this->assertSame(null, $tst->get(''));
	}

	public function testReturnsNullWhenRetrievinguninsertedPrefixOfExistingWord()
	{
		$tst = new TernarySearchTrie();
		$tst->put('test', 0);

		$this->assertSame(null, $tst->get('te'));
	}

	public function testCanInsertAndRetrieveMultipleWords()
	{
		$tst = new TernarySearchTrie();

		$tst->put('test', 0);
		$tst->put('try', 1);
		$tst->put('te', 2);
		$tst->put('testing', 3);
		$tst->put('apple', 4);
		$tst->put('zebra', 5);
		$tst->put('ali-zebu', 6);

		$this->assertSame(0, $tst->get('test'));
		$this->assertSame(1, $tst->get('try'));
		$this->assertSame(2, $tst->get('te'));
		$this->assertSame(3, $tst->get('testing'));
		$this->assertSame(4, $tst->get('apple'));
		$this->assertSame(5, $tst->get('zebra'));
		$this->assertSame(6, $tst->get('ali-zebu'));

		$this->assertTrue($tst->contains('test'));
		$this->assertTrue($tst->contains('try'));
		$this->assertTrue($tst->contains('te'));
		$this->assertTrue($tst->contains('testing'));
		$this->assertTrue($tst->contains('apple'));
		$this->assertTrue($tst->contains('zebra'));
		$this->assertTrue($tst->contains('ali-zebu'));
	}

	public function testCanDeleteStringWhileRetainingOtherStrings()
	{
		$tst = new TernarySearchTrie();

		$tst->put('test', 0);
		$tst->put('try', 1);
		$tst->put('te', 2);
		$tst->put('testing', 3);
		$tst->put('apple', 4);
		$tst->put('zebra', 5);
		$tst->put('ali-zebu', 6);

		$tst->delete('test');

		$this->assertSame(null, $tst->get('test'));
		$this->assertFalse($tst->contains('test'));

		$this->assertSame(1, $tst->get('try'));
		$this->assertSame(2, $tst->get('te'));
		$this->assertSame(3, $tst->get('testing'));
		$this->assertSame(4, $tst->get('apple'));
		$this->assertSame(5, $tst->get('zebra'));
		$this->assertSame(6, $tst->get('ali-zebu'));

		$tst->delete('zebra');

		$this->assertSame(null, $tst->get('zebra'));
		$this->assertFalse($tst->contains('zebra'));

		$this->assertSame(1, $tst->get('try'));
		$this->assertSame(2, $tst->get('te'));
		$this->assertSame(3, $tst->get('testing'));
		$this->assertSame(4, $tst->get('apple'));
		$this->assertSame(6, $tst->get('ali-zebu'));
	}

	public function testCanGetAllKeysInTheTST()
	{
		$tst = new TernarySearchTrie();

		$tst->put('test', 0);
		$tst->put('try', 1);
		$tst->put('te', 2);
		$tst->put('testing', 3);
		$tst->put('apple', 4);
		$tst->put('zebra', 5);
		$tst->put('ali-zebu', 6);

		$expected = new Vector();
		$expected[] = 'ali-zebu';
		$expected[] = 'apple';
		$expected[] = 'te';
		$expected[] = 'test';
		$expected[] = 'testing';
		$expected[] = 'try';
		$expected[] = 'zebra';

		$this->assertEquals($expected, $tst->getKeys());
	}

	public function testCanGetKeysWithAGivenPrefix()
	{
		$tst = new TernarySearchTrie();

		$tst->put('test', 0);
		$tst->put('try', 1);
		$tst->put('te', 2);
		$tst->put('testing', 3);
		$tst->put('apple', 4);
		$tst->put('zebra', 5);
		$tst->put('ali-zebu', 6);

		$expected = new Vector();
		$expected[] = 'te';
		$expected[] = 'test';
		$expected[] = 'testing';

		$this->assertEquals($expected, $tst->getKeysWithPrefix('te'));
	}

	public function testCanGetTheLongestPrefixOfAString()
	{
		$tst = new TernarySearchTrie();

		$tst->put('test', 0);
		$tst->put('try', 1);
		$tst->put('te', 2);
		$tst->put('testing', 3);

		$this->assertSame('test', $tst->getLongestPrefixOf('tester'));
		$this->assertSame('test', $tst->getLongestPrefixOf('test'));
		$this->assertSame('tes', $tst->getLongestPrefixOf('tes'));
		$this->assertSame('tes', $tst->getLongestPrefixOf('tesa'));
		$this->assertSame('tes', $tst->getLongestPrefixOf('tesu'));
		$this->assertSame('testing', $tst->getLongestPrefixOf('testings'));
		$this->assertSame('', $tst->getLongestPrefixOf('and'));
	}
}
