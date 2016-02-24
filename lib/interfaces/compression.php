<?HH
/**
 * Hack Fast Algos
 *
 * Abstract class for Compression algorithm objects
 */

namespace HackFastAlgos\Interfaces;

abstract class Compression
{
	public function __construct(private String $text){}
	abstract public function encode() : String;
	abstract public function decode() : String;
}
