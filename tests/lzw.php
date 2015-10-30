<?HH

class LZWTest extends \PHPUnit_Framework_TestCase
{
	public function testCanEncodeString()
	{
		$input = 'This sentence is false! Don\'t think about it. Don\'t think about it.';
		$compressed = '! " # $ % & \' ( ) * + , - . / 0 1 2 3 4 5 6 7 8 9 : ; < = > ? @ A B C D E F G H I J K L M N O P Q G';
		$lzw = new \HackFastAlgos\LZW();
		$this->assertSame($compressed, $lzw->compress($input));
	}

	public function testCanGetAndSetDictionary()
	{
		$input = 'testing';
		$lzw = new \HackFastAlgos\LZW();
		$lzw->compress($input);

		$dictionary = '{"t":" ","te":"!","es":"\"","st":"#","ti":"$","in":"%","ng":"&"}';
		$this->assertSame($dictionary, $lzw->getDictionary());

		$lzw = new \HackFastAlgos\LZW();
		$lzw->setDictionary($dictionary);
		$this->assertSame($dictionary, $lzw->getDictionary());
	}
}
