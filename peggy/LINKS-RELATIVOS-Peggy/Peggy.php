<html>
  <head>
    <title></title>
    <script src="jquery-3.3.1.js"></script>
    <script type="text/javascript">

      var valorcaixadetexto ="titulo";
    </script>
  </head>
<body>
<?php 
$conexao=@mysqli_connect("localhost","root","","peggy");
if(!$conexao){echo"falha";}else{echo"conectado";}
echo'

<div style="float:left; position:absolute; border:solid gray 1px; border-radius:4px;  margin-left:25%; 
margin-top:20%; width:40%;
height:20px;">
  <input type="text" placeholder="Digite sua busca" style="float:left; position:absolute;
         border:none;
         background:transparent; width:95%;
         height:20px;" id="localiza" name="localiza" value=""/>
  <button type="button" onclick="retorna()" style="float:left; position:absolute; 
         height:17px;
         width:17px; margin-left:95.8%;
         margin-top:1px;
         background-size:15px;" id="buscar" ></button>
</div>

';
                               


?>

   <script> var valorcaixadetexto=document.getElementById("localiza").value;</script> 

<?php 
$valor="<script>document.write(valorcaixadetexto)</script>"; 
//$valor1=$_POST['localiza']; 
echo "ola $valor";
//$valor=$_GET["localiza"];

$buscar=@mysqli_query($conexao, "select * from busca where titulo='titulo' order by id");

$buscar1=@mysqli_fetch_array($buscar);
$linhas=@mysqli_num_rows($buscar1);


while($linhas > 0){

     echo $buscar1['titulo'];
     echo '<br>';
     echo $buscar1['texto'];

     echo '<p style=margin-top:40px;/>';
    
}
echo "</div>";

//trecho em JQUERY
?>
<script>

function retorna(){
alert("ola");

document.write("<div style='float:left; position:absolute; border:solid gray 1px; border-radius:4px;  margin-left:25%; margin-top:8%; width:40%;height:20px;'><input type='text' placeholder='Digite sua busca' value='' style='float:left; position:absolute;border:none;background:transparent; width:95%;height:20px;' id='localiza' name='localiza' value=''/><button type='button' onclick='retorna()' style='float:left; position:absolute; height:17px;width:17px; margin-left:95.8%;margin-top:1px;background-size:15px;' id='buscar' ></button><br><br><br><br><div style='margin-left:20%; margin-top:20% position:absolute; float:left;'><?php echo ($buscar1['titulo']."<br>".$buscar1['texto']); ?></div></div>");
document.write();

}

</script>

</body>
</html>