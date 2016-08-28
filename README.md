Hack Fast Algos
===============

[![Build Status](https://travis-ci.org/cozylife/hackfastalgos.svg?branch=master)](https://travis-ci.org/cozylife/hackfastalgos)
[![Code Climate](https://codeclimate.com/github/cozylife/hackfastalgos/badges/gpa.svg)](https://codeclimate.com/github/cozylife/hackfastalgos)
[![Stories in Ready](https://badge.waffle.io/cozylife/hackfastalgos.png?label=ready&title=Ready)](https://waffle.io/cozylife/hackfastalgos)

**STATUS:** IN DEVELOPMENT

Hack Fast Algos brings all of the most popular speed and space-efficient algorithms together in one library. The files
are completely written in Hack, so they'll work with your HHVM installation with Hack enabled.

Contents
--------
1. [Purpose](#purpose)
2. [List of Algorithms](#list-of-algorithms)
3. [List of Data Structures](#list-of-data-structures)
4. [List of Interview Questions/Puzzels](#list-of-interview-puzzles)
5. [Notes on Slower Algorithms](#notes-on-slower-algorithms)
6. [Why is X Algorithm Not Present?](#why-is-x-application-of-y-algorithm-not-in-the-library)
7. [Contributing](#contributing)
8. [Get This Library in Another Language](#this-library-in-other-languages)
9. [Credits and Further Learning](#credits-and-further-learning-resources)

Purpose
-------

This library's main purpose is to aid web developers in their conquest of learning algorithms and data
structures. If you intend to use the library as a learning or teaching tool, be advised that there are often multiple
ways to write the algorithm concepts. For instance, MergeSort does not need to run its recursion asynchronously, and
certain programming languages do not support asynchronous work-flows. The anthem of any good algorithm designer is,
"Can we make it better [faster/more memory efficient/more memory focused]?"

Companies rely on speed and space-efficient code to keep their websites and projects running smoothly. You'll find
that some of these algorithms are only either efficient on large data sets (Ex. Lots of array elements) or require
appropriate parameters for the task at hand. (Such as the configuration of Quick Sort's parameters) I've commented
on each algorithm's running times and storage requirements by using asymptotic notation.

Keep in mind that HHVM is written primarily in C++ and C, and has a lot of built-in functionality that uses these
algorithms. (Ex. sort() uses an implementation of Quick Sort) Therefore, it's often faster to use the built in
functionality. However built in functions do not always give you the fine tuning capabilities required when working
with larger datasets.

List of Algorithms
------------------

Every algorithm is grouped into a class of similar algorithms. Below is a list of classes, followed by the list of
algorithms defined in that class.

* **Algos**
* **BFS**
* **BucketSort**
	* Bucket Soft sorting algorithm
* **ConvexHull**
	* Calculate the convex hull using a Graham Scan.
* **CountingSort**
	* Counting sort sorting algorithm
* **Cryptography**
	* Algorithm to generate a secure random number
* **DFS**
	* Implementations of various DFS-based algorithms
* **DijkstrasAlgorithm**
	* Implementation of Dijkstra's Algorithm using a min priority queue
* **FordFulkerson**
	* Max Flow algorithm based on Min-Cut
* **Geometry**
* **Graph**
* **GraphFormat**
	* Convert between edge lists, adjacency lists, and adjacency matrices.
* **HuffmanCode**
	* Huffman encode
	* Huffman decode
* **Kosaraju**
	* Implementation of Kosaraju's Strongly Connected Components algorithm
* **KSum**
	* Implementation of 2-Sum and 3-Sum solvers
* **LZW**
* **Math**
* **MatrixMultiply**
	* Strassen's Matrix Multiplication
* **MatrixRotate**
	* Algorithms to rotate and flip a matrix
* **MedianHeap**
	* Get the median number in a stream if integers.
* **MergeSort**
	* Merge Sort softing algorithm
* **MostFrequentWord**
	* Calculate the most frequent word in the given text.
* **MST**
	* Minimum Spanning Tree algorithms
* **MurmurHash3**
	* Implementation of MurmurHash3
* **Palindrome**
	* isPalindrome
	* Manacher's Algorithm for finding the longest palindrome in the desired text
* **Partition**
	* Partition a vector around an integer.
* **PolishNotation**
	* An implementation of Polish Prefix Notation
* **QuickSelect**
	* This Quick Select implementation is used to select the kth-smallest item in a vector.
* **QuickSort**
	* Quick Sort sorting algorithm
* **RabinKarp**
	* Implementation of the Rabin-Karp substring search algorithm
	* Implementation of Rabin Fingerprint hashing
* **RadixSort**
	* Implementations for both LSD and MSD
* **RegEx**
	* Rudimentary implementation of a regular expression interpreter
	* Grep
* **RunLengthCompression**
	* Run-length compression algorithm for binary data
* **Search**
	* Binary search
	* Brute force search
* **ShortestPath**
	* Algorithms for shortest path problems
* **Sort**
	* Selection Sort
	* Bubble Sort
	* Insert Sort
	* Shell Sort (Uses Tokunda's gap algorithm)
	* Heap Sort
	* Fisher-Yates Shuffle
* **Strings**
	* Suffix array
	* Longest prefix
	* Longest repeated substring
* **SubString**
	* Two versions of the brute force method which do the same thing and are written differently
	* KMP [Knuth-Morris-Pratt]
	* KMP Improved
	* Boyer-Moore
* **TopSort**
	* Implementation of Topological Sort

List of Data Structures
-----------------------

All data structures use the namespace `\HackFastAlgos\DataStructure`. Below is a list of data structures.
Data structures which employ a comparative function (`compare()`) may have said method overridden to extend
the capabilities of that data structure. All data uses the generic type `T` for that reason, where appropriate.

* **AdjList**
	* Adjacency list for graphs
* **AdjMatrix**
	* Adjacency matrix object for graphs
* **AVLTree**
	* Implementation of an AVL Tree
* **Bag**
	* Implementation of a bag
* **BloomFilter**
	* Implementation of a Bloom filter
* **BPlusTree**
* **BST**
	* BST is an implementation of a Binary Search Tree.
* **DoublyLinkedList**
	* Implementation of a doubly-linked list
* **EdgeList**
	* Edge List object for graphs
* **GameTree**
* **GraphNode**
	* A node for use in graph algorithms
* **HashTableChain**
	* An implementation of a hash table using a doubly linked list
* **HashTableOA**
	* An implementation of a hash table using the open addressing strategy
* **Heap**
	* An implementation of a binary heap supporting both MinHeap and MaxHeap types
* **Indexer**
	* Find a word in a file, and get the surrounding context of that word in each file in which it appears
* **IntervalTree**
* **KDTree**
* **LinkedListNode**
	* A node used for linked lists
* **LRUCache**
	* An implementation of a Least Recently Used Cache which **deletes** the least recently used item when the
    cache is full and we're adding a new item.
* **OrderStatisticTree**
	* Implementation of an Order Statistic Tree based on `AVLTree` with `select()` and `getRank()` functionality.
* **PriorityQueue**
	* Implementation of a priority queue
* **Queue**
	* Implementation of a good 'ol queue
* **RBTree**
	* RBTree is an implementation of a Left-Leaning Red-Black Tree.
* **RWayTrie**
	* Implementation of an R-Way-Trie using integer values.
* **Schedule**
	* Implementation of a task scheduler
* **Set**
	* Implementation of a set
* **SplayTree**
* **Stack**
	* Implementation of a stack
* **StringBuffer**
	* Concatenates all strings together at once instead of using Theta(n) running time to concatenate strings with
	.= or the like.
* **TernarySearchTrie**
	* Implementation of a Ternary Search Tree (TST)
* **TwoThreeTree**
* **TreeNode**
	* A node for trees and tries
* **TrieNode**
	* A Node used in the R-Way Trie
* **UnionFind**
	* The union-find data structure is also named the disjoint-set or merge-find.

List of Interview Puzzles
-------------------------
All interview question puzzles use the namespace `\HackFastAlgos\Interview`. The following is a list of popular
interview questions contained in this library.

* **CompressString**

	> Puzzle: Implement an algorithm to perform basic string compression using the counts of each character.
    > If the compressed string is longer than the original string, return the original string.

* **DialPad**

	> Puzzle: Return all of the possible letter combinations for a telephone number.

* **FizzBuzz**

	> Puzzle: Write an algorithm to iterate over the numbers 0 through 100 and output "Fizz" for
    > all multiples of 3. Output "Buzz" for all multiples of 5. Output "FizzBuzz" if a number is
    > a multiple of both 5 and 3. (Ex. 0:FizzBuzz 3:Fizz 5:Buzz ...)

* **Laundry**

	> Asked in my Amazon practice interview through Gainlo:
    >
    > Puzzle:
    > There are N machines in a laundry. They have infinite capacity.
    > Now a truck of cloths is unloaded for washing and randomly assigned to each machine.
    > In this process the manager didn't balance the load of cloths to clean. Now rebalancing is required.
    >
    > Rebalancing proceeds in rounds. Each time, a machine can transfer at most one cloth to each of its
    > neighbors. Neighbors of the machine i are the machine i-1 and i+1 (machines 1 and N have only one neighbor each,
    > 2 and N-1 respectively).
    >
    > The goal of rebalancing is to achieve that all machines have the same number of cloths.
    > Given the number of cloths initially assigned to each machine, you are asked to determine the minimal number of
    > rounds needed to achieve the state when every machine has the same number of cloths, or to determine that such
    > rebalancing is not possible.

* **Permutations**

	> Puzzle 1: Find all of the permutations for a given string.

	> Puzzle 2: Check if one string is a permutation of another string.

* **RansomMagazine**

	> Puzzle: Write an algorithm to see if all of the words in a ransom letter are contained in a magazine.

* **ReplaceChar**

	> Puzzle: Replace a space with %20 in a given string.

* **ResetVector**

	> Puzzle: A vector of consecutive integers is rotated such that the numbers restart
	> counting somewhere in the vector. Find the key at which the numbers begin counting.
	> (Ex. In Vector{6,7,8,9,0,1,2,3,4,5}, the reset point is 4, as 0 is the lowest number.)

* **StringReverse**

	> Puzzle: Implement an algorithm to reverse a string.

* **StringRotation**

	> Puzzle: Write code to check if a string is a rotation of a second string.

* **TreeLis**

	> Asked in my Amazon practice interview through Gainlo:
    >
    > Puzzle:
    > Given a binary tree find the size of the largest independent set.
    > This means that no two nodes in final set have direct parent-child relationship.
    >
    >              a1
    >             /  \
    >            a2   a3
    >           / \    \
    >          a4  a5  a6
    >              / \
    >             a7  a8
    >
    >             Answer: a1,a4,a7,a8,a6 ---> LIS is 5

* **UniqueChars**

	> Puzzle: Check if a string has all unique characters without the use of an additional data structure.

* **ZeroMatrix**

	> Puzzle: Write an algorithm into existence that will check an MxN matrix to find an element who's value is zero.
    > Every time a zero entry is discovered, make its row and column all zeros.

Notes on Slower Algorithms
--------------------------

There are a number of "slower" algorithms included in this library, so let me explain why I've chosen to include them.
First, I'll define what I mean when I'm discussing the speed of the algorithms.

When measuring the speed of an algorithm, computer scientists talk in [asymptotic notation](https://www.khanacademy.org/computing/computer-science/algorithms/asymptotic-notation/a/asymptotic-notation). There are three types of asymptotic notation: Big-O, Big-Omega, and Big-Theta.

Big-O is the most popular, as it signifies the upper-bound of the running time, meaning that in the worst-case
situation, the algorithm will not run any slower than the Big-O time. Big-Omega signifies the opposite of Big-O. It
states that even in the best-case situation, the algorithm cannot run any faster than Big-Omega. Lastly, we have
Big-Theta which signifies that no matter what data you shove through the algorithm, the algorithm will always run in
Big-Theta time.

When calculating asymptotic notation, you drop the lower order terms (coefficients and constants) as they do not
contribute largely to the running time. Therefore, asymptotic notation is more correct when defining the running time
of large data sets, and less correct when defining smaller datasets. Therefore, if you have a four element vector
you're ordering with SelectionSort, you could find it to be faster than using MergeSort or QuickSort.

The other reason I'm including "slower" algorithms is because they're still popular as a way to benchmark one algorithm
against another algorithm.

Why is X application of Y algorithm not in the library?
-------------------------------------------------------

The reason why X application of Y algorithm is not part of the library is simply because *you* haven't written it yet!
Every algorithm may be adapted to a multitude of application, and there are infinite possible algorithms. Simply put,
I cannot possibly write an implementation of every possible algorithm or implement every possible application of that
algorithm. I've chosen the most popular applications for each algorithm, and if you think that a popular algorithm
is missing from the library, please write it into existence, then create a pull request.

Contributing
------------

When creating a pull-request, check the following.

1. Keep to the Agile standards.
2. Keep with the coding standards you see in front of you. This project uses [PSR-1](http://www.php-fig.org/psr/psr-1/)
and [PSR-2](http://www.php-fig.org/psr/psr-2/) coding standards.
3. In your doc block, remember to signify the asymptotic notation for your algorithm. Use the most strict notation possible.
4. Always write your code in Hack! Hack is faster than PHP, and it reduces the number of bugs your code can cause. To
ensure the quality of your code, you must use typing.
5. If you're creating a new object, use the "HackFastAlgos" namespace to prevent code conflicts with other projects.
6. Each file is named the same as the class it contains, and only one class may reside in a given file. The exception
to the rule is that you may include exception classes *before* your main class.
7. Always throw *custom* exceptions for every type of exception. Name your exceptions in the following format.
`<CLASS><TYPE>Exception` (Ex. `DoublyLinkedListInvalidIndexException`)

This Library In Other Languages
-------------------------------

No one has created a port of HackFastAlgos in any other language just yet. If you create your own port of this package,
please let me know so that I can list it in this section.

Credits and Further Learning Resources
--------------------------------------

Many of the algorithms in this library are well known algorithms in the computer science community. Various scientists
invented the algorithms that I've implemented. Where applicable, I've linked to Wikipedia or other locations of interest
to describe the algorithms and data structures. You may find the details on who invented the algorithm by visiting those
pages.

Below is a list of sources for where I've first learned about the algorithms and data structures in this library. Most
of the resources below are free resources from MOOCs. If you're interested in expanding your knowledge on algorithms and
data structures, please take the classes below, read the books, or the websites. This library is a great way to easily
understand the material, though it does not cover everything in the resources below.

To fully understand the content, practice writing your own copy of this library manually. If you write it in a language
other than Hack, see the "This Library In Other Languages" section above.

* [Khan Academy](https://www.khanacademy.org/computing/computer-science/algorithms)
* [Algorithms: Design and Analysis, Part 1](https://www.coursera.org/course/algo)
* [Algorithms: Design and Analysis, Part 2](https://www.coursera.org/course/algo2)
* [Algorithms, Part I](https://www.coursera.org/course/algs4partI)
* [Algorithms, Part II](https://www.coursera.org/course/algs4partII)
* [Cracking the Coding Interview](http://www.crackingthecodinginterview.com/)
* And other random places on the interwebs...

Notes on the Coursera Honor Code
--------------------------------

The [Coursera Honor Code](https://www.coursera.org/about/terms/honorcode) forbids students from posting answers to the
Coursera assignments. Specifically it makes the following statement.

> I will not make solutions to homework, quizzes, exams, projects, and other assignments [herein refered to as "assignments"]
> available to anyone else (except to the extent an assignment explicitly permits sharing solutions). This includes both
> solutions written by me, as well as any solutions provided by the course staff or others.

Therefore, this library respects the honor code by not including such material. I specifically did not perform the Coursera
assignments for the courses I've used in this library so that this library remains detached from any of the assignments.
If any material contained in this library resembles an answer to an assignment, it's purely cooincidental, and unintentional.
