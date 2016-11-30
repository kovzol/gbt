<?php
include_once("html.inc");
include_once("config.php");

myheader("Testing Groebner basis implementations");

$content="<p>Enter the details for your test.
For variables give a comma separated list
(e.g. <code>x,y</code>), for polynomials also
enter the polynomials separated by commas
(e.g. <code>x^2+x*y-1,2*x*y+3*x,x^3</code>).</p>
<p>Timeout is set to $TIMEOUT seconds.
Please read the <a href=about.php>documentation</a> for more information on this.</p>
";
$content.='<form action="runtest.php" method="post">
<div class="entry">
<label>Variables:</label> 
<input type="text" name="vars" autofocus size=50 required/>
</div>

<div class="entry">
<label>Polynomials:</label> 
<textarea name="polys" required rows=5 cols=40></textarea>
</div>

<div class="entry">
<label>Term ordering:</label>
<select name="termorder">
<option selected="selected" value="lex">Lexicographical</option>
<option value="gradlex">Graduated lexicographical</option>
<option value="revgradlex">Reversed graduated lexicographical</option>
</select>

<div class="entry">
<label>CAS:</label>';

chdir("cas");
foreach (glob("*.php") as $cas) {
 $name=file_get_contents(mydir()."casinfo.php?cas=$cas");
 if (!ctype_space($name) && $name)
  $content.="<input type=\"checkbox\" checked name=\"$cas\">$name";
 }

$content.='</div>
<div class="button"> 
<button type=submit>Submit</button>
</div></form>';

content("Test",$content);

?>
