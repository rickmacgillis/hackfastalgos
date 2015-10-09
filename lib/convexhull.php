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
	private int $sourceNode = 0;
	private int $numPoints = 0;

	public function __construct(private CartesianPointList $cartesianPoints){
		$this->priorityQueue = new DataStructure\PriorityQueue();
	}

	/**
	 * Operates in O(n log n) and Omega(n) time.
	 */
	public function grahamScan() : CartesianPointList
	{
		$this->prepareCoordinatesList();
		$this->numPoints = $this->cartesianPoints->count();

		for ($i = 1; $i < $this->numPoints; $i++) {

			while ($this->isCcwTurn($i) === false && $i !== $this->numPoints-1) {
				$this->decrementSourceNode();
			}

			$this->sourceNode++;
			$this->swapValues($this->sourceNode, $i);

		}

		$this->cartesianPoints->resize($this->sourceNode+1, null);
		return $this->cartesianPoints;
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function prepareCoordinatesList()
	{
		$lowestCoordinate = $this->findLowestYCoordinate();
		$this->swapValues(0, $lowestCoordinate);
		$this->orderByPolarAngle();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function findLowestYCoordinate() : int
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

	private function swapValues(int $indexA, int $indexB)
	{
		$oldA = $this->cartesianPoints[$indexA];
		$this->cartesianPoints[$indexA] = $this->cartesianPoints[$indexB];
		$this->cartesianPoints[$indexB] = $oldA;
	}

	private function orderByPolarAngle()
	{
		$this->enqueuePointsOrderedByAngle();
		$this->importCartesianPointOrderedByAngle();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function enqueuePointsOrderedByAngle()
	{
		$count = $this->cartesianPoints->count();
		for ($i = 1; $i < $count; $i++) {
			$angle = $this->getAngleBetweenPoints($this->cartesianPoints[0], $this->cartesianPoints[$i]);
			$this->priorityQueue->enqueue($this->cartesianPoints[$i], -$angle);
		}
	}

	private function getAngleBetweenPoints(Vector<int> $point1, Vector<int> $point2) : float
	{
		$deltaY = $point2[1] - $point1[1];
		$deltaX = $point2[0] - $point1[0];

		return atan2($deltaY, $deltaX) * 180 * pi();
	}

	/**
	 * Operates in Theta(n) time.
	 */
	private function importCartesianPointOrderedByAngle()
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
	private function prependLastPointToList()
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

	private function getPreviousSourceNode() : int
	{
		return $this->sourceNode === 0 ? $this->numPoints-1 : $this->sourceNode-1;
	}

	private function isCcwTurn(int $destNode) : bool
	{
		$prevSourcePoint = $this->cartesianPoints[$this->getPreviousSourceNode()];
		$sourcePoint = $this->cartesianPoints[$this->sourceNode];
		$destPoint = $this->cartesianPoints[$destNode];
		return $this->pointsAreCcw($prevSourcePoint, $sourcePoint, $destPoint);
	}

	private function pointsAreCcw(Vector $point1, Vector $point2, Vector $point3) : bool
	{
		$point2XMinusPoint1X = $point2[0] - $point1[0];
		$point3YMinusPoint1Y = $point3[1] - $point1[1];
		$point2YMinusPoint1Y = $point2[1] - $point1[1];
		$point3XMinusPoint1X = $point3[0] - $point1[0];

		$turn = $point2XMinusPoint1X * $point3YMinusPoint1Y - $point2YMinusPoint1Y * $point3XMinusPoint1X;
		return $turn >= 0;
	}

	private function decrementSourceNode()
	{
		if ($this->sourceNode > 0) {
			$this->sourceNode--;
		} else {
			$this->sourceNode = $this->numPoints-1;
		}
	}
}
