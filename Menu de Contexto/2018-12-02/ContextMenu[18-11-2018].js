window.addEventListener("contextmenu", function(e){
/*--------------------------------------ATUALIZADO EM 18-11-2018------------------------------*/
    $(".rightclickmenu").css({
        "margin-left":e.clientX-60,
        "margin-top":e.clientY-60
        
    }).show()
/*--------------------------------------ATUALIZADO EM 18-11-2018------------------------------*/
    



    e.preventDefault();
    window.addEventListener("click",function(){
        $(".rightclickmenu").hide();

    })
    
    
    
})

/*--------------------------------------ATUALIZADO EM 18-11-2018------------------------------*/
var conteudo=document.getElementsByClassName("busca").value="Pesquise Imagens"+
"Pesquise Notícias"+"Pesquise Vídeos";
/*--------------------------------------ATUALIZADO EM 18-11-2018------------------------------*/


/*--------------------------------------ATUALIZADO EM 02-12-2018------------------------------*/


   /* var obter1=document.getElementById("Itens1");
    var conteudo1=document.getElementsByClassName("busca").value="obter1.nodeValue";
    
    var conteudo2=document.getElementByClassName("Itens2").innerHTML("li class='Itens2'");
    //var conteudo2=tostring(document.getElementsByClassName("busca").value=obter2);

    var obter3=document.form1.Lista.Itens3.value;
    var conteudo3=document.getElementsByClassName("busca").value="obter3";



/*--------------------------------------ATUALIZADO EM 02-12-2018------------------------------*/
