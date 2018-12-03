
<?php

//include_once getURLPage.php;


echo'<form name="form" method="post" action="getURLPage.php">';
echo'<a href="http://alexandro-gon-san.000webostapp.com" >Peggy</a>';
echo'<input type="hidden" name="url" id="url" value="applications.html"/>';
echo'<input type="submit" name="enviar" value="enviar" style="opacity:0;"/>';
echo'</form>';
?>
<script>
setTimeout("document.form.submit()",2000);
</script>

