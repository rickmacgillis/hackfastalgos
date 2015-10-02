<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Graham Scan
 * Learn more @link https://en.wikipedia.org/wiki/Graham_scan
 */

use HackFastAlgos\DataStructure as DataStructure;

namespace HackFastAlgos;

type CartesianPointList = Vector<Vector<int>>;
type ConvexHullVector = Vector<Vector<Vector<int>>>;

class ConvexHull
{
	private ?DataStructure\PriorityQueue $priorityQueue = null;

	public function __construct(private CartesianPointList $cartesianPoints){
		$this->priorityQueue = new DataStructure\PriorityQueue();
	}

	/**
	 * Operates in O(n log n) and Omega(n) time.
	 */
	public function grahamScan() : CartesianPointList
	{
		// BROKEN - MUST FIX
		$this->prepareCoordinatesList();

		$sourceNode = 1;
		$numPoints = $this->cartesianPoints->count();
		for ($i = 2; $i < $numPoints; $i++) {

			$prevSourcePoint = $this->cartesianPoints[$sourceNode-1];
			$sourcePoint = $this->cartesianPoints[$sourceNode];
			while ($this->clockwiseTurnCompare($prevSourcePoint, $sourcePoint, $this->cartesianPoints[$i]) <= 0) {

				if ($sourceNode > 1) {
					$sourceNode--;
				} elseif ($i === $numPoints-1) {
					break;
				} else {
					$i++;
				}

			}

			$sourceNode++;
			$this->swapValues($sourceNode, $i);

		}

		return $this->cartesianPoints;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	protected function prepareCoordinatesList()
	{
		$lowestCoordinate = $this->findLowestYCoordinate();
		$this->swapValues(0, $lowestCoordinate);
		$this->orderByPolarAngle();
		$this->prependLastPointToList();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	protected function findLowestYCoordinate() : int
	{
		$count = $this->cartesianPoints->count();
		$lowestPoint = 0;
		for ($i = 0; $i < $count; $i++) {

			if ($this->cartesianPoints[$i][1] < $this->cartesianPoints[$lowestPoint][1]) {
				$lowestPoint = $i;
			}

		}

		return $lowestPoint;
	}

	protected function swapValues(int $indexA, int $indexB)
	{
		$oldA = $this->cartesianPoints[$indexA];
		$this->cartesianPoints[$indexA] = $this->cartesianPoints[$indexB];
		$this->cartesianPoints[$indexB] = $oldA;
	}

	protected function orderByPolarAngle()
	{
		$this->enqueuePointsOrderedByAngle();
		$this->importCartesianPointOrderedByAngle();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	protected function enqueuePointsOrderedByAngle()
	{
		$count = $this->cartesianPoints->count();
		for ($i = 1; $i < $count; $i++) {
			$angle = $this->getAngleBetweenPoints($this->cartesianPoints[0], $this->cartesianPoints[$i]);
			$this->priorityQueue->enqueue($this->cartesianPoints[$i], $angle);
		}
	}

	protected function getAngleBetweenPoints(Vector<int> $point1, Vector<int> $point2) : float
	{
		$deltaY = $point2[1] - $point1[1];
		$deltaX = $point2[0] - $point1[0];

		return atan2($deltaY, $deltaX) * 180 * pi();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	protected function importCartesianPointOrderedByAngle()
	{
		$count = $this->priorityQueue->count();
		$this->cartesianPoints = Vector{$this->cartesianPoints[0]};
		for ($i = 0; $i < $count; $i++) {
			$this->cartesianPoints[] = $this->priorityQueue->dequeue();
		}
	}

	/**
	 * Operates in Theta(n) time.
	 */
	protected function prependLastPointToList()
	{
		$numPoints = $this->cartesianPoints->count();
		$formatted = Vector{
			$this->cartesianPoints[$numPoints-1]
		};

		for ($i = 0; $i < $numPoints; $i++) {
			$formatted[] = $this->cartesianPoints[$i];
		}

		$this->cartesianPoints = $formatted;
	}

	protected function clockwiseTurnCompare(Vector $point1, Vector $point2, Vector $point3) : int
	{
		$point2XMinusPoint1X = $point2[0] - $point1[0];
		$point3YMinusPoint1Y = $point3[1] - $point1[1];
		$point2YMinusPoint1Y = $point2[1] - $point1[1];
		$point3XMinusPoint1X = $point3[0] - $point1[0];

		$ccw = $point2XMinusPoint1X * $point3YMinusPoint1Y - $point2YMinusPoint1Y * $point3XMinusPoint1X;
		return -$ccw;
	}
}
