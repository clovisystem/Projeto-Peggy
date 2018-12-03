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
					  $urlAbsoluta='http://';
					  $urlAbsoluta1='https://';
					  $urlAbsoluta2='www';
					  
					  $url1=strpos($url,$urlAbsoluta);
					  $url2=strpos($url,$urlAbsoluta1);
					  $url3=strpos($url,$urlAbsoluta2);
			
						if($url1===false){
							if($url2===false){
								if($url3===false){
								 print "o link é relativo".$incluiRelativa=$url;
								 
								 $conexao=@mysqli_connect("localhost","root","","peggy");
								 $insere=@mysqli_query($conexao,"INSERT url (url) VALUES('$incluiRelativa');");
								 if ($insere)
									print"url incluida".$incluiRelativa."<br>";
								 }
							}
					   }
      
			
		}
    }      
}
}
$files=$_POST["url"];

getlinks($files)



?>

