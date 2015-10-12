<?HH

use HackFastAlgos\DataStructure as DataStructure;

class IndexerTest extends \PHPUnit_Framework_TestCase
{
	public function testCanFindTextInOneFile()
	{
		$indexer = new DataStructure\Indexer(1000);
		$dir = $this->getFixtureDirectory();
		$file = $dir.'agile manifesto.txt';

		$indexer->importFiles(Vector{$file});

		$this->assertEquals(Vector{$file}, $indexer->findWord('Robert'));
	}

	public function testCanFindTextInMultipleFiles()
	{
		$indexer = new DataStructure\Indexer(1000);
		$dir = $this->getFixtureDirectory();
		$file1 = $dir.'agile manifesto.txt';
		$file2 = $dir.'word.txt';

		$indexer->importFiles(Vector{$file1, $file2});

		$this->assertEquals(Vector{$file1, $file2}, $indexer->findWord('word'));
	}

	public function testWhenTextIsNotPresentResponseIsEmpty()
	{
		$indexer = new DataStructure\Indexer(1000);
		$dir = $this->getFixtureDirectory();
		$file1 = $dir.'agile manifesto.txt';
		$file2 = $dir.'word.txt';

		$indexer->importFiles(Vector{$file1, $file2});

		$this->assertEquals(Vector{}, $indexer->findWord('blah'));
	}

	public function testCanGetContextSurroundingWord()
	{
		$indexer = new DataStructure\Indexer(1000);
		$dir = $this->getFixtureDirectory();
		$file1 = $dir.'agile manifesto.txt';
		$file2 = $dir.'names.txt';

		$indexer->importFiles(Vector{$file1, $file2});

		$expected = Map{
			$file1 => Vector{'Kent Beck Mike Beedle Arie van Bennekum Alistair Cockburn'},
			$file2 => Vector{'Kent Beck, Mike Beedle, Arie van Bennekum, Alistair Cockburn,'}
		};

		$this->assertEquals($expected, $indexer->getContext('Arie', 4));
	}

	public function testCanGetMultipleContextsSurroundingWord()
	{
		$indexer = new DataStructure\Indexer(1000);
		$dir = $this->getFixtureDirectory();
		$file1 = $dir.'agile manifesto.txt';
		$file2 = $dir.'hfa purpose.txt';

		$indexer->importFiles(Vector{$file1, $file2});

		$expected = Map{
			$file1 => Vector{
				'better ways of developing software by doing it and',
				'processes and tools Working software over comprehensive documentation Customer'},

			$file2 => Vector{
				'purpose is to aid software developers in their conquest'
			}
		};

		$this->assertEquals($expected, $indexer->getContext('software', 4));
	}

	public function testCanGetEmptyContextWhenWordNotPresent()
	{
		$indexer = new DataStructure\Indexer(1000);
		$dir = $this->getFixtureDirectory();
		$file = $dir.'agile manifesto.txt';

		$indexer->importFiles(Vector{$file});

		$this->assertEquals(Map{}, $indexer->getContext('blah', 4));
	}

	private function getFixtureDirectory() : string
	{
		return __DIR__.DIRECTORY_SEPARATOR.'fixtures'.DIRECTORY_SEPARATOR.'indexer'.DIRECTORY_SEPARATOR;
	}
}
