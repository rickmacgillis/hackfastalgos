<?HH

use \HackFastAlgos\Interview as Interview;

class RansomMagazineTest extends \PHPUnit_Framework_TestCase
{
	public function testCanFindAllRansomLetterWordsInAMagazine()
	{
		$ransomNote = 'send $1,000,000,000 or I\'ll eat your cat.';
		$magazine = 'The fat cats of wallstreet send $1,000,000,000 to Rick Mac Gillis to improve Hallux Monkey. Rick, '.
					'or someone pretending to be rick, was seen eating a wallrus last Thursday night when I was at the '.
					'mall. "I\'ll give you part of my walrus if you sit your butt down right now," exclaimed Rick '.
					'as he found it hotly inappropriate for the onlooker next to him to gawk wide-eyed at his walrus.';

		$this->assertTrue(Interview\RansomMagazine::magContainsRansom($magazine, $ransomNote));

		$ransomNote = 'Send $1,000,000,000 or I\'ll EAT YOUR CAT.';
		$this->assertFalse(Interview\RansomMagazine::magContainsRansom($magazine, $ransomNote));
	}
}
