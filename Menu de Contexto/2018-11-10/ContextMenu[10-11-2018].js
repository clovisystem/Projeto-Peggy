window.addEventListener("contextmenu", function(e){
    $(".rightclickmenu").css({
        "margin-left":e.clientX,
        "margin-top":e.clientY
        
    }).show()

    



    e.preventDefault();
    window.addEventListener("click",function(){
        $(".rightclickmenu").hide();

    })
    
    
    
})


var conteudo=document.getElementsByClassName("busca").value="Pesquise Imagens"+
"Pesquise Notícias"+"Pesquise Vídeos";
