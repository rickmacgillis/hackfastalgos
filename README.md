Hack Fast Algos
==============

**STATUS:** IN DEVELOPMENT

Hack Fast Algos brings all of the most popular speed and space-efficient algorithms together in one library. The files
are completely written in Hack, so they'll work with your HHVM installation with Hack enabled.

Purpose
-------

Companies like Facebook, Google, and Microsoft rely on speed and space-efficient code to keep their websites and
projects running smoothly. You'll find that some of these algorithms are only either efficient on large data sets
(Ex. Lots of array elements) or require appropriate parameters for the task at hand. (Such as the configuration of
Quick Sort's parameters) I've commented on each algorithm's running times and storage requirements by using
asymptotic notation.

Keep in mind that HHVM is written primarily in C++ and C, and has a lot of built-in functionality that uses these
algorithms. (Ex. sort() uses an implementation of Quick Sort) Therefore, it's often faster to use the built in
functionality. However built in functions do not always give you the fine tuning capabilities required when working
with larger datasets.

This library also serves the purpose of aiding web developers in their conquest of learning algorithms and data
structures. If you intend to use the library as a learning or teaching tool, be advised that there are often multiple
ways to write the algorithm concepts. For instance, MergeSort does not need to run its recursion asynchronously, and
certain programming languages do not support asynchronous work-flows. The anthem of any good algorithm designer is,
"Can we make it better (faster/more memory efficient/more memory focused)?"

List of Algorithms
------------------

Every algorithm is grouped into a class of similar algorithms. Below is a list of classes, followed by the list of
algorithm methods in that class. For simplicity, the list below does not include the HackFastAlgos project namespace
of `HackFastAlgos.` So, if you wish to use `mergeSort` then you need to use
`\HackFastAlgos\Sort\mergeSort()`

**Algos**

**Graph**

**Math**

**Search**

**Select**

**Sort**

The callback function must operate the same way as the comparative function for
[usort](http://php.net/manual/en/function.usort.php). It allows for sorting arbitrary data in $vector.

`selectionSort<T>(Vector<T> $vector, Callable $callback) : Vector<T>`

`bubbleSort<T>(Vector<T> $vector, Callable $callback) : Vector<T>`

`insertSort<T>(Vector<T> $vector, Callable $callback) : Vector<T>`

`mergeSort<T>(Vector<T> $vector, Callable $callback, bool $returnWaitHandler = false) : T`

List of Data Structures
-----------------------

All data structures use the namespace `\HackFastAlgos\DataStructure`. Below is a list of data structure class
names and their methods. Data structures which employ a comparative function (`compare()`) may have said method
overridden to extend the capabilities of that data structure. All data used the generic type `T` for that reason.

**AVLTree**

**BPlusTree**

**BST**

BST is an implementation of a Binary Search Tree.

**BTree**

**DoublyLinkedList**

**GameTree**

**HashTable**

**Heap**

Heap supports both MinHeap and MaxHeap types.

**RBTree**

RBTree is an implementation of a Red-Black Tree.

**SplayTree**

**UnionFind**

The union-find data structure is also named the disjoint-set or merge-find. 

Notes on Slower Algorithms
--------------------------

There are a number of "slower" algorithms included in this library, so let me explain why I've chosen to include them.
First, I'll define what I mean when I'm discussing the speed of the algorithms.

When measuring the speed of an algorithm, computer scientists talk in [asymptotic notation](https://www.khanacademy.org/computing/computer-science/algorithms/asymptotic-notation/a/asymptotic-notation). There
are three types of asymptotic notation: Big-O, Big-Omega, and Big-Theta.

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

1. Be sure to add a proper doc block to each method you create, even if it's a protected or private method. Especially
include a summary, @param, and @return information.
2. Keep with the coding standards you see in front of you. This project uses [PSR-1](http://www.php-fig.org/psr/psr-1/)
and [PSR-2](http://www.php-fig.org/psr/psr-2/) coding standards.
3. In your doc block, remember to signify the asymptotic notation for your algorithm.
4. Always write your code in Hack! Hack is faster than PHP, and it reduces the number of bugs your code can cause. To
ensure the quality of your code, you must use typing.
5. If you're creating a new object, use the "HackFastAlgos" namespace to prevent code conflicts with other projects.
6. Each file is named the same as the class it contains, and only one class may reside in a given file. The exception
to the rule is that you may include an exception class *before* your main class.
7. Exception classes must be named the same name as the main class' name with "Exception" suffixed to it. So,
if the main class is named "Search," Your exception for that class must be named "SearchException" if your class
requires one.
8. Always throw *custom* exceptions exclusive to your class! Do not directly use the base class "Exception" for your
exceptions. Extend class "Exception" and your your descendant class. When your code throws multiple exceptions in the
same method, use the second parameter, "code," to help developers differentiate between them. If it only throws one
exception, set the code to "1" in order to keep your code consistent.
9. When you define a new type, prefix the type with "HFA" for Hack Fast Algos.
