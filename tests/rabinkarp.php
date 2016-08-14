<?HH

class RabinKarpTest extends \PHPUnit_Framework_TestCase
{
  public function testCanGetRabinFingerprint()
  {
    $rabinKarp = new \HackFastAlgos\RabinKarp();
    $text = 'adada';
    $start = 0;
    $len = 3;

    $first3 = $rabinKarp->rabinFingerprint($text, $start, $len);
    $second3 = $rabinKarp->rabinFingerprint($text, $start+1, $len, $first3);
    $last3 = $rabinKarp->rabinFingerprint($text, $start+2, $len, $second3);

    $this->assertSame($first3, $last3);
  }

  public function testReturnsTrueWhenSubstringFound()
  {
    $rabinKarp = new \HackFastAlgos\RabinKarp();
    $text = 'badad';

    $this->assertTrue($rabinKarp->hasSubstring($text, 'dad'));
  }

  public function testFalseWhenSubstringNotFound()
  {
    $rabinKarp = new \HackFastAlgos\RabinKarp();
    $text = 'badad';

    $this->assertFalse($rabinKarp->hasSubstring($text, 'nope'));
  }

  public function testFalseWhenSubstringIsLargerThanText()
  {
    $rabinKarp = new \HackFastAlgos\RabinKarp();
    $text = 'badad';

    $this->assertFalse($rabinKarp->hasSubstring($text, 'nopenopenope'));
  }
}
