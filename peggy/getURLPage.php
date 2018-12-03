<?php

/**
 * Classe Frequency
 *
 * @author BRUNO OSÓRIO <email@email.email>
 * @copyright 2018 Operação Licata
 * @license "Consultar ALEXANDRO <alexandrogonsan@outlook.com"
 */
ini_set("default_charset","iso-8859-1");

function getlinks($file){
 
$html = file_get_contents($file);
$dom = new DOMDocument();
$dom->loadHTML($html, LIBXML_NOWARNING | LIBXML_NOERROR);
$links = $dom->getElementsByTagName('a');

foreach($links as $link){
	foreach($link->attributes as $attr){
		if($attr->name === 'href' && $attr->value !== ""){
                      //echo $attr->value ."<br>";
					  $url=$attr->value;
					  $urlAbsoluta='https://';
					  
					  $url1=strpos($url,$urlAbsoluta);
			
						if($url1===false){
							print "o link é relativo".$incluiRelativa=$url;
							
					   }
					   $conexao=@mysqli_connect("localhost","root","","peggy");
					   $insere=@mysqli_query($conexao,"INSERT url (url) VALUES('$incluiRelativa');");
					   if ($insere)
							print"url incluida".$incluiRelativa."<br>";
/*
/libraries = com uma barra no início volta para a raiz e acessa
libraries = sem nenhuma barra no início acessa a partir da pasta atual
//bing.com.br = com duas barras no início é como se fosse um link direto sem referencia
../libraries/ = volta uma pasta acima
../../libraries/ = volta duas pastas acima
...
///libraries/ = com mais do que duas barras volta para a raiz ( usando a primeira barra ) e coloca as outras barras no link
./libraries/ = com ./ acessa a partir da pasta atual como se tivesse digitado diretamente
.../libraries/ = com mais de dois pontos considera como se fosse um link e acessa a partir da pasta atual
*/



		
         
			
		}
    }      
}
}
$files=$_POST["url"];

getlinks($files)



?>

