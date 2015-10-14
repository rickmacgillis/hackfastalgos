<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of quick select
 * Learn more @link https://en.wikipedia.org/wiki/Quickselect
 */

namespace HackFastAlgos;

class QuickSelect
{
	private int $pivot = 0;

	public function __construct(private Vector<int> $vector)
	{
		$this->vector = \HackFastAlgos\Sort::fyShuffle($this->vector);
	}

	public function quickSelect(int $kthSmallest, int $left = 0, ?int $right = null) : int
	{
		$right = $right === null ? $this->vector->count()-1 : $right;

		if ($left === $right) {
			return $this->vector[$left];
		}

		$this->partitionAndSetPivot($left, $right);

		if ($kthSmallest === $this->pivot) {
			return $this->vector[$this->pivot];
		}

		if ($kthSmallest < $this->pivot) {
			return $this->quickSelect($kthSmallest, $left, $this->pivot -1);
		}

		if ($kthSmallest > $this->pivot) {
			return $this->quickSelect($kthSmallest, $this->pivot + 1, $right);
		}
	}

	private function partitionAndSetPivot(int $left, int $right)
	{
		$partition = new Partition($this->vector);
		$partition->partition($left, $right);
		$this->pivot = $partition->getPivot();
	}
}
