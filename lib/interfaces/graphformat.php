<?HH
/**
 * @author Rick Mac Gillis
 *
 * Interface for graph format datastructures
 */

namespace HackFastAlgos\Interfaces;

interface GraphFormat
{
	const SORT_NONE = 0;
	const SORT_VERTEX = 1;
	const SORT_WEIGHTS = 2;
	
	const int NOT_WEIGHTED = 0;
	const int WEIGHTED = 1;

	public function edgeExists(Vector $edge) : bool;
	public function isWeighted() : bool;
	public function insertEdge(Vector $edge);
}
