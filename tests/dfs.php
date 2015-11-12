<?HH

use \HackFastAlgos\DataStructure as DataStructure;

class DFSTest extends \PHPUnit_Framework_TestCase
{
	private Map<int, Vector<Vector<int>>> $adjListMap = Map{};

	/**
	 * @before
	 */
	public function setUp()
	{
		$this->adjListMap = Map{
			0 => Vector{1, 2},
			1 => Vector{4, 5, 3},
			4 => Vector{6},
			5 => Vector{7},
			10 => Vector{20}
		};
	}

	public function testCanPerformDFSSearch()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		$expected = Map{
			1 => 0,
			4 => 1,
			6 => 4,
			5 => 1,
			7 => 5,
			3 => 1,
			2 => 0
		};

		$this->assertEquals($expected, $dfs->getEdgeList());
	}

	public function testCanChangeSourceAfterConstruction()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		$expected = Map{
			1 => 0,
			4 => 1,
			6 => 4,
			5 => 1,
			7 => 5,
			3 => 1,
			2 => 0
		};

		$this->assertEquals($expected, $dfs->getEdgeList());

		$dfs->resetDFSForSource(1);
		$dfs->search();

		$expected = Map{
			4 => 1,
			6 => 4,
			5 => 1,
			7 => 5,
			3 => 1
		};

		$this->assertEquals($expected, $dfs->getEdgeList());
	}

	public function testPathExistsForValidPathAnNotForInvalidPath()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		$expected = Map{
			1 => 0,
			4 => 1,
			6 => 4,
			5 => 1,
			7 => 5,
			3 => 1,
			2 => 0
		};

		$this->assertEquals($expected, $dfs->getEdgeList());

		$this->assertTrue($dfs->hasPath(1));
		$this->assertFalse($dfs->hasPath(10));

		$dfs->resetDFSForSource(10);
		$this->assertTrue($dfs->hasPath(10));
		$this->assertFalse($dfs->hasPath(20));
	}

	public function testCanGetThePathBetweenTwoNodes()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		$stack = $dfs->getpath(0, 7);
		$this->assertSame(0, $stack->pop());
		$this->assertSame(1, $stack->pop());
		$this->assertSame(5, $stack->pop());
		$this->assertSame(7, $stack->pop());
	}

	public function testWillThrowExceptionWhenPathDoesNotExist()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		try {

			$stack = $dfs->getpath(10, 20);
			$this->fail();

		} catch (\HackFastAlgos\DFSNoPathExistsException $e){}
	}

	public function testCanGetTotalComponents()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->countComponents();

		$this->assertSame(2, $dfs->getTotalComponents());
	}

	public function testCanGetTotalVerticesInAComponent()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->countComponents();

		$this->assertSame(8, $dfs->getComponentSizeFromVertex(0));
		$this->assertSame(8, $dfs->getComponentSizeFromVertex(4));
		$this->assertSame(2, $dfs->getComponentSizeFromVertex(10));
	}

	public function testCanCheckIfTwoVertecesAreConnectedThroughAPath()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->countComponents();

		$this->assertTrue($dfs->isConnectedTo(10, 20));
		$this->assertTrue($dfs->isConnectedTo(0, 5));
		$this->assertTrue($dfs->isConnectedTo(0, 7));
		$this->assertTrue($dfs->isConnectedTo(1, 7));

		$this->assertFalse($dfs->isConnectedTo(0, 10));
		$this->assertFalse($dfs->isConnectedTo(7, 20));
	}

	public function testWillThrowExceptionWhenVertexIsNotInAComponent()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);

		try {

			$dfs->isConnectedTo(10, 20);
			$this->fail();

		} catch (\HackFastAlgos\DFSVertexDoesNotExistException $e){}

		$dfs->countComponents();

		try {

			$dfs->isConnectedTo(70, 0);
			$this->fail();

		} catch (\HackFastAlgos\DFSVertexDoesNotExistException $e){}

		try {

			$dfs->isConnectedTo(0, 99);
			$this->fail();

		} catch (\HackFastAlgos\DFSVertexDoesNotExistException $e){}
	}

	public function testCanCheckIfCyclesExist()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		$this->assertFalse($dfs->hasCycles());

		$cycle = Map{
			0 => Vector{1},
			1 => Vector{0}
		};

		$dfs = new \HackFastAlgos\DFS($cycle, 0);
		$dfs->search();

		$this->assertTrue($dfs->hasCycles());

		$cycle = Map{
			0 => Vector{1},
			1 => Vector{2},
			2 => Vector{0}
		};

		$dfs = new \HackFastAlgos\DFS($cycle, 0);
		$dfs->search();

		$this->assertTrue($dfs->hasCycles());

		$cycle = Map{
			0 => Vector{1},
			1 => Vector{2},
			2 => Vector{1}
		};

		$dfs = new \HackFastAlgos\DFS($cycle, 0);
		$dfs->search();

		$this->assertTrue($dfs->hasCycles());
	}

	public function testCanCheckIfGraphIsBipartite()
	{
		$dfs = new \HackFastAlgos\DFS($this->adjListMap, 0);
		$dfs->search();

		$this->assertFalse($dfs->hasCycles());
		$this->assertTrue($dfs->isBipartite());

		$evenCycle = Map{
			0 => Vector{1},
			1 => Vector{0}
		};

		$dfs = new \HackFastAlgos\DFS($evenCycle, 0);
		$dfs->search();

		$this->assertTrue($dfs->hasCycles());
		$this->assertTrue($dfs->isBipartite());

		$oddCycle = Map{
			0 => Vector{1},
			1 => Vector{2},
			2 => Vector{0}
		};

		$dfs = new \HackFastAlgos\DFS($oddCycle, 0);
		$dfs->search();

		$this->assertTrue($dfs->hasCycles());
		$this->assertFalse($dfs->isBipartite());
	}
}
