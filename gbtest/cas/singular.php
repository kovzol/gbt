<?php

function active() {
return true;
}

function name() {
// Please change it manually if you have a newer Singular:
return "Singular 4.0.3";
}

function shortname() {
return "Singular";
}

function exec_path() {
return "/usr/bin/Singular";
}

function def_vars($comma_sep_varlist,$termorder) {
return "ring r=0,($comma_sep_varlist),".def_orders($termorder).";";
}

function def_orders($termorder) {
// $termorder can be "lex", "gradlex", "revgradlex"
if ($termorder=="lex")
 $termorder="lp";
if ($termorder=="gradlex")
 $termorder="Dp";
if ($termorder=="revgradlex")
 $termorder="dp";
return $termorder;
}

function call_groebner($comma_sep_polylist) {
$comma_sep_polylist=str_replace("+-","-",$comma_sep_polylist);
return "ideal I=$comma_sep_polylist; option(redSB); groebner(I);";
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
return def_vars($comma_sep_varlist,$termorder).
 call_groebner($comma_sep_polylist);
}

?>