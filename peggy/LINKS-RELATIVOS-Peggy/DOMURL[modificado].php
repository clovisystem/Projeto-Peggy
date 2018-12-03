<?php
/**
 * Class DOMURL
 *
 * @author ALEXANDRO <alexandrogonsan@outlook.com>
 * @copyright 2018 Operação Licata
 * @license "Consultar ALEXANDRO"
 */

require_once ( 'DB.php' );
require_once ( 'DOMHTML.php' );

class DOMURL {

	/*
	 * Diz qual o caminho dentro da pasta Cache do arquivo da URL .
	 * 
     * A url de @param deve ser já tratada pelo método DOMURL::toDB que retira o protocolo http .
	 */
	public static function toPath ( $url ) {
		if (strpos($url, '/') == true) {
			$array = explode('/', $url);

			$ultimoDado = array_slice ( $array , -1 ) ;

			if ( $ultimoDado == "" )
				return $url."index.php";
		}
		return $url."/index.php";
	}

	/*
	 * Será usado tanto com URLs digitadas manualmente tanto com com as url das páginas .
	 * A URL do parametro já deve vir resolvido a relatividade .
	 * Esse método valida a URL .
	 */
	private static function toDB ( $url , $mysqli) {

        $url = trim($url);

        if(strlen($url) == 0)
            return false ;

        if (strpos($url, 'http://') == 0 || strpos($url,'https://')==0) {
            $url = explode('://',$url);
            if ( count($url) > 2 ) {
            	$mysqli->select_db(DB::$mainDBName);
				$mysqli->query("INSERT INTO Erros ( location , id ) VALUES ( 'DOMURL::toDB' , '0001' ) ; ");
				return false ;
        	} else {
        		if ( strlen($url[1]) == 0 )
        			return false ;
        		else
        			$url = $url[1];
        	}
        }

        $now = date('Y-m-d H:i:s');

        $mysqli->select_db(DBsNames::$main);
        $boolean = $mysqli->query("INSERT INTO Cache (url, ultima_atualization) VALUES ('$url','$now')");
        if ( $boolean == false )
            return false ;
        return $url ;
    }

    /**
     * Indexa uma URL em específico .
     *
     * A url de entrada não entra já validada , a validação ocorre com método DOMURL::toDB
     * que inclusive para a função se a url não validar .
     *
     * A url após a validação estará sem o protocolo http .
     */
    private static function indexar ( $url ,$mysqli) {
    	$url = self::toDB($url,$mysqli);
    	if ( $url === false )
    		return false ;
    	DOMHTML::ofURLToCache($url);

        // reabrir o arquivo salvo para calcular a frequencia das palavras , posições, tags e tags pai das palavras
        $objectDOMNodeContentList = new DOMNodeContentList ( $url ) ;

        DOMWord::toDBs($objectDOMNodeContentList,$mysqli);
        DOMWordList::ofObjectDOMNodeContentListToDB ( $objectDOMNodeContentList , $mysqli );

        // codificar para enviar para o DB :
        // 1 - as tags das palavras lembrando de que tem que ter associação com a distancia
        $objectDOMNodeContentList->tagsToDB($mysqli);

        // 2 - os inURL e nivelInURL
        DOMURL::toWordsDB ( $mysqli , $url );

    	// CONSTRUIR OS OUTROS DB

        return true ;
    }

    /**
     * Não está tratando os links relativos .
     */
    public static function ofDocument ( $url ) {

        $path = DOMURL::toPath ( $url ) ;
        $path = '../../Cache/' . $path ;
        $html = file_get_contents($path);
        $dom = new DOMDocument();
        $dom->loadHTML($html, LIBXML_NOWARNING | LIBXML_NOERROR);
        $links = $dom->getElementsByTagName('a');
        $array = array();
        foreach($links as $link)
            foreach($link->attributes as $attr)
                if($attr->name === 'href' && $attr->value !== "")
                    $array[] = $attr->value ;
					
					
					
					  $urlAbsoluta='http://';
					  $urlAbsoluta1='https://';
					  $urlAbsoluta2='www';
					  
					  $url1=strpos($array[],$urlAbsoluta);
					  $url2=strpos($array[],$urlAbsoluta1);
					  $url3=strpos($array[],$urlAbsoluta2);
			
						if($url1===true){
							if($url2===true){
								if($url3===true){
								 print "o link é absoluto".$incluiAbsoluto=$array[];
								 
								 $conexao=@mysqli_connect("localhost","root","","peggy");
								 $mysqli=@mysqli_query($conexao,"INSERT url (url) VALUES('$incluiAbsoluto');");
								 if ($mysqli)
									print"url incluida".$incluiAbsoluto."<br>";
								 }
							}
					   }
					
					
					
        return $array;
    }

