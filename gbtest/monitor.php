<?php
include_once("html.inc");
include_once("exec.inc");
$id=$_GET["id"];

chdir("tests/$id");

if (file_exists("endcontent.html")) {
 $content=file_get_contents("endcontent.html");
 myheader("Monitoring Groebner basis tests");
 content("Final result",$content);
 die();
}

myheader("Monitoring Groebner basis tests",3);

$content="<p>Variables: <code>".file_get_contents("vars")."</code></p>";
$content.="<p>Polynomials: <pre>".file_get_contents("polys")."</pre></p>";
$content.="<p>Term ordering: <code>".file_get_contents("termorder")."</code></p>";

$content.="<p>To check the output of a CAS, click on the 'finished' link (if any).</p>";

$content.="<table border=1><thead><tr><td>CAS</td><td>State</td><td>Resources</td></tr></thead>";
$allstopped=TRUE;

foreach (glob("*.pid") as $pidfile) {
 $cas=substr($pidfile,0,strlen($pidfile)-4);
 $name=file_get_contents(mydir()."casinfo.php?cas=$cas");
 $content.="<tr><td>$name</td><td>";
 $pid=file_get_contents($pidfile);
 if (is_running($pid)) {
   $content.="running</td><td>";
   $allstopped=FALSE;
  }
 else
  {
   unset($res);
   exec("tail -2 $cas.err | head -1", $res);
   $result=$res[0];
   if ($result) {
    $content.="<a href=\"answer.php?id=$id&cas=$cas\" target=_window>finished</a></td><td>";
    $content.="$result";
    }
   else {
    $content.="timeout</td><td>";
    }
  }
 $content.="</td></tr>";
 }

$content.="</table>";

content("Running tests, please wait...",$content);

if ($allstopped) {
 $f=fopen("endcontent.html","w");
 fwrite($f,$content);
 fclose($f);
 }

?>
