<?php

function active() {
return false;
}

function name() {
return "CoCoA-5 CoCoALib-0.99543";
}

function shortname() {
return "CoCoA";
}

function exec_path() {
// Please enter a valid path here:
return "/home/joe/workspace/cocoa-5.1/bin/CoCoAInterpreter-64";
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
 $def="use QQ[$comma_sep_varlist], ";
 if ($termorder == "lex")
  $def.="Lex;\n";
 if ($termorder == "gradlex")
  $def.="DegLex;\n";
 if ($termorder == "revgradlex")
  $def.="DegRevLex;\n";
 $def.="GBasis(ideal($comma_sep_polylist));\n";
 return $def;
}

?>