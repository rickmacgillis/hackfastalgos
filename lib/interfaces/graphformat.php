<?HH
/**
 * Hack Fast Algos
 *
 * Interface for graph format datastructures
 */

namespace HackFastAlgos\Interfaces;

interface GraphFormat
{
	const int NOT_WEIGHTED = 0;
	const int WEIGHTED = 1;

	public function edgeExists(Vector $edge) : bool;
	public function isWeighted() : bool;
	public function insertEdge(Vector $edge);
	public function setWeighted();
	public function setNotWeighted();
}
