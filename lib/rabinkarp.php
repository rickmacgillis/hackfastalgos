<?HH
/**
 * Hack Fast Algos
 *
 * Implementation of the Rabin Karp algorithm
 * Learn more @link http://algs4.cs.princeton.edu/53substring/RabinKarp.java.html
 */

namespace HackFastAlgos;

class RabinKarp
{
  const ALPHABET_SIZE = 256;

  /**
   * Operates in Omega(1) or O(s + (T-s)) where T is $fullText and s is $substring.
   */
  public function hasSubstring(string $fullText, string $substring) :bool
  {
    $substrLength = strlen($substring);
    $fullTextLength = strlen($fullText);

    if ($substrLength > $fullTextLength) {
      return false;
    }

    $substrHash = $this->fullRabinFingerprint($substring);
    $lastHash = 0;

    for ($i = 0; $i <= $fullTextLength - $substrLength; $i++) {

      $lastHash = $this->rabinFingerprint($fullText, $i, $substrLength, $lastHash);
      if ($lastHash === $substrHash) {
        return true;
      }

    }

    return false;
  }

  /**
   * Operates in O(N) or Omega(1) time.
   */
  public function rabinFingerprint(string $fullText, int $start, int $length, int $lastHash = 0) : int
  {
    $lastHash = 0;
    $substr = substr($fullText, $start, $length);
    if ($lastHash === 0) {
      return $this->fullRabinFingerprint($substr);
    }

    $removeCharHash = $this->getCharHash($fullText[$start-1], $length-1);
    $addChar = $this->getCharValue($fullText[$start+$length-1]);
    return ($lastHash - $removeCharHash) * static::ALPHABET_SIZE + $addChar;
  }

  /**
   * Operates in Theta(N) time.
   */
  private function fullRabinFingerprint(string $fullText) : int
  {
    $lastHash = 0;
    $length = strlen($fullText);
    for ($i = 0; $i < $length; $i++) {

      $power = $length-1-$i;
      $lastHash += $this->getCharHash($fullText[$i], $power);

    }

    return $lastHash;
  }

  private function getCharHash(string $char, int $position) : int
  {
    return $this->getCharValue($char) * pow(static::ALPHABET_SIZE, $position);
  }

  private function getCharValue(string $char) : int
  {
    return ord($char);
  }
}
