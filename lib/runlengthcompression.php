<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of various compression algorithms
 *
 * Learn more
 * @link http://algs4.cs.princeton.edu/55compression/RunLength.java.html
 */

namespace HackFastAlgos;

class RunLengthCompressionNotBinaryStringException extends \Exception{};

class RunLengthCompression extends Interfaces\Compression
{
	public function __construct(private String $text, private int $runLength = 255){}

	public function setText(String $text)
	{
		$this->text = $text;
	}

	/**
	 * Runs in Theta(N) time where N is the length of the raw data.
	 */
	public function encode() : String
	{
		$lastChar = '0';
		$currentRun = 0;
		$compressed = null;
		$textLength = strlen($this->text);
		for ($i = 0; $i < $textLength; $i++) {

			$char = $this->text[$i];
			$this->throwIfNotBinaryChar($char);

			if ($lastChar !== $char || $currentRun === $this->runLength) {

				$lastChar = $char;
				$compressed .= $currentRun.' ';
				$currentRun = 0;

			}

			$currentRun++;

		}

		$compressed .= $currentRun.' ';

		return trim($compressed);
	}

	/**
	 * Operates in Theta(M*N) time where M is the number of counts, and N is the value of the count.
	 */
	public function decode() : String
	{
		$char = '0';
		$decoded = null;
		$counts = explode(' ', $this->text);
		foreach ($counts as $key => $count) {

			for ($i = 0; $i < (int) $count; $i++) {
				$decoded .= $char;
			}

			$char = $char === '0' ? '1' : '0';

		}

		return $decoded;
	}

	private function throwIfNotBinaryChar(String $char)
	{
		if ($char !== '0' && $char !== '1') {
			throw new RunLengthCompressionNotBinaryStringException($char);
		}
	}
}
