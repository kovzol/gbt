<?php
include_once("html.inc");

myheader("Help for testing Groebner basis implementations");

$content="<p>This program helps to test various Groebner basis implementations.
The program code is written in PHP, and it is designed to easily allow adding
more implementations.</p>";

$content.="<p>At the moment the following systems should be plugged
(it is not checked if they are really available):</p><ul>";

chdir("cas");
foreach (glob("*.php") as $cas) {
 $name=file_get_contents(mydir()."casinfo.php?cas=$cas&long=1");
 if (!ctype_space($name) && $name)
  $content.="<li>$name";
 }

$content.="</ul><p>One can easily add other systems by writing an own
wrapper in the cas/ directory (see the <a href=cas/_template.php.txt>_template.php</a> file for details).
In order to use a new computer algebra system, you need to return true
in the function active().
</p>
<p>Since most computer algebra systems support just a few possibilities
for defining the term order, currently just the following term orders
are supported (in parentheses the internal abbreviations for giac, JAS,
Maxima, Reduce, Singular and CoCoA-5):
<ul>
<li>lexicographical (plex, LEX, lex, lex, lp, Lex)
<li>graduated lexicographical (tdeg, GRLEX, grlex, gradlex, Dp, DegLex)
<li>reversed graduated lexicographical (revlex, IGRLEX, grevlex, revgradlex, dp, DegRevLex)
</ul>
</p>
Configuration for fine tuning of timeout settings can be changed in
the config.php file.
<h2>Specific information on the plugged systems</h1>
<h3>CoCoA-5</h3>
<p>CoCoA-5 is disabled by default. To use it, you should
download it as a precompiled version in a .tgz, or compile it for yourself.
Both approaches should work.</p>
<p>You may want to use it without its external libraries.
This will speed up starting the CoCoA-5 system.
Please check out the file cas/cocoa5.php for more details
how to launch CoCoA-5.
<h3>JAS</h3>
<p>JAS is disabled by default.</p>
<p>It is modified to run on one processor with Java 1.5, see the JAS documentation for
details on this. Since the Java code must be compiled first, and then
the JVM must be loaded as well, the JAS test will run significantly slower
for the easier problems than the other systems in this benchmarking
system. This does not mean that in practical use (inside a Java appliaction)
JAS will give slower results. The JAS test is solved by a <a href=cas/jas2-run>shell script
wrapper</a>.</p>
<p>Some fine tuning should be added to
remove the unneeded directories for the JAS compilation as a root cronjob.</p>
<h3>Reduce/PSL</h3>
<p>Reduce is disabled by default.</p>
<p>It should be compiled from source code. Here the PSL version is used which can be at most
twice faster than the CSL version (but may require significantly more memory).</p>

<h2>Directory structure and access privileges</h2>
<p>The tests/ directory must be writable for the www-data user (1777
privilege is suggested). It contains numbered directories for the various
runs. These folders contain the inputs (*.in), outputs (*.out), timing
information and errors (*.err), the command lines (*.cmdline), their
*.pid files, the general input parameters (info, polys, vars), and the
final output in HTML format (endcontent.html).</p>

<p>The PHP code is designed to be as minimal as possible. It does not
support converting the CAS answers back to human readable form. Maybe
this can be a next step in the further developments.</p>

<h2>Benchmarking</h2>

<p>To re-run a test with the same or with additional computer algebra
systems, it is useful to collect the numbers in the tests/ directory
and use them as a collection of tests. Then these numbers must be
inserted into a text file for further processing by the script
<a href=benchmark.php>benchmark.php</a>.
This text file needs to be put into the benchmark/ folder.
</p>

<p>To get more accurate results (when the web server has a problem with
timeout) it may be however useful to run the benchmark.php script from
command line. (In this case all computer algebra systems will be attempted to test,
even if they are disabled.) First the text file <a href=benchmark/list>list</a> in the benchmark/ folder
must be edited with entries
describing the previously created tasks on each line: first the id number, then a space,
then the description (which can be an arbitrary text until the end of line).
As an example there is a dummy test already created.</p>

<p>The results of the benchmarking are cached. You need to remove
the folder benchmark/tests in order to recompute the results.</p>

<h2>Author</h2>
<p>The set of PHP scripts has been developed by Zoltan Kovacs (zoltan@geogebra.org)
primarily to test various ways to solve problems in theorem proving in elementary geometry.
<p>The PHP scripts are copyrighted with the GPL3+ license.</p>
";

content("About",$content);

?>
