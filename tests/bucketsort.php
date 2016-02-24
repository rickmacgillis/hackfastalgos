<?HH

class BucketSortTest extends \PHPUnit_Framework_TestCase
{
	public function testBucketSort()
	{
		$unsorted = [0.87, 0.23, 0.53, 0.39, 0.39, 0.74, 0.5, 0.52, 0.0, 1.0];
		$sorted = [0.0, 0.23, 0.39, 0.39, 0.5, 0.52, 0.53, 0.74, 0.87, 1.0];
		$bucketSort = new \HackFastAlgos\BucketSort($unsorted, 10);
		$this->assertEquals($sorted, $bucketSort->sort());
	}
}
