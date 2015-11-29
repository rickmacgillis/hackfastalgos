<?HH

use \HackFastAlgos\Interview as Interview;

class FizzBuzzTest extends \PHPUnit_Framework_TestCase
{
	public function testCanGetCorrectFizzBuzzStatementFor0Through100()
	{
		$response = Interview\FizzBuzz::getFizzBuzz(0, 100);
		$expected = '0:FizzBuzz 3:Fizz 5:Buzz 6:Fizz 9:Fizz 10:Buzz 12:Fizz 15:FizzBuzz 18:Fizz 20:Buzz '.
					'21:Fizz 24:Fizz 25:Buzz 27:Fizz 30:FizzBuzz 33:Fizz 35:Buzz 36:Fizz 39:Fizz 40:Buzz '.
					'42:Fizz 45:FizzBuzz 48:Fizz 50:Buzz 51:Fizz 54:Fizz 55:Buzz 57:Fizz 60:FizzBuzz 63:Fizz '.
					'65:Buzz 66:Fizz 69:Fizz 70:Buzz 72:Fizz 75:FizzBuzz 78:Fizz 80:Buzz 81:Fizz 84:Fizz '.
					'85:Buzz 87:Fizz 90:FizzBuzz 93:Fizz 95:Buzz 96:Fizz 99:Fizz 100:Buzz';
		$this->assertSame($expected, $response);
	}
}
