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
	private Vector $edgeList = Vector{};

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
			$angle = $this->getAngleBetweenPoints($this->edgeList[0], $this->edgeList[$i]);
		}
	}

	protected function getAngleBetweenPoints(Vector<int> $point1, Vector<int> $point2) : int
	{
		$deltaY = $point2[1] - $point1[1];
		$deltaX = $point2[0] - $point1[0];

		return atan2($deltaY, $deltaX) * 180 * pi();
	}
}
