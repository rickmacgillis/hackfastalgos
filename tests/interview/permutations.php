<?HH

use \HackFastAlgos\Interview as Interview;

class PermutationsTest extends \PHPUnit_Framework_TestCase
{
	public function testCanFindAllPermutationsOfAThreeLetterString()
	{
		$string = 'ABC';
		$expected = Vector{
			'ABC', 'ACB',
			'BAC', 'BCA',
			'CAB', 'CBA'
		};

		$permutations = new Interview\Permutations($string);
		$permutations->permute();
		$this->assertEquals($expected, $permutations->getPermutation());
	}

	public function testCanFindAllPermutationsOfAFourLetterString()
	{
		$string = 'ABCD';
		$expected = Vector{
			'ABCD', 'ABDC', 'ACBD', 'ACDB', 'ADBC', 'ADCB',
			'BACD', 'BADC', 'BCAD', 'BCDA', 'BDAC', 'BDCA',
			'CABD', 'CADB', 'CBAD', 'CBDA', 'CDAB', 'CDBA',
			'DABC', 'DACB', 'DBAC', 'DBCA', 'DCAB', 'DCBA'
		};

		$permutations = new Interview\Permutations($string);
		$permutations->permute();
		$this->assertEquals($expected, $permutations->getPermutation());
	}
}
