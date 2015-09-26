<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a job scheduler
 */

namespace HackFastAlgos\DataStructure;

class Schedule extends PriorityQueue
{
	/**
	 * Insert a task into the scheduler.
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @param T $task		The identifier for the task
	 * @param int $length	A numerical representation of how long the task takes to run (Higher = slower)
	 * @param int $weight	The priority of the task (Higher = more important)
	 */
	public function insertTask<T>(T $task, int $length, int $weight)
	{
		$this->enqueue($task, (float) ($weight/$length));
	}

	/**
	 * Extract a task
	 *
	 * Operates in O(log n) or Omega(1) time.
	 *
	 * @return T The identifier for the task
	 */
	public function extractTask<T>() : T
	{
		return $this->dequeue();
	}

	/**
	 * Delete a task
	 *
	 * Operates in O(n log n) time or Omega(1) time.
	 *
	 * @param T $task The task identifier to delete
	 */
	public function deleteTask<T>(T $task)
	{
		$this->delete($task);
	}
}
