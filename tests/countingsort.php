<?HH

class CountingSortTest extends \PHPUnit_Framework_TestCase
{
	private Vector<string> $stringVector = Vector{};
	private Vector<string> $sortedStringVector = Vector{};
	private Vector<string> $integerVector = Vector{};
	private Vector<string> $sortedIntegerVector = Vector{};

	/**
	 * @before
	 */
	public function setUp()
	{
		$this->stringVector = Vector{'c', 'f', 'a','a', 'c', 'g', 'r', 'd', 'f', 'z'};
		$this->sortedStringVector = Vector{'a', 'a', 'c', 'c', 'd', 'f', 'f', 'g', 'r', 'z'};

		$this->integerVector = Vector{5,2,3,0,3,1,6,-1,0};
		$this->sortedIntegerVector = Vector{-1,0,0,1,2,3,3,5,6};
	}

	public function testCanSortAsciiWithCountingSort()
	{
		$radixSort = new \HackFastAlgos\CountingSort($this->stringVector);
		$this->assertEquals($this->sortedStringVector, $radixSort->sortAscii());
	}

	/*
	public function testCanSortIntegersWithCountingSort()
	{
		$radixSort = new \HackFastAlgos\CountingSort($this->integerVector);
		$this->assertEquals($this->sortedIntegerVector, $radixSort->sortInteger());
	}
	*/
}
