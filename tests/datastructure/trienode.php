<?HH

use HackFastAlgos\DataStructure\TrieNode as TrieNode;

class TrieNodeTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetAndSetChildNodes()
	{
		$trieNode = new TrieNode();
		$this->assertSame(null, $trieNode->getChild('a'));

		$trieNode->addChild('a');
		$aChild = $trieNode->getChild('a');
		$this->assertInternalType('object', $aChild);

		$this->assertSame(null, $aChild->value);

		$aChild->value = 'test';
		$this->assertSame('test', $aChild->value);
	}

	public function testCanGetAllChildren()
	{
		$trieNode = new TrieNode();

		$trieNode->addChild('a');
		$trieNode->addChild('b');
		$trieNode->addChild('c');
		$trieNode->addChild('d');

		$expected = [
			'a' => new TrieNode(),
			'b' => new TrieNode(),
			'c' => new TrieNode(),
			'd' => new TrieNode(),
		];

		$this->assertEquals($expected, $trieNode->getChildren());
	}

	public function testCanGetValidResponseWhenCheckingForChildren()
	{
		$trieNode = new TrieNode();

		$this->assertFalse($trieNode->hasChildren());

		$trieNode->addChild('a');
		$this->assertTrue($trieNode->hasChildren());
	}

	public function testCanRemoveChild()
	{
		$trieNode = new TrieNode();

		$trieNode->addChild('a');
		$trieNode->addChild('b');
		$trieNode->addChild('c');
		$trieNode->addChild('d');

		$expected = [
			'a' => new TrieNode(),
			'c' => new TrieNode(),
			'd' => new TrieNode(),
		];

		$trieNode->removeChild('b');
		$this->assertEquals($expected, $trieNode->getChildren());

		$trieNode->removeChild('z');
		$this->assertEquals($expected, $trieNode->getChildren());
	}
}
