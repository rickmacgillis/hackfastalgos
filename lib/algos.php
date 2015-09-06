<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 *
 * Implements various algorithms optimized for speed.
 */

namespace HackFastAlgos;

class Algos
{
	public static function solveHanoi(int $numDisks = 5) : Vector<Vector<int>>
	{
		// Returns an array of the stacks
		// https://en.wikipedia.org/wiki/Tower_of_Hanoi
	}

	public static function solveKnapsackProblem(Vector<int> $weights, Vector<int> $values, int $sizeOfYourKnapsack, ?Vector<int> &$items = null) : int
	{
		// https://en.wikipedia.org/wiki/Knapsack_problem
		// $items, if passed in, will hold the items totaling the returned weight.
		if ($sizeOfYourKnapsack === 0) {
			return 0;
		}
	}
}
