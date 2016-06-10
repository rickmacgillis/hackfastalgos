<?HH

use HackFastAlgos\Interview as Interview;

class LaundryTest extends \PHPUnit_Framework_TestCase
{
	public function testWillThrowExceptionWhenUnableToBalance()
	{
		$machineLoads = [5,6,8,8];
		$laundry = new Interview\Laundry($machineLoads);

		try {
			$laundry->balance();
			$this->fail();
		} catch (Interview\LaundryCannotBalanceException $e){}
	}

	public function testCanFindMinimalNumberOfBalancingRounds()
	{
		$machineLoads = [6,4,6,4];
		$laundry = new Interview\Laundry($machineLoads);
		$laundry->balance();

		$this->assertSame(1, $laundry->getMinRounds());

		$machineLoads = [5,3];
		$laundry = new Interview\Laundry($machineLoads);
		$laundry->balance();

		$this->assertSame(1, $laundry->getMinRounds());

		$machineLoads = [2,3,4];
		$laundry = new Interview\Laundry($machineLoads);
		$laundry->balance();

		$this->assertSame(1, $laundry->getMinRounds());

		$machineLoads = [7,6,2];
		$laundry = new Interview\Laundry($machineLoads);
		$laundry->balance();

		$this->assertSame(3, $laundry->getMinRounds());

		$machineLoads = [6,6,3];
		$laundry = new Interview\Laundry($machineLoads);
		$laundry->balance();

		$this->assertSame(2, $laundry->getMinRounds());

		$machineLoads = [1,4,4];
		$laundry = new Interview\Laundry($machineLoads);
		$laundry->balance();

		$this->assertSame(2, $laundry->getMinRounds());
	}
}
