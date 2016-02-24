<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a string buffer (String Buffer is not useful in PHP or Hack.
 * Languages like Java and C++ can benefit from one.)
 * 
 * Learn more @link http://docs.oracle.com/javase/1.5.0/docs/api/java/lang/StringBuffer.html
 */

namespace HackFastAlgos\DataStructure;

class StringBuffer
{
	private array<string> $bufferData = [];

	public function append(string $string)
	{
		$this->bufferData[] = $string;
	}

	public function __toString()
	{
		return implode('', $this->bufferData);
	}

	public function reset()
	{
		$this->bufferData = [];
	}

	public function isEmpty() : bool
	{
		return count($this->bufferData) === 0;
	}
}
