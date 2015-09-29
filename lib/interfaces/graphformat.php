<?HH
/**
 * @author Rick Mac Gillis
 *
 * Interface for graph format datastructures
 */

namespace HackFastAlgos\Interfaces;

interface GraphFormat
{
	/**
	 * Signifies format is not weighted
	 * @type int NOT_WEIGHTED
	 */
	const int NOT_WEIGHTED = 0;

	/**
	 * Signifies format is weighted
	 * @type int WEIGHTED
	 */
	const int WEIGHTED = 1;

	public function edgeExists(Vector $edge) : bool;
	public function isWeighted() : bool;
	public function insertEdge(Vector $edge);
}
