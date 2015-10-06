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

	/**
	 * Get a truely random number.
	 *
	 * Credits to @link http://php.net/manual/en/function.openssl-random-pseudo-bytes.php#104322
	 */
	public static function getRandomNumber(int $min, int $max) : int
	{
		$range = $max - $min;
		if ($range <= 0) {
			return $min;
		}

		$log = log($range, 2);
		$lenInBytes = (int) ($log / 8) + 1;
		$lenInBits = (int) $log + 1;

		// set all lower bits to 1
		$filter = (int) (1 << $lenInBits) - 1;

		do {
		    $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($lenInBytes)));

			// discard irrelevant bits
		    $rnd = $rnd & $filter;
		} while ($rnd >= $range);

		return $min + $rnd;
	}
}
