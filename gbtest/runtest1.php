<?php
# fixme: sanitize input
require_once("cas/".$_POST["cas"]);
require_once("exec.inc");
require_once("config.php");

$id=$_POST["id"];
$cas=$_POST["cas"];
$polys=urldecode($_POST["polys"]);
$vars=$_POST["vars"];
$termorder=$_POST["termorder"];

$input=cas_call($polys,$vars,$termorder);
$exec=exec_path();

$f=fopen("tests/$id/$cas.in","w");
fwrite($f,$input);
fclose($f);

$cmdline_fn="tests/$id/$cas.cmdline";
$f=fopen($cmdline_fn,"w");
fwrite($f,"#!/bin/sh
cd tests/$id
cat $cas.in | /usr/bin/timeout -k $HARD_TIMEOUT $TIMEOUT /usr/bin/time $exec > $cas.out 2>$cas.err");
fclose($f);
chmod($cmdline_fn, 0777);

$pid=background($cmdline_fn);
$f=fopen("tests/$id/$cas.pid","w");
fwrite($f,$pid);
fclose($f);

?>