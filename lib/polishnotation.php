<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of Polish Prefix Notation
 * Learn more @link https://en.wikipedia.org/wiki/Polish_notation
 */

namespace HackFastAlgos;

class PolishNotation
{
	private array $math = [];
	private Vector<float> $stack = Vector{};

	public function __construct(string $math){
		$this->math = explode(' ', $math);
	}

	public function toFloat() : float
	{
		$length	= count($this->math);
		for ($i = $length-1; $i >= 0; $i--) {

			$item = $this->math[$i];
			switch ($item) {

				case ' ':
					continue;
					break;

				case is_numeric($item):
					$this->addFloatNumberToStack((float) $item);
					break;

				default:
					$this->calculateAndAddToStack($item);
					break;

			}

		}

		return $this->stack->pop();
	}

	private function addFloatNumberToStack(float $number)
	{
		$this->stack[] = $number;
	}

	private function calculateAndAddToStack(string $operator)
	{
		$operand1 = $this->stack->pop();
		$operand2 = $this->stack->pop();
		$this->addFloatNumberToStack($this->calculateWithStringOperator($operator, $operand1, $operand2));
	}

	private function calculateWithStringOperator(string $operator, float $num1, float $num2) : float
	{
		switch ($operator) {

			case '+':  return $num1 +  $num2;
			case '-':  return $num1 -  $num2;
			case '*':  return $num1 *  $num2;
			case '/':  return $num1 /  $num2;
			case '%':  return $num1 %  $num2;
			case '**': return $num1 ** $num2;

		}
	}
}
