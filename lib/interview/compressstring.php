<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: Implement an algorithm to perform basic string compression using the counts of each character.
 * If the compressed string is longer than the original string, return the original string.
 */

namespace HackFastAlgos\Interview;

use \HackFastAlgos\DataStructure as DataStructure;

class CompressString
{
	private ?DataStructure\StringBuffer $compressed = null;
	private int $bufferLength = 0;

	public function __construct(private string $string)
	{
		$this->compressed = new DataStructure\StringBuffer();
	}

	public function compress() : string
	{
		$stringLength = strlen($this->string);

		if ($stringLength < 3) {
			return $this->string;
		}

		return $this->getCompressedString();
	}

	/**
	 * Operates in O(n) or Omega(1) time.
	 */
	private function getCompressedString() : string
	{
		$stringLength = strlen($this->string);
		$lastChar = null;
		$charCounter = 1;
		for ($i = 0; $i < $stringLength; $i++) {

			$char = $this->string[$i];
			if ($lastChar !== $char) {

				if ($i > 0) {
					$this->addToBuffer($charCounter);
				}

				$this->addToBuffer($char);
				$charCounter = 1;
				$lastChar = $char;

			} else {
				$charCounter++;
			}

			if ($i === $stringLength-1) {
				$this->addToBuffer($charCounter);
			}

			if ($this->bufferLength >= $stringLength) {
				return $this->string;
			}

		}

		return (string) $this->compressed;
	}

	private function addToBuffer<T>(T $item)
	{
		$this->compressed->append((string) $item);
		$this->bufferLength++;
	}
}
