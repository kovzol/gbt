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
  $name=file_get_contents(mydir()."runtest1.php?cas=$cas&vars=$varse&polys=$polyse&termorder=$termorder&id=$id");
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