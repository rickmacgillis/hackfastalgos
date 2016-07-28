<?HH

class KSumTest extends \PHPUnit_Framework_TestCase
{
  public function testCanFindAll2SumPairsWhenTheyExist()
  {
    $dataset = Vector{0,1,2,3,4,5,6,7,8,9};
    $expected = Vector{Vector{0,3},Vector{1,2},Vector{2,1},Vector{3,0}};
    $total = 3;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll2Sums($dataset, $total));
  }

  public function testCanFindNegativeNumberPairsFor2Sum()
  {
    $dataset = Vector{0,1,2,3,4,-1};
    $expected = Vector{Vector{0,3},Vector{1,2},Vector{2,1},Vector{3,0},Vector{4,-1},Vector{-1,4}};
    $total = 3;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll2Sums($dataset, $total));
  }

  public function testCanFindNumberPairsFor2SumWithNegativeTotal()
  {
    $dataset = Vector{-1,-2,0,20,-3,9,-12};
    $expected = Vector{Vector{-1,-2},Vector{-2,-1},Vector{0,-3},Vector{-3,0},Vector{9,-12},Vector{-12,9}};
    $total = -3;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll2Sums($dataset, $total));
  }

  public function testReturnsEmptyWhenNo2SumsExist()
  {
    $dataset = Vector{0,1,2,3,4,5,6,7,8,9};
    $expected = Vector{};
    $total = 100;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll2Sums($dataset, $total));
  }

  public function test2SumWillThrowExceptionForBadDataset()
  {
    $dataset = Vector{0,1.7,2,3,4,5,6,7,8,9};
    $total = 3;

    try {

      \HackFastAlgos\KSum::findAll2Sums($dataset, $total);
      $this->fail();

    } catch (\HackFastAlgos\KSumNotIntegerExecption $e) {}
  }



  public function testCanFindAll3SumPairsWhenTheyExist()
  {
    $dataset = Vector{0,1,2,3,4,5,6,7,8,9};
    $expected = Vector{
      Vector{0,0,3},
      Vector{0,1,2},
      Vector{0,2,1},
      Vector{0,3,0},
      Vector{1,0,2},
      Vector{1,1,1},
      Vector{1,2,0},
      Vector{2,0,1},
      Vector{2,1,0},
      Vector{3,0,0}
    };
    $total = 3;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll3Sums($dataset, $total));
  }

  public function testCanFindNegativeNumberPairsFor3Sum()
  {
    $dataset = Vector{0,1,2,3,4,-1};
    $expected = Vector{
      Vector{0,0,3},
      Vector{0,1,2},
      Vector{0,2,1},
      Vector{0,3,0},
      Vector{0,4,-1},
      Vector{0,-1,4},
      Vector{1,0,2},
      Vector{1,1,1},
      Vector{1,2,0},
      Vector{1,3,-1},
      Vector{1,-1,3},
      Vector{2,0,1},
      Vector{2,1,0},
      Vector{2,2,-1},
      Vector{2,-1,2},
      Vector{3,0,0},
      Vector{3,1,-1},
      Vector{3,-1,1},
      Vector{4,0,-1},
      Vector{4,-1,0},
      Vector{-1,0,4},
      Vector{-1,1,3},
      Vector{-1,2,2},
      Vector{-1,3,1},
      Vector{-1,4,0}
    };
    $total = 3;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll3Sums($dataset, $total));
  }

  public function testCanFindNumberPairsFor3SumWithNegativeTotal()
  {
    $dataset = Vector{-1,-2,0,20,-3,9,-9};
    $expected = Vector{
      Vector{-1,-1,-1},
      Vector{-1,-2,0},
      Vector{-1,0,-2},
      Vector{-2,-1,0},
      Vector{-2,0,-1},
      Vector{0,-1,-2},
      Vector{0,-2,-1},
      Vector{0,0,-3},
      Vector{0,-3,0},
      Vector{-3,0,0},
      Vector{-3,9,-9},
      Vector{-3,-9,9},
      Vector{9,-3,-9},
      Vector{9,-9,-3},
      Vector{-9,-3,9},
      Vector{-9,9,-3}
    };
    $total = -3;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll3Sums($dataset, $total));
  }

  public function testReturnsEmptyWhenNo3SumsExist()
  {
    $dataset = Vector{0,1,2,3,4,5,6,7,8,9};
    $expected = Vector{};
    $total = 100;

    $this->assertEquals($expected, \HackFastAlgos\KSum::findAll3Sums($dataset, $total));
  }

  public function test3SumWillThrowExceptionForBadDataset()
  {
    $dataset = Vector{0,1.7,2,3,4,5,6,7,8,9};
    $total = 3;

    try {

      \HackFastAlgos\KSum::findAll3Sums($dataset, $total);
      $this->fail();

    } catch (\HackFastAlgos\KSumNotIntegerExecption $e) {}
  }
}
