<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Quick Sort
 * Learn more @link https://en.wikipedia.org/wiki/Quicksort
 */

namespace HackFastAlgos;

class QuickSort
{
	private ?Partition $partition = null;

	public function __construct(private Vector<int> $vector){
		$this->vector = Sort::fyShuffle($this->vector);
		$this->partition = new Partition($this->vector);
	}

	/**
	 * Quick Sort works in O(n log n) time on average, though in the worst case, it
	 * will operate in O(n^2) time.
	 */
	public function sort()
	{
		$end = $this->vector->count()-1;
		$this->sortRecurse(0, $end);
	}

	public function getResult() : Vector<int>
	{
		return $this->vector;
	}

	/**
	 * Operates in O(log n) on average or O(n) time in the worst case when
	 * the vector remains ordered.
	 */
	protected function sortRecurse(int $start, int $end)
	{
		if ($start < $end) {

			$this->partition->partition($start, $end);
			$pivot = $this->partition->getPivot();

			$this->sortRecurse($start, $pivot-1);
			$this->sortRecurse($pivot+1, $end);

		}
	}
}
