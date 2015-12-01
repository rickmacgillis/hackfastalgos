<?HH

class CryptographyTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetRandomNumber()
	{
		$random = \HackFastAlgos\Cryptography::getRandomNumber(0, 20);
		$this->assertInternalType('integer', $random);
		$this->assertTrue($random >= 0 && $random <= 20);
	}

	public function testCanGetCorrectAsciiHornerHash()
	{
		$hornerHash = \HackFastAlgos\Cryptography::asciiHornerHash('test');
		$this->assertSame(521149980, $hornerHash);

		$hornerHash = \HackFastAlgos\Cryptography::asciiHornerHash('bagiggabagigga');
		$this->assertSame(429032570, $hornerHash);

		$hornerHash = \HackFastAlgos\Cryptography::asciiHornerHash('baccachickabacka');
		$this->assertSame(219098941, $hornerHash);

		$hornerHash = \HackFastAlgos\Cryptography::asciiHornerHash('baccachickabackachicka');
		$this->assertSame(183032013, $hornerHash);
	}
}
