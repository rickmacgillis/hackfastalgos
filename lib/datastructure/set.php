<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of a set
 */

namespace HackFastAlgos\DataStructure;

class Set extends HashTableOA implements \Iterator, \Countable
{
	public function insert<T>(T $item, T $itemOverride = 0)
	{
		parent::insert($item, $item);
	}
}
