<?php
# fixme: sanitize input
require_once("cas/".$_GET["cas"]);

if (active()) {
 if ($_GET["long"]==1)
  echo name();
 else
  echo shortname();
 }
?>