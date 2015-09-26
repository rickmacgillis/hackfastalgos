<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class ScheduleTest extends \PHPUnit_Framework_TestCase
{
	public function testCanInsertAndExtractPriorityTasks()
	{
		$schedule = new DataStructure\Schedule();
		$schedule->insertTask('a', 5, 10); // 2 (Priority)
		$schedule->insertTask('b', 4, 10); // 2.5
		$schedule->insertTask('c', 5, 9);  // 1.8

		$this->assertSame('b', $schedule->extractTask());
		$this->assertSame('a', $schedule->extractTask());
		$this->assertSame('c', $schedule->extractTask());
	}

	public function testCanDeleteTasksWhileMaintainingExtractionCorrectness()
	{
		$schedule = new DataStructure\Schedule();
		$schedule->insertTask('a', 5, 10); // 2 (Priority)
		$schedule->insertTask('b', 4, 10); // 2.5
		$schedule->insertTask('c', 5, 9);  // 1.8

		$schedule->deleteTask('b');
		$schedule->insertTask('d', 5, 20);  // 4

		$this->assertSame('d', $schedule->extractTask());
		$this->assertSame('a', $schedule->extractTask());
		$this->assertSame('c', $schedule->extractTask());
	}
}
