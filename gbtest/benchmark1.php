<?php

include_once("config.php");

$cas=$argv[1];
$id=$argv[2];

$outdir="tests/$id";
$outfile="$cas.benchmark";

$mydir=getcwd();

echo date(DATE_RFC822);
echo " Running $cas $id...";

// Caching:
if (file_exists("benchmark/$outdir/$outfile")) {
 echo " reading from cache...\n";
 echo file_get_contents("benchmark/$outdir/$outfile")."\n";
 die(0);
 }

require_once("cas/$cas");
require_once("exec.inc");

chdir("benchmark/$id");
$polys=file_get_contents("polys");
$vars=file_get_contents("vars");
if (file_exists("termorder"))
 $termorder=file_get_contents("termorder");
else
 $termorder="lex"; // backward compatibility

$input=cas_call($polys,$vars,$termorder);
$exec=exec_path();

chdir("$mydir/benchmark");
if (!file_exists($outdir))
 mkdir($outdir, 0777, true);

$f=fopen("$outdir/$cas.in","w");
fwrite($f,$input);
fclose($f);

$cmdline_fn="$outdir/$cas.cmdline";
$f=fopen($cmdline_fn,"w");
fwrite($f,"#!/bin/sh
cd $outdir
cat $cas.in | /usr/bin/timeout -k $HARD_TIMEOUT $TIMEOUT /usr/bin/time $exec > $cas.out 2>$cas.err");
fclose($f);
chmod($cmdline_fn, 0777);

passthru($cmdline_fn);

echo "done\n";

// Ensuring possibility to remove these files by others as well
chmod("$outdir", 0777);
chmod("tests", 0777);

// Now analyzing...

exec("cat $outdir/$cas.err | tail -2 | head -1", $result);
if (count($result) == 0) {
 // Certainly timeout
 $answer="timeout";
 }
else {
 if (strpos($result[0], "user") === false)
  $answer="timeout";
 else {
  $time12 = explode(" ",$result[0], 2);
  $time1 = explode("u", $time12[0], 1); // user
  $time2 = explode("s", $time12[1], 1); // sys
  $answer = $time1[0] + $time2[0];
  }
 }
file_put_contents("$outdir/$outfile", $answer);
echo $answer."\n";

?>