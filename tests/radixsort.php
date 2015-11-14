<?HH

class RadixSortTest extends \PHPUnit_Framework_TestCase
{
	private Vector<string> $stringVector = Vector{};
	private Vector<string> $sortedStringVector = Vector{};

	/**
	 * @before
	 */
	public function setUp()
	{
		$this->stringVector = Vector{
			'CBB',
			'DBA',
			'ABZ',
			'XYC'
		};

		$this->sortedStringVector = Vector{
			'ABZ',
			'CBB',
			'DBA',
			'XYC'
		};
	}

	public function testCanUseRadixSortToSortByLsd()
	{
		$radixSort = new \HackFastAlgos\RadixSort($this->stringVector);
		$this->assertEquals($this->sortedStringVector, $radixSort->sortAsciiLsd());
	}
}
