<?HH
/**
 * Copyright 2015 Rick Mac Gillis
 * 
 * Various algorithms involving strings
 */

namespace HackFastAlgos;

class Strings
{
	public static function isPalindrome(?string $text) : bool
	{
		if (empty($text)) {
			return true;
		}
	}
	
	public static function longestPalindrome(?string $text) : string
	{
		https://en.wikipedia.org/wiki/Longest_palindromic_substring
	}
	
	public function needlemanWunschScore(string $sequence1, string $squence2) : int
	{
		// https://en.wikipedia.org/wiki/Needleman%E2%80%93Wunsch_algorithm
	}
	
	public function huffmanEncode(string $text) : string
	{
		// https://en.wikipedia.org/wiki/Huffman_coding
	}
	
	public function huffmanDecode(string $text) : string
	{
		// https://en.wikipedia.org/wiki/Huffman_coding
	}
}
