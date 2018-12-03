<?php
include_once "DOMURL[modificado].php";
$url=null;
$DOMURL=new DOMURL();
echo'<br>';echo'<br>';
echo $DOMURL->toPath($url);
echo'<br>';echo'<br>';
echo $DOMURL->ofDocument($url);

?>
