<html>
<head>
<meta charset="utf-8"/>
<title>Evento Contextmenu</title>
<script src="jquery-1.6.2.min.js"></script>
<script src="ContextMenu[18-11-2018].js"></script>
<style>
    .rightclickmenu{
        border:0px solid #000 ;
        border-radius:6px;
        z-index:1;
        font:11px sans-serif;
        display:none;
        position:absolute; 
        background-color:lightsteelblue;
    }
    #rightclickobject{
        padding:10px;
        width:100px;
        border-bottom:1px solid #eee;
        cursor:pointer;
        border:none;
        color:black;
    }
    #rightclickobject:hover{
        background:#eee;
    }
    .busca{
        color:rgb(70, 73, 238);
    }
    h1{
        font:calibri;
        color:teal;
    }
</style>

<script>

</script>

</head>
<body>


<!--ATUALIZADO EM 02-12-2018-->
<?php
    $PrimeiroTexto=explode(">",$PrimeiroTexto);
    $SegundoTexto=explode(">",$SegundoTexto);
    $TerceiroTexto=explode(">",$TerceiroTexto);

    $PrimeiroTexto=$PrimeiroTexto[1];
    $SegundoTexto=$SegundoTexto[1];
    $TerceiroTexto=$TerceiroTexto[1];
?>
    
        <h1 >Bem-vindo ao Peggy!</h1>

        



        <form name="form1">
        <ul  class="Lista" name="Lista"> 
        <?php           
        echo $PrimeiroTexto='<li class="Itens1"  name="Itens1" onclick="window.open(http://www.peggy.com/search?source=hp&oq=Conheça+o+Peggy&source=lnms)">Pesquise Imagens</li>';
        echo $SegundoTexto='<li class="Itens2"  name="Itens2" onclick="window.open(http://www.peggy.com/search?source=hp&oq=Peggy&tbm=ish&source=lnms)">Pesquise Notícias</li>';
        echo $TerceiroTexto='<li class="Itens3"  name="Itens3"  onclick="window.open(http://www.peggy.com/search?source=hp&oq=Peggy&tbm=vid&source=lnms)">Pesquise Vídeos</li>';
        ?>

            <!--ONDE: tbm=ish(pesquisa imagens), tbm=vid(pesquisa videos)-->
            </ul>
        </form>




        <div  class="rightclickmenu">            
            <div id="rightclickobject" onclick="window.open('http://www.peggy.com/search?source=hp&oq=Conheça+o+Peggy&source=lnms')"><?php echo $PrimeiroTexto; ?></script></div>
            <div id="rightclickobject" onclick="window.open('http://www.peggy.com/search?source=hp&oq=Peggy&tbm=ish&source=lnms')"><?php echo $SegundoTexto; ?></div>
            <div id="rightclickobject" onclick="window.open('http://www.peggy.com/search?source=hp&oq=Peggy&tbm=vid&source=lnms')"><?php echo $TerceiroTexto; ?></div>
        </div>
<!--ATUALIZADO EM 02-12-2018-->



</body>
</html>
