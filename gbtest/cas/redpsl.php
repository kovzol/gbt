<?php

function active() {
return false;
}

function name() {
// Please change it manually if you have a different version:
return "Reduce/PSL SVN";
}

function shortname() {
return "Reduce/PSL";
}

function exec_path() {
// Please change it manually:
return "/home/joe/workspace/reduce-algebra/trunk/bin/redpsl";
}

function def_vars($comma_sep_varlist) {
return "load groebner;";
}

function def_orders($comma_sep_varlist,$termorder) {
// $termorder can be "lex", "gradlex", "revgradlex"
if (!$termorder)
 $termorder="lex";
// (We assume termorder is set, however.
return "torder({"."$comma_sep_varlist},'$termorder);";
}

function call_groebner($comma_sep_polylist) {
return "groebner({"."$comma_sep_polylist});";
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
return comma_to_commacr(def_vars($comma_sep_varlist).
 def_orders($comma_sep_varlist,$termorder).
 call_groebner($comma_sep_polylist));
}

function comma_to_commacr($text) {
return str_replace(",",",\n",$text);
}

?>