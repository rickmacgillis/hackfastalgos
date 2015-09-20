<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various algorithms optimized for speed.
 */

namespace HackFastAlgos;

type HFAMatchPreferences	= Vector<int>;
type HFAMatchPeople			= Vector<HFAMatchPreferences>;
type HFAMatchedPeople		= Vector<Vector<int>>;
type HFAKnapsackItem		= Pair<int,int>;

class Algos
{
	public static function solveHanoi(int $numDisks = 5) : Vector<Vector<int>>
	{
		// Returns an array of the stacks
		// https://en.wikipedia.org/wiki/Tower_of_Hanoi
	}

	public static function solveKnapsackProblem(Vector<HFAKnapsackItem> $items, int $sizeOfYourKnapsack) : Vector<HFAKnapsackItem>
	{
		// https://en.wikipedia.org/wiki/Knapsack_problem
		// $items contains the weights and values for each item.
		// Returns a list of items and their weights.
		if ($sizeOfYourKnapsack === 0) {
			return 0;
		}
	}

	public static function stableMatching(HFAMatchPeople $men, HFAMatchPeople $women) : HFAMatchedPeople
	{
		// https://en.wikipedia.org/wiki/Stable_marriage_problem
	}
}
