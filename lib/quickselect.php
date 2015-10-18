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
	private ?Partition $partition = null;

	public function __construct(private Vector<int> $vector)
	{
		$this->vector = \HackFastAlgos\Sort::fyShuffle($this->vector);
		$this->partition = new Partition($this->vector);
	}

	/**
	 * Operates in O(n^2) or Omega(1) time. (Omega(n) for a vector larger than one element)
	 */
	public function select(int $kthSmallest, int $left = 0, ?int $right = null) : int
	{
		$right = $right === null ? $this->vector->count()-1 : $right;

		if ($left === $right) {
			return $this->vector[$left];
		}

		$this->partition($left, $right);
		$this->pivot = $this->getPivot();

		if ($kthSmallest === $this->pivot) {
			return $this->vector[$this->pivot];
		}

		if ($kthSmallest < $this->pivot) {
			return $this->select($kthSmallest, $left, $this->pivot -1);
		}

		if ($kthSmallest > $this->pivot) {
			return $this->select($kthSmallest, $this->pivot + 1, $right);
		}
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function partition(int $left, int $right)
	{
		$this->partition->partition($left, $right);
	}

	private function getPivot() : int
	{
		return $this->partition->getPivot();
	}
}
