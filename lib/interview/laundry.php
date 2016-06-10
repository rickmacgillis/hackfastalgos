<?HH
/**
 * Asked in my Amazon practice interview through Gainlo:
 *
 * Puzzle:
 * There are N machines in a laundry. They have infinite capacity.
 * Now a truck of cloths is unloaded for washing and randomly assigned to each machine.
 * In this process the manager didn't balance the load of cloths to clean. Now rebalancing is required.
 *
 * Rebalancing proceeds in rounds. Each time, a machine can transfer at most one cloth to each of its
 * neighbors. Neighbors of the machine i are the machine i-1 and i+1 (machines 1 and N have only one neighbor each,
 * 2 and N-1 respectively).
 *
 * The goal of rebalancing is to achieve that all machines have the same number of cloths.
 * Given the number of cloths initially assigned to each machine, you are asked to determine the minimal number of
 * rounds needed to achieve the state when every machine has the same number of cloths, or to determine that such
 * rebalancing is not possible.
 */

namespace HackFastAlgos\Interview;

class LaundryCannotBalanceException extends \Exception{}

class Laundry
{
	private int $minRounds = 0;
	private int $totalCloths = 0;

	public function __construct(private array $machineLoads = [])
	{
		$this->setTotalCloths();
	}

	/**
	 * Operates in Theta(N) time where N is the number of machines.
	 */
	public function balance()
	{
		$this->throwIfCannotBalance();

		$totalMachines = count($this->machineLoads);
		$desiredLoadSize = $this->getDesiredLoadSize();
		$maxDelta = 0;
		for ($i = 0; $i < $totalMachines; $i++) {

			$currentLoad = $this->machineLoads[$i];
			$delta = abs($desiredLoadSize - $currentLoad);
			$maxDelta = max($maxDelta, $delta);

		}

		$this->minRounds = $maxDelta;
	}

	public function getMinRounds() : int
	{
		return $this->minRounds;
	}

	/**
	 * Operates in Theta(N) time where N is the number of machines.
	 */
	private function setTotalCloths()
	{
		$totalMachines = count($this->machineLoads);
		for ($i = 0; $i < $totalMachines; $i++) {
			$this->totalCloths += $this->machineLoads[$i];
		}
	}

	private function throwIfCannotBalance()
	{
		if ($this->isBalanceable() === false) {
			throw new LaundryCannotBalanceException();
		}
	}

	private function isBalanceable() : bool
	{
		$totalMachines = count($this->machineLoads);
		return $this->totalCloths % $totalMachines === 0;
	}

	private function getDesiredLoadSize() : int
	{
		$totalMachines = count($this->machineLoads);
		return $this->totalCloths / $totalMachines;
	}
}
