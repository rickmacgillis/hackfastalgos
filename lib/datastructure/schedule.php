<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of a job scheduler
 */

namespace HackFastAlgos\DataStructure;

class Schedule
{
	private ?PriorityQueue $taskQueue = null;

	public function __construct()
	{
		$this->taskQueue = new PriorityQueue();
	}

	/**
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @param T $task		The identifier for the task
	 * @param int $length	A numerical representation of how long the task takes to run (Higher = slower)
	 * @param int $weight	The priority of the task (Higher = more important)
	 */
	public function insertTask<T>(T $task, int $length, int $weight)
	{
		$this->taskQueue->enqueue($task, (float) ($weight/$length));
	}

	/**
	 * Operates in O(log n) or Omega(1) time.
	 */
	public function extractTask<T>() : T
	{
		return $this->taskQueue->dequeue();
	}

	/**
	 * Operates in O(n log n) time or Omega(1) time.
	 */
	public function deleteTask<T>(T $task)
	{
		$this->taskQueue->delete($task);
	}
}
