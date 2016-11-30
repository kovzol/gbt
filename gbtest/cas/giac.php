<?php

function active() {
return true;
}

function name() {
// Please change it manually if you have a newer Giac:
return "giac 1.2.2-103";
}

function shortname() {
return "Giac";
}

function exec_path() {
return "/usr/bin/giac";
}

function def_orders($termorder) {
// $termorder can be "lex", "gradlex", "revgradlex"
if ($termorder=="lex")
 $termorder="plex";
if ($termorder=="gradlex")
 $termorder="tdeg";
if ($termorder=="revgradlex")
 $termorder="revlex";
return $termorder;
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
$comma_sep_polylist=str_replace("\n","",$comma_sep_polylist);
$comma_sep_varlist=str_replace("\n","",$comma_sep_varlist);
$comma_sep_polylist=str_replace("\r","",$comma_sep_polylist);
$comma_sep_varlist=str_replace("\r","",$comma_sep_varlist);
return "gbasis([$comma_sep_polylist],[$comma_sep_varlist],".
 def_orders($termorder).")";
}

?>