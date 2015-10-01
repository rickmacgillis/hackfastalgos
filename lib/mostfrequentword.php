<?HH
/**
 * @author Rick Mac Gillis
 *
 * Algorithms to get the most frequent word in the given text
 */

namespace HackFastAlgos;

class MostFrequentWord
{
	private Map<string,int> $freqData = Map{};

	private ?DataStructure\PriorityQueue $queue = null;

	public function __construct(protected string $text){
		$this->text = strtolower($this->text);
		$this->queue = new DataStructure\PriorityQueue();
	}

	/**
	 * Operates in O(n log n) or Omega(n) time.
	 */
	public function calculateFequency()
	{
		$words = explode(' ', $this->text);
		$wordsCount = count($words);

		/*
		 * This is FAR from perfect! This example does not account for
		 * punctuation or other extra characters.
		 */
		for ($i = 0; $i < $wordsCount; $i++) {
			$this->incrementWordCount($words[$i]);
		}

		foreach ($this->freqData as $word => $frequency) {
			$this->queue->enqueue($word, $frequency);
		}
	}

	public function getMostFrequentWord() : string
	{
		return $this->queue->getMax();
	}

	public function getWordFrequency(string $word) : int
	{
		return $this->freqData[$word];
	}

	public function extractWord() : string
	{
		return $this->queue->dequeue();
	}

	protected function incrementWordCount(string $word)
	{
		if ($this->freqData->containsKey($word)) {
			$this->freqData[$word]++;
		} else {
			$this->freqData[$word] = 1;
		}
	}
}
