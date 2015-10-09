<?HH
/**
 * Hack Implementation of MurmurHash3
 *
 * @author Stefano Azzolini (lastguest@gmail.com)
 * @see https://github.com/lastguest/murmurhash-php
 * @author Gary Court (gary.court@gmail.com)
 * @see http://github.com/garycourt/murmurhash-js
 * @author Austin Appleby (aappleby@gmail.com)
 *
 * @author Rick Mac Gillis
 *
 * Learn more @link https://code.google.com/p/smhasher/wiki/MurmurHash3
 */

namespace HackFastAlgos;

class MurmurHash3
{
	private int $hash = 0;
	private string $key = '';
	private int $keyHash = 0;
	private int $remainder = 0;
	private int $offset = 0;

	public function hash<T>(T $key, int $seed = 0) : int
	{
		$this->key = (string) $key;
		$this->hash = $seed;

		$this->makeHash();
		$this->handleEdgeCases();
		$this->finalize32BitHash();

		return $this->hash;
	}

	private function makeHash()
	{
		$keyLen = strlen($this->key);
		for ($this->offset = 0, $bytes = $keyLen - ($this->remainder = $keyLen & 3) ; $this->offset < $bytes;) {

			$this->make8BitKeyMask();
			$this->offset++;
			$this->keyHash = $this->multiplyHashBy($this->keyHash, 0xcc9e2d51);
			$this->keyHash = $this->keyHash << 15 | $this->keyHash >> 17;
			$this->keyHash = $this->multiplyHashBy($this->keyHash, 0x1b873593);
			$this->hash ^= $this->keyHash;
			$this->hash  = $this->hash << 13 | $this->hash >> 19;
			$hashB = $this->multiplyHashBy($this->hash, 5);
			$this->hash  = ((($hashB & 0xffff) + 0x6b64) + (((($hashB >> 16) + 0xe654) & 0xffff) << 16));

		}
	}

	private function make8BitKeyMask()
	{
		$this->keyHash = ((ord($this->key[$this->offset]) & 0xff))
			| ((ord($this->key[++$this->offset]) & 0xff) << 8)
			| ((ord($this->key[++$this->offset]) & 0xff) << 16)
			| ((ord($this->key[++$this->offset]) & 0xff) << 24);
	}

	private function handleEdgeCases()
	{
		$this->keyHash = 0;

		switch ($this->remainder) {

			case 3:
				$this->keyHash ^= (ord($this->key[$this->offset + 2]) & 0xff) << 16;
				// No break

			case 2:
				$this->keyHash ^= (ord($this->key[$this->offset + 1]) & 0xff) << 8;
				// No break

			case 1:
				$this->keyHash ^= (ord($this->key[$this->offset]) & 0xff);
				$this->keyHash  = $this->multiplyHashBy($this->keyHash, 0xcc9e2d51);
				$this->keyHash  = $this->keyHash << 15 | $this->keyHash >> 17;
				$this->keyHash  = $this->multiplyHashBy($this->keyHash, 0x1b873593);
				$this->hash ^= $this->keyHash;
				// No break

		}
	}

	private function finalize32BitHash()
	{
		$this->hash ^= strlen($this->key);
		$this->hash ^= $this->hash >> 16;
		$this->hash  = $this->multiplyHashBy($this->hash, 0x85ebca6b);
		$this->hash ^= $this->hash >> 13;
		$this->hash  = $this->multiplyHashBy($this->hash, 0xc2b2ae35);
		$this->hash ^= $this->hash >> 16;
	}

	private function multiplyHashBy(int $hash, int $multiplier) : int
	{
		return ((($hash & 0xffff) * $multiplier) + (((($hash >> 16) * $multiplier) & 0xffff) << 16)) & 0xffffffff;
	}
}
