<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of an indexing client
 */

namespace HackFastAlgos\DataStructure;

newtype ContextMap = Map<string, Vector<string>>;
newtype HFASet = \HackFastAlgos\DataStructure\Set;

class Indexer
{
	private ?HashTableOA $indexerData = null;
	private int $seed = 0;
	private int $totalFiles = 0;
	private ?ContextMap $contextList = null;
	private int $contextSize = 4;

	public function __construct(int $size, int $seed = 0)
	{
		$this->seed = $seed;
		$this->indexerData = new HashTableOA($size, $this->seed);
	}

	/**
	 * Operates in Theta(F * f^2) time where "F" is the total number of files, and "f" is a file in the list.
	 */
	public function importFiles(Vector<string> $filenames)
	{
		$this->totalFiles = $filenames->count();
		for ($i = 0; $i < $this->totalFiles; $i++) {
			$this->addFile($filenames[$i]);
		}
	}

	/**
	 * Operates in O(n) and Omega(1) time depending on the number of files contain the given word.
	 */
	public function findWord(string $word) : Vector<string>
	{
		$fileList = Vector{};
		if ($this->wordIsTracked($word)) {

			$fileTable = $this->indexerData[$word];
			$fileTable->rewind();
			while ($fileTable->valid()) {

				$fileList[] = $fileTable->key();
				$fileTable->next();

			}

		}

		return $fileList;
	}

	/**
	 * Operates in O(n^2) time when every file contains the same word, or Omega(1) time if the word never appears
	 * or appears once in one file.
	 */
	public function getContext(string $word, int $contextSize = 4) : ContextMap
	{
		$this->contextList = Map{};
		$this->contextSize = $contextSize;
		if ($this->wordIsTracked($word)) {
			$this->setContextListForWord($word);
		}

		return $this->contextList;
	}

	/**
	 * Operates in Theta(n^2) time.
	 */
	private function addFile(string $filename)
	{
		$words = $this->getWordsFromFile($filename);

		$totalWords = count($words);
		for ($i = 0; $i < $totalWords; $i++) {

			$word = $words[$i];
			$this->createStructureForWordEntry($word, $filename, $totalWords);
			$this->addWordPositionToTrackedFile($word, $filename, $i);

		}
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function getWordsFromFile(string $filename) : array
	{
		$contents = file_get_Contents($filename);
		$singleLine = str_replace(["\t", "\n", "\r", " "], ' ', $contents);
		$wordArray = explode(' ', $singleLine);
		return $this->removeEmptyElements($wordArray);
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function removeEmptyElements(array $array) : array
	{
		$noEmpties = array_filter($array, function ($value) {
			if (trim($value) !== '') {
				return $value;
			}
		});

		return array_values($noEmpties);
	}

	/**
	 * Operates in O(n) or Omega(1) time. (O(n) is when everything hashes to the same address.)
	 */
	private function createStructureForWordEntry(string $word, string $filename, int $totalWords)
	{
		if ($this->wordIsTracked($word) === false) {
			$this->createFileTableForWord($word, $this->totalFiles);
		}

		if ($this->wordIsTrackedForFile($word, $filename) === false) {
			$this->createPositionSetForFile($word, $filename, $totalWords);
		}
	}

	private function wordIsTracked(string $word) : bool
	{
		return $this->indexerData->contains($word);
	}

	private function createFileTableForWord(string $word, int $size)
	{
		$this->indexerData[$word] = new HashTableOA($size, $this->seed);
	}

	private function wordIsTrackedForFile(string $word, string $filename) : bool
	{
		return $this->indexerData[$word]->contains($filename);
	}

	private function createPositionSetForFile(string $word, string $filename, int $size)
	{
		$this->indexerData[$word][$filename] = new \HackFastAlgos\DataStructure\Set($size, $this->seed);
	}

	private function addWordPositionToTrackedFile(string $word, string $filename, int $position)
	{
		$this->indexerData[$word][$filename]->insert($position);
	}

	private function setContextListForWord(string $word)
	{
		$fileTable = $this->indexerData[$word];
		foreach ($fileTable as $filename => $wordPositions) {
			$this->contextList[$filename] = $this->getContextForEachPosition($wordPositions, $filename);
		}
	}

	private function getContextForEachPosition(HFASet $wordPositions, string $filename) : Vector<string>
	{
		$contextVector = Vector{};
		$fileContents = $this->getWordsFromFile($filename);

		foreach ($wordPositions as $position) {

			$contextStart = $wordPositions[$position] - $this->contextSize;
			$contextLen = $this->contextSize * 2 + 1;
			$contextVector[] = $this->getContextString($fileContents, $contextStart, $contextLen);

		}

		return $contextVector;
	}

	private function getContextString(array $subject, int $start, int $length) : string
	{
		$contextString = null;
		$end = $start + $length;
		for ($i = $start; $i < $end; $i++) {
			$contextString .= $subject[$i].' ';
		}

		return trim($contextString);
	}
}
