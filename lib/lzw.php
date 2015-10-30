<?HH
/**
 * @author Rick Mac Gillis
 *
 * Implementation of LZW (LZW is obsolete, it's included to demonstrate a very basic compression method.)
 *
 * Learn more @link https://en.wikipedia.org/wiki/Lempel%E2%80%93Ziv%E2%80%93Welch
 * @link http://www.codeproject.com/Articles/15160/LZW-Compression-Algorithm-Implemented-in-Java
 */

namespace HackFastAlgos;

class LZW
{
	private array<String, String> $lzwData = [];

	public function compress(String $raw) : string
	{
		$lookup = null;
		$compressed = null;
		$this->setDictionaryPtr();

		$rawLength = strlen($raw);
		for ($i = 0; $i < $rawLength; $i++) {

			$lookup .= $raw[$i];

			if (empty($this->lzwData[$lookup])) {

				$this->lzwData[$lookup] = $this->makeCode($lookup);
				$compressed .= $this->lzwData[$lookup].' ';
				$lookup = $raw[$i];

				if ($i === $rawLength-1) {
					$lookup = null;
				}


			}

		}

		if (!empty($lookup)) {
			$compressed .= $this->lzwData[$lookup];
		}

		return trim($compressed);
	}

	public function decompress(string $compressed) : string
	{
		// Must finish
	}

	public function getDictionary() : String
	{
		unset($this->lzwData['ptr']);
		return json_encode($this->lzwData);
	}

	public function setDictionary(String $json)
	{
		$this->lzwData = json_decode($json, true);
	}

	private function setDictionaryPtr()
	{
		$firstDisplayableAscii = 32;
		$this->lzwData['ptr'] = $firstDisplayableAscii;
	}

	private function makeCode(String $lookup) : String
	{
		$totalAscii = 255;
		if ($this->lzwData['ptr'] > $totalAscii) {
			$code = $this->lzwData['ptr'] - $totalAscii-1;
		} else {
			$code = chr($this->lzwData['ptr']);
		}

		$this->lzwData['ptr']++;
		return $code;
	}
}