    /**
     * 
     */
    public static function indexarAll ( $url , $mysqli ) {

        $urls = array($url) ;
        foreach ($urls as $key => $url) {
            # code...
            DOMURL::indexar ( $url ,$mysqli );
            $urls += DOMURL::ofDocument ( $url ) ;
        }
    }

    private static toWordsDB ( $mysqli , $url ) {

        $mysqli->select_db(DBsNames::$wordData);

        if ( strpos($url, '/') === true )
            $url = explode('/',$url);
        else 
            $url = array($url);

        $dominioSubDominioTLD = explode(".", $url[0]);

        $tld = array_slice($dominioSubDominioTLD, -1)[0];
        $indiceMax = strlen ( $tld ) ;
        for ( $indiceStart = 0 ; $indiceStart < $indiceMax ; $indiceStart ++ ) {
            for ( $indiceEnd = $indiceStart + 1 ; $indiceEnd < $indiceMax + 1 ; $indiceEnd ++ ) {
                $word = substr ( $tld , $indiceStart , $indiceEnd ) ;
                DB::createTableOfWord ( $word , $mysqli );
                $mysqli->query("INSERT INTO $word (inURL,nivelInURL) VALUES ('true',0) ;");
            }
        }

        $dominio = array_slice($dominioSubDominioTLD, -2,1 )[0];
        $indiceMax = strlen ( $dominio ) ;
        for ( $indiceStart = 0 ; $indiceStart < $indiceMax ; $indiceStart ++ ) {
            for ( $indiceEnd = $indiceStart + 1 ; $indiceEnd < $indiceMax + 1 ; $indiceEnd ++ ) {
                $word = substr ( $dominio , $indiceStart , $indiceEnd ) ;
                DB::createTableOfWord ( $word , $mysqli );
                $mysqli->query("INSERT INTO $word (inURL,nivelInURL) VALUES ('true',1) ;");
            }
        }

        $subDominios = array_slice($dominioSubDominioTLD,0,-2);
        foreach ($subDominios as $key => $value) {
            # code...
            $indiceMax = strlen ( $value ) ;
            for ( $indiceStart = 0 ; $indiceStart < $indiceMax ; $indiceStart ++ ) {
                for ( $indiceEnd = $indiceStart + 1 ; $indiceEnd < $indiceMax + 1 ; $indiceEnd ++ ) {
                    $word = substr ( $value , $indiceStart , $indiceEnd ) ;
                    DB::createTableOfWord ( $word , $mysqli );
                    $nivelInURL = strlen($subDominios) + 1000 - $key -1 ;
                    $mysqli->query("INSERT INTO $word (inURL,nivelInURL) VALUES ('true','$nivelInURL') ;");
                }
            }
        }

        $pastas = array_slice ( $url , 1 );
        foreach ( $pastas as $key => $value ) {
            $indiceMax = strlen ( $value ) ;
            for ( $indiceStart = 0 ; $indiceStart < $indiceMax ; $indiceStart ++ ) {
                for ( $indiceEnd = $indiceStart + 1 ; $indiceEnd < $indiceMax + 1 ; $indiceEnd ++ ) {
                    $word = substr ( $value , $indiceStart , $indiceEnd ) ;
                    DB::createTableOfWord ( $word , $mysqli );
                    $nivelInURL = strlen($pastas) + 10000 - $key -1 ;
                    $mysqli->query("INSERT INTO $word (inURL,nivelInURL) VALUES ('true','$nivelInURL') ;");
                }
            }
        }
    }

}