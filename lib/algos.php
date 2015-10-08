<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implements various algorithms optimized for speed.
 */

namespace HackFastAlgos;

newtype MatchPreferences	= Vector<int>;
newtype MatchPeople			= Vector<MatchPreferences>;
newtype MatchedPeople		= Vector<Vector<int>>;
newtype KnapsackItem		= Pair<int,int>;

class Algos
{
	public static function solveHanoi(int $numDisks = 5) : Vector<Vector<int>>
	{
		// Returns an array of the stacks
		// https://en.wikipedia.org/wiki/Tower_of_Hanoi
	}

	public static function solveKnapsackProblem(Vector<KnapsackItem> $items, int $sizeOfYourKnapsack) : Vector<KnapsackItem>
	{
		// https://en.wikipedia.org/wiki/Knapsack_problem
		// $items contains the weights and values for each item.
		// Returns a list of items and their weights.
		if ($sizeOfYourKnapsack === 0) {
			return 0;
		}
	}

	public static function stableMatching(MatchPeople $men, MatchPeople $women) : MatchedPeople
	{
		// https://en.wikipedia.org/wiki/Stable_marriage_problem
	}
}
