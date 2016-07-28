<?HH
/**
 * Hack Fast Algos
 *
 * K-Sum solvers
 * Limitations / Design Choice: This code does not account for duplicate numbers in the input vector,
 * and therefore, it doesn't account for using the same number multiple times.
 *
 * A variation on this algorithm if you don't want the duplicate entries would be to skip over any
 * numbers which the outer loops are using.
 *
 * Learn more @link https://en.wikipedia.org/wiki/3SUM
 */

namespace HackFastAlgos;

class KSumNotIntegerExecption extends \Exception{}

class KSum
{
  /**
   * Operates in O(n) time and uses O(n) extra space.
   */
  public static function findAll2Sums(Vector<int> $integers, int $total) : Vector<Vector<int>>
	{
    $totalInts = $integers->count();
    $buffer = static::integerVectorToArrayMap($integers);
    $output = Vector{};

    for ($i = 0; $i < $totalInts; $i++) {

      $secondNumber = $total - $integers[$i];
      if (array_key_exists($secondNumber, $buffer)) { // && $output->contains(Vector{$secondNumber, $integers[$i]}) === false will add O(output) time! [Space-time tradeoff]
        $output->add(Vector{$integers[$i], $secondNumber});
      }

    }

    return $output;
	}

	public static function findAll3Sums(Vector<int> $integers, int $total) : Vector<Vector<int>>
	{
    $totalInts = $integers->count();
    $buffer = static::integerVectorToArrayMap($integers);
    $output = Vector{};

    for ($i = 0; $i < $totalInts; $i++) {

      for ($j = 0; $j < $totalInts; $j++) {

        $thirdNumber = $total - $integers[$i] - $integers[$j];
        if (array_key_exists($thirdNumber, $buffer)) {
          $output->add(Vector{$integers[$i], $integers[$j], $thirdNumber});
        }

      }

    }
    
    return $output;
	}

  private static function integerVectorToArrayMap(Vector<int> $integers) : array<int,int>
  {
    $totalInts = $integers->count();
    $buffer = [];
    for ($i = 0; $i < $totalInts; $i++) {

      $int = $integers[$i];
      static::throwIfNotInteger($int);
      $buffer[$int] = 1;

    }

    return $buffer;
  }

  private static function throwIfNotInteger($item)
  {
    if (!is_int($item)) {
      throw new KSumNotIntegerExecption($item);
    }
  }
}
