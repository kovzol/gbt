<?php
include_once("html.inc");
$vars=$_POST["vars"];
$polys=$_POST["polys"];
$termorder=$_POST["termorder"];
$varse=urlencode($vars);
$polyse=urlencode($polys);
$termorder=urlencode($termorder);
$id=time().rand(111,999);
mkdir("tests/$id");
chdir("tests/$id");
chdir("../..");

chdir("cas");
foreach (glob("*.php") as $cas) {
 if ($_POST[str_replace(".","_",$cas)]=='on') {
  $caslist.=$cas.",";
  $postdata=http_build_query(array('cas' => $cas, 'vars' => $vars, 'polys' => $polyse, 'termorder' => $termorder, 'id' => $id));
  $opts=array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
  $context=stream_context_create($opts);
  $name=file_get_contents(mydir().'runtest1.php', false, $context);
  }
 }
$caslist=rtrim($caslist,",");
chdir("..");

chdir("tests/$id");
$info="vars=$vars
polys=$polys
cas=$caslist
termorder=$termorder
id=$id";
$f=fopen("info","w");
fwrite($f,$info);
fclose($f);

$f=fopen("vars","w");
fwrite($f,$vars);
fclose($f);

$f=fopen("polys","w");
fwrite($f,$polys);
fclose($f);

$f=fopen("termorder","w");
fwrite($f,$termorder);
fclose($f);


echo "
<?DOCTYPE html>
<html>
<head>
<title>Running Groebner tests</title>
<meta http-equiv=\"refresh\" content=\"0;url=monitor.php?id=$id\" />
</head>
</body>
</html>";

?>