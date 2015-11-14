<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Counting Sort (Also named Key-Index Counting)
 * Counting sort is a stable sorting method.
 *
 * Learn more
 * @link https://en.wikipedia.org/wiki/Counting_sort
 * @link http://algs4.cs.princeton.edu/51radix/LSD.java.html
 */

namespace HackFastAlgos;

class CountingSort
{
	private Vector<int> $counts = Vector{};
	private Vector<T> $sorted = Vector{};
	private int $vectorLength = 0;
	private int $bits = 32;
	private int $bitsPerByte = 8;
	private int $word = 4;
	private int $byteSize = 256;
	private int $mask = 255;

	public function __construct(private Vector<T> $vector, private int $indexOffset = 0)
	{
		$this->vectorLength = $this->vector->count();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	public function sortAscii() : Vector<string>
	{
		$totalAscii = 255;
		$this->resetObject();
		$this->counts->resize($totalAscii+1, 0);

		$this->computeAsciiFrequencyCounts();
		$this->computeIndexOffsets($totalAscii);
		$this->moveCharsToNewPosition();

		return $this->sorted;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	public function sortInteger() : Vector<int>
	{
		$this->resetObject();
		$this->counts->resize($this->byteSize+1, 0);
		$this->computeIntegerFrequencyCounts();
		$this->computeIndexOffsets($this->byteSize);
		$this->adjustBytes();
		$this->moveIntsToNewPosition();

		return $this->sorted;
	}

	private function resetObject()
	{
		$this->counts = Vector{};
		$this->sorted = Vector{};
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function computeAsciiFrequencyCounts()
	{
		for ($i = 0; $i < $this->vectorLength; $i++) {
			$this->counts[$this->getAsciiCodeForVectorIndex($i)+1]++;
		}
	}

	private function getAsciiCodeForVectorIndex(int $index) : int
	{
		return ord($this->vector[$index][$this->indexOffset]);
	}

	/**
	 * Operates in Theta(A) time where A is the total number of Ascii chars (255).
	 */
	private function computeIndexOffsets(int $maxCount)
	{
		for ($i = 0; $i < $maxCount; $i++) {
			$this->counts[$i+1] += $this->counts[$i];
		}
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function moveCharsToNewPosition()
	{
		$this->sorted->resize($this->vectorLength, 0);

		for ($i = 0; $i < $this->vectorLength; $i++) {

			$asciiCode = $this->getAsciiCodeForVectorIndex($i);
			$charactersIndex = $this->getIndexForAsciiCode($asciiCode);
			$this->sorted[$charactersIndex] = $this->vector[$i];
			$this->incrementIndexCounterForAsciiCode($asciiCode);

		}
	}

	private function getIndexForAsciiCode(int $asciiCode) : int
	{
		return $this->counts[$asciiCode];
	}

	private function incrementIndexCounterForAsciiCode(int $asciiCode)
	{
		$this->counts[$asciiCode]++;
	}

	private function computeIntegerFrequencyCounts()
	{
		for ($i = 0; $i < $this->vectorLength; $i++) {

			$index = $this->getIndexForInteger($this->vector[$i]);
			$this->counts[$index+1]++;

		}
	}

	private function getIndexForInteger(int $int) : int
	{
		$byteOffset = $this->bitsPerByte*$this->indexOffset;
		return ($int >> $byteOffset) & $this->mask;
	}

	private function adjustBytes()
	{
		if ($this->indexOffset === $this->word-1) {

			$halfByte = 128;
			$halfByteVal = $this->counts[$halfByte];
			$maxByteMinusHalfByteVal = $this->counts[$this->byteSize] - $halfByteVal;

			for ($i = 0; $i < $halfByte; $i++) {
				$this->counts[$this->byteSize] += $maxByteMinusHalfByteVal;
			}

			for ($i = $halfByte; $i < $this->byteSize; $i++) {
				$this->counts[$this->byteSize] -= $halfByteVal;
			}

		}
	}

	private function moveIntsToNewPosition()
	{
		for ($i = 0; $i < $this->vectorLength; $i++) {

			$index = $this->getIndexForInteger($this->vector[$i]);
			$this->sorted[$this->counts[$index]++] = $this->vector[$i];

		}
	}
}
