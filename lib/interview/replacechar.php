<?HH
/**
 * @author Rick Mac Gillis
 *
 * Puzzle: Replace a space with %20 in a given string.
 */

namespace HackFastAlgos\Interview;

use \HackFastAlgos\DataStructure as DataStructure;

class ReplaceChar
{
	private ?DataStructure\Queue $words = null;

	public function __construct(private string $string)
	{
		$this->words = new DataStructure\Queue();
	}

	/**
	 * Operates in Theta(L + W) time where L is the number of characters, and W is the number of words
	 * separated by $replace. The space complexity is Theta (Delta(n) + n) where Delta(n) is input sprint
	 * separated by $replace, and n is the input string separated by $find.
	 */
	public function replace(string $find, string $replace) : string
	{
		$this->addWordsToQueue();
		$stringBuffer = new DataStructure\StringBuffer();
		while ($this->words->count() > 0) {
			$stringBuffer->append($this->words->dequeue());
		}

		return (string) $stringBuffer;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function addWordsToQueue()
	{
		$currentWord = new DataStructure\StringBuffer();
		$stringLength = strlen($this->string);
		for ($i = 0; $i < $stringLength; $i++) {

			$char = $this->string[$i];
			if ($char === ' ') {

				$this->words->enqueue((string) $currentWord);
				$currentWord->reset();
				$this->words->enqueue('%20');

			} else {
				$currentWord->append($char);
			}

		}

		if ($currentWord->isEmpty() === false) {
			$this->words->enqueue((string) $currentWord);
		}
	}
}
