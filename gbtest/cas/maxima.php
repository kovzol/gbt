<?php

function active() {
return true;
}

function name() {
// Please change it manually if you have a newer Maxima:
return "Maxima 5.37.2-8";
}

function shortname() {
return "Maxima";
}

function exec_path() {
return "/usr/bin/maxima";
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
if ($termorder=="lex")
 $termorder="lex";
if ($termorder=="gradlex")
 $termorder="grlex";
if ($termorder=="revgradlex")
 $termorder="grevlex";

return "load(grobner)$ poly_monomial_order:$termorder$ poly_reduction(poly_grobner([$comma_sep_polylist],[$comma_sep_varlist]),[$comma_sep_varlist]);";
}

?>