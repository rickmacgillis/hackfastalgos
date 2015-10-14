<?HH
/**
 * @author Rick Mac Gillis
 *
 * Algorithm to partition a vector around a given pivot
 */

namespace HackFastAlgos;

class Partition
{
	private int $pivot = 0;
	private int $pivotValue = 0;
	private int $left = 0;
	private int $right = 0;

	public function __construct(private Vector<int> $vector){}

	/**
	 * Operates in Theta(n) time.
	 */
	public function partition(int $left = 0, ?int $right = null, ?int $pivot = null) : Vector<int>
	{
		$this->pivot = $pivot === null ? $left : $pivot;
		$this->pivotValue = $this->vector[$this->pivot];
		$this->swap($this->pivot, $left);

		$this->right = ($right === null) ? $this->vector->count()-1 : $right;
		$this->left = $left;

		$this->reorderVector();

		$this->swap($this->pivot, $this->right);
		$this->pivot = $this->right;

		return $this->vector;
	}

	public function getPivot() : int
	{
		return $this->pivot;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function reorderVector()
	{
		while ($this->left < $this->right) {

			while ($this->left < $this->right && $this->vector[$this->left] <= $this->pivotValue) {
				$this->left++;
			}

			while ($this->vector[$this->right] > $this->pivotValue) {
				$this->right--;
			}

			if ($this->left < $this->right) {
				$this->swap($this->left, $this->right);
			}

		}
	}

	private function swap(int $index1, int $index2)
	{
		$bak = $this->vector[$index2];
		$this->vector[$index2] = $this->vector[$index1];
		$this->vector[$index1] = $bak;
	}
}
