<?php

include_once("html.inc");

$caslist=array();
$benchmarks=array();

myheader("Groebner benchmarking");
$content.="<table border=1><thead><tr>";

$content .= "<td><b>Test</b></td>";

chdir("cas");
foreach (glob("*.php") as $cas) {
 if (php_sapi_name() === 'cli') {
  if (substr($cas,0,1) != "_")
   $name=$cas;
  } else {
  $name=file_get_contents(mydir()."casinfo.php?cas=$cas");
  }
 if (!ctype_space($name) && $name) {
  $caslist[]=$cas;
  $content .= "<td>";
  $content .= basename($cas,".php");
  $content .= "</td>";
  }
 }

$content .= "</tr></thead>\n";

chdir("../benchmark");

$files=file('list', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($files as $benchmark) {
 $data=explode(" ",$benchmark,2);
 $benchmarks[]=$data;
 if (!file_exists($data[0]))
  symlink("../tests/".$data[0], $data[0]);
  chmod($data[0], 0777);
 }
chdir("..");

foreach ($benchmarks as $benchmark) {
 $id=$benchmark[0];
 if ($id == "" || $id[0] == "#")
  continue;
 $name=$benchmark[1];
 $content .= "<tr><td><b>$name</b></td>";
 foreach ($caslist as $cas) {
  $result = exec("php benchmark1.php $cas $id");
  $content .= "<td>$result</td>";
  }
 $content .= "</tr>\n";
 }

$content .= "</table></body></html>\n";

content("Benchmark", $content);
?>
