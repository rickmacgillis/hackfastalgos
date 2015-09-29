<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Graham Scan
 * Learn more @link https://en.wikipedia.org/wiki/Graham_scan
 */

use HackFastAlgos\DataStructure as DataStructure;

namespace HackFastAlgos;

class ConvexHull
{
	/**
	 * The list of edges
	 * @type Vector $edgeList
	 */
	protected Vector $edgeList = Vector{};

	public function __construct(DataStructure\EdgeList $edgeList){
		$this->edgeList = $edgeList->toVector{};
	}

	public function calculateGrahamScan() : DataStructure\EdgeList
	{
		$numPoints = $this->edgeList->count();
		$lowestCoordinate = $this->findLowestYCoordinate();
		$this->swapValues(0, $lowestCoordinate);
		$this->orderByPolarAngle(); // Incomplete
	}

	/**
	 * Find the lowest Y coordinate.
	 *
	 * @return int	The index of the lowest point
	 */
	protected function findLowestYCoordinate() : int
	{
		$count = $this->edgeList->count();
		$lowestPoint = 0;
		for ($i = 0; $i < $count; $i++) {

			if ($this->edgeList[$i][1] < $this->edgeList[$lowestPoint][1]) {
				$lowestPoint = $i;
			}

		}

		return $lowestPoint;
	}

	/**
	 * Quickly swap array values
	 *
	 * @param int $indexA	The first index to swap
	 * @param int $indexB	The second index to swap
	 */
	protected function swapValues(int $indexA, int $indexB)
	{
		$oldA = $this->edgeList[$indexA];
		$this->edgeList[$indexA] = $this->edgeList[$indexB];
		$this->edgeList[$indexB] = $oldA;
	}

	protected function orderByPolarAngle()
	{
		/**
		 * @TODO Finish the Priority Queue datastructure, then use it to complete the sorting process.
		 */
		$count = $this->edgeList->count();
		for ($i = 1; $i < $count; $i++) {
			$angle = $this->getAngle($this->edgeList[0], $this->edgeList[$i]);
		}
	}

	/**
	 * Get the angle between two points.
	 *
	 * Credit to @link http://stackoverflow.com/questions/7586063/how-to-calculate-the-angle-between-a-line-and-the-horizontal-axis#answer-7586218
	 *
	 * @param  Vector<int> $point1
	 * @param  Vector<int> $point2
	 *
	 * @return int
	 */
	protected function getAngle(Vector<int> $point1, Vector<int> $point2) : int
	{
		$deltaY = $point2[1] - $point1[1];
		$deltaX = $point2[0] - $point1[0];

		return atan2($deltaY, $deltaX) * 180 * pi();
	}
}
