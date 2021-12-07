$(document).ready(function(){
    $("#busqueda").keyup(function(e){
        if(e.keyCode == 13){
            busqueda();
        }
    });

});

function busqueda(){
    window.location.href="producBuscado.php?text="+$("#busqueda").val()
}
