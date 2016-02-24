<?HH
/**
 * Hack Fast Algos
 *
 * Implementations of various geometric algorithms
 */

class Geometry
{
	public static function OneDRangeSearch()
	{
		/*
		 * Use a KD-Tree to find the number of points in a given range. Also create a method to retrieve
		 * the items in that range.
		 */
	}

	public static function countLineIntersections()
	{
		// https://en.wikipedia.org/wiki/Sweep_line_algorithm
		// Use a KD-Tree to implement this code: http://algs4.cs.princeton.edu/93intersection/HVIntersection.java.html
	}

	public static function twoDRangeSearch()
	{
		// Search a KD-Tree to find points that lie within a given rectangle's area.
	}

	public static function nearestNeighborForPoint(Vector $point)
	{
		// Search a KD-Tree to locate the closest point to a given point.
		// http://programmizm.sourceforge.net/blog/2011/nearest-neighbor-search-using-kd-trees
	}

	public static function countRectIntersections()
	{
		// http://www.cs.princeton.edu/~rs/AlgsDS07/17GeometricSearch.pdf
	}
}
