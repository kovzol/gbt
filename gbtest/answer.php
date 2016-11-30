<?php
$id=$_GET["id"];
$cas=$_GET["cas"];
header('Content-type: application/txt');
header("Content-Disposition: attachment; filename=\"tests/$id/$cas.txt\"");
echo file_get_contents("tests/$id/$cas.out");
?>