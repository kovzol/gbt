<?php

function active() {
return false;
}

function name() {
// Please change it manually if you have a newer JAS:
return "JAS 2.4.3808";
}

function shortname() {
return "JAS2";
}

function exec_path() {
// Please set the correct path manually:
return "/home/joe/public_html/cas/jas2-run";
}

function cas_call($comma_sep_polylist,$comma_sep_varlist,$termorder) {
if ($termorder=="lex")
 $termorder="LEX";
if ($termorder=="gradlex")
 $termorder="GRLEX";
if ($termorder=="revgradlex")
 $termorder="IGRLEX";
$comma_sep_polylist=str_replace("\n","",$comma_sep_polylist);
$comma_sep_varlist=str_replace("\n","",$comma_sep_varlist);
$comma_sep_polylist=str_replace("\r","",$comma_sep_polylist);
$comma_sep_varlist=str_replace("\r","",$comma_sep_varlist);

$java="
package edu.jas.application;

import java.io.IOException;
import java.io.Reader;
import java.io.StringReader;
import java.util.ArrayList;
import java.util.List;

import org.apache.log4j.BasicConfigurator;

import edu.jas.arith.BigDecimal;
import edu.jas.arith.BigInteger;
import edu.jas.arith.BigRational;
import edu.jas.arith.ModInteger;
import edu.jas.arith.ModIntegerRing;
import edu.jas.arith.Product;
import edu.jas.arith.ProductRing;
import edu.jas.gb.GroebnerBase;
import edu.jas.gbufd.GBFactory;
import edu.jas.gbufd.RGroebnerBasePseudoSeq;
import edu.jas.gbufd.RReductionSeq;
import edu.jas.kern.ComputerThreads;
import edu.jas.poly.GenPolynomial;
import edu.jas.poly.GenPolynomialRing;
import edu.jas.poly.GenPolynomialTokenizer;
import edu.jas.poly.PolynomialList;
import edu.jas.poly.TermOrder;

public class Examples {

public static void main(String[] args) {
BasicConfigurator.configure();

String[] vars = { \"";
$vars=str_replace(",","\",\"",$comma_sep_varlist);
$java.=$vars."\" };
BigRational br = new BigRational();
GenPolynomialRing<BigRational> pring = new GenPolynomialRing<BigRational>(br, vars.length, new TermOrder(TermOrder.".$termorder."), vars);
";

$polys=explode(",",$comma_sep_polylist);
$i=1;
$n=count($polys);
$java.="List<GenPolynomial<BigRational>> cp = new ArrayList<GenPolynomial<BigRational>>($n);
";

foreach($polys as $p) {
 $java.="GenPolynomial<BigRational> e$i = pring.parse(\"($p)\");\n";
 $java.="cp.add(e$i);\n";
 ++$i;
}

$java.='List<GenPolynomial<BigRational>> gb;
GroebnerBase<BigRational> sgb = GBFactory.getImplementation(br);
gb = sgb.GB(cp);

PolynomialList<BigRational> pl = new PolynomialList<BigRational>(pring,gb);
Ideal<BigRational> id = new Ideal<BigRational>(pl,true);
System.out.println("cp = " + cp);
System.out.println("id = " + id);

Dimension dim = id.dimension();
System.out.println("dim = " + dim);

ComputerThreads.terminate();
}
}';
return $java;
}


?> 

