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

	public function testOneStringIsAPermutationOfAnotherString()
	{
		$permutations = new Interview\Permutations('ABC');
		$this->assertTrue($permutations->isAPermutationOf('CBA'));
		$this->assertTrue($permutations->isAPermutationOf('BCA'));
	}

	public function testTwoStringsAreNotPermutationsOfEachOther()
	{
		$permutations = new Interview\Permutations('ABC');
		$this->assertFalse($permutations->isAPermutationOf('XYZ'));
		$this->assertFalse($permutations->isAPermutationOf('ABX'));
		$this->assertFalse($permutations->isAPermutationOf('AXC'));
		$this->assertFalse($permutations->isAPermutationOf('XBC'));
	}
}
