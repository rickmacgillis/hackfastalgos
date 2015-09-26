<?HH
/**
 * @author Rick Mac Gillis
 *
 * Algorithms to get the most frequent word in the given text
 */

namespace HackFastAlgos;

class MostFrequentWord
{
	/**
	 * The mapping of the most frequent words
	 * @type Map<string,int>
	 */
	protected Map<string,int> $freqData = Map{};

	/**
	 * The priority queue
	 * @type ?DataStructure\PriorityQueue $queue
	 */
	protected ?DataStructure\PriorityQueue $queue = null;

	/**
	 * Create the object with the full text to search.
	 *
	 * @param  protected string        $text
	 */
	public function __construct(protected string $text){
		$this->text = strtolower($this->text);
		$this->queue = new DataStructure\PriorityQueue();
	}

	/**
	 * Calculate the frequency that each word appears in the text.
	 *
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

	/**
	 * Get the most frequent word.
	 *
	 * @return string
	 */
	public function getWord() : string
	{
		return $this->queue->getMax();
	}

	/**
	 * Get the word count for the given word.
	 *
	 * @param  string $word
	 *
	 * @return int
	 */
	public function getWordFrequency(string $word) : int
	{
		return $this->freqData[$word];
	}

	/**
	 * Extract the word from the queue.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @return string
	 */
	public function extractWord() : string
	{
		return $this->queue->dequeue();
	}

	/**
	 * Increment the count for the desired word.
	 *
	 * @param  string $word
	 */
	protected function incrementWordCount(string $word)
	{
		if ($this->freqData->containsKey($word)) {
			$this->freqData[$word]++;
		} else {
			$this->freqData[$word] = 1;
		}
	}
}
