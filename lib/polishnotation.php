<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of Polish Prefix Notation
 * Learn more @link https://en.wikipedia.org/wiki/Polish_notation
 */

namespace HackFastAlgos;

class PolishNotation
{
	/**
	 * The array of mathematical operators and operands
	 * @type array $math
	 */
	protected array $math = [];

	/**
	 * The stack that holds the results of each mathematical statement
	 * @type Vector<float> $stack
	 */
	protected Vector<float> $stack = Vector{};

	/**
	 * Create an array from the provided mathematical string.
	 *
	 * @param  string $math
	 */
	public function __construct(string $math){
		$this->math = explode(' ', $math);
	}

	/**
	 * Retrieve the float value of the Polish Prefix Notation.
	 *
	 * @return float
	 */
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

	/**
	 * Add a float number to the stack.
	 *
	 * @param float $number
	 */
	protected function addFloatNumberToStack(float $number)
	{
		$this->stack[] = $number;
	}

	/**
	 * Perform the desired mathematical calculation, then add the result to the stack.
	 *
	 * @param  string $operator
	 */
	protected function calculateAndAddToStack(string $operator)
	{
		$operand1 = $this->stack->pop();
		$operand2 = $this->stack->pop();
		$this->addFloatNumberToStack($this->calculateWithStringOperator($operator, $operand1, $operand2));
	}

	/**
	 * Calculate the result of a mathematical statement while using the
	 * string based version of an operator.
	 *
	 * @param  string $operator
	 * @param  float  $num1
	 * @param  float  $num2
	 *
	 * @return float
	 */
	protected function calculateWithStringOperator(string $operator, float $num1, float $num2) : float
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
