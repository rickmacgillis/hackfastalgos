<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of rudimentary Regular Expressions
 *
 * Learn more @link http://algs4.cs.princeton.edu/54regexp/NFA.java.html
 */

namespace HackFastAlgos;

class RegExTookTooLongException extends \Exception{}

class RegEx
{
	private int $endMicroSecs = 0;

	public function __construct(
		private String $pattern,
		private String $text,
		private int $maxTimeInMs = 0
	) {
		$this->compileRegexNfa();
		if ($this->maxTimeInMs > 0) {
			$this->endMicroSecs = (int) microtime(true) + $this->maxTimeInMs*1000;
		}
	}

	public function isValid() : bool
	{
		$this->throwIfTookTooLong();
	}

	public function grep() Map<int, String>
	{
		$this->throwIfTookTooLong();
	}

	private function compileRegexNfa()
	{

	}

	private function throwIfTookTooLong()
	{
		$currentMicroSecs = (int) microtime(true);
		if ($currentMicroSecs >= $this->endMicroSecs) {
			throw new RegExTookTooLongException();
		}
	}
}
