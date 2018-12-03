<?php

$conexao=@mysqli_connect("localhost","root","","peggy");
if(!$conexao){echo"falha";}else{echo"conectado";}

?>