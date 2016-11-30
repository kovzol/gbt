<?php

/* START OF PUBLIC FUNCTIONS */
function name() {
return "Template (don't use)";
}

function shortname() {
return "Template";
}

function exec_path() {
return "/usr/bin/echo";
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
return def_vars($comma_sep_varlist).
 def_orders($comma_sep_varlist,$termorder).
 call_groebner($comma_sep_polylist);
}

function active() {
return false;
}
/* END OF PUBLIC FUNCTIONS */

function def_vars($comma_sep_varlist) {
return "define_vars($comma_sep_varlist);";
}

function def_orders($comma_sep_varlist,$termorder) {
// $termorder can be "lex", "gradlex", "revgradlex"
return "define_orders($comma_sep_varlist,\"$termorder\");";
}

function call_groebner($comma_sep_polylist) {
return "grobner($comma_sep_polylist);";
}


?>