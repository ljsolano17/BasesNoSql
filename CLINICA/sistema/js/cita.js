$(document).ready(function(){
cargaCitas();
cargaDoctores();

$('#btResultado').click(function () {
    var x = document.getElementById("filtroNombre").value;
    //var y = document.getElementById("citas").value;
     //alert(x);
    // ImprTablaJson(TextoJSON,x);
    try{
        $.ajax({
            url: 'getPacientes.php'
        })
        .done(function(data){
            
        ImprTablaJson(data,x);
        })
            }catch(err){
                alert(err);
            }
   //console.log(document.getElementById("filtroNombre").value);
     });

});


function cargaCitas(){
    try{
$.ajax({
    url: 'getPacientes.php'
})
.done(function(data){
    
ImprTablaJson(data,null);
})
    }catch(err){
        alert(err);
    }
}

function cargaDoctores() {
    
    try {
        $.ajax({

            url: 'getDoctores.php'

        })
            .done(function (data) {
                
                seleccionarDoctor(data);
            });
    } catch (err) {
        alert(err);
    }
}
function seleccionarDoctor(TextoJSON){
return TextoJSON;
}
function ImprTablaJson(TextoJSON,filter){
   // alert(filter);
   // let ids = new Array(); 
    let ObjetoJSON = JSON.parse(TextoJSON);
    console.log(ObjetoJSON);
   
    $("#table").append("<table class='table table-bordered table-hover table-responsive' id='citas' >");
    $("#citas").append("<tr>");
$("#citas").append("<th scope = 'col'>Pacientes</th>");
$("#citas").append("<th scope = 'col'>Cedula</th>");
$("#citas").append("<th scope = 'col'>Correo</th>");
$("#citas").append("<th scope = 'col'>Doctor</th>");
$("#citas").append("<th scope = 'col'>Fecha</th>");
$("#citas").append("<th scope = 'col'>Hora</th>");
$("#citas").append("<th scope = 'col'>Descripcion/Problema</th>");
$("#citas").append("<th scope = 'col'>Actualizar</th>");
$("#citas").append("<th scope = 'col'>Eliminar</th>");
$("#citas").append("<th scope = 'col'>Farmacia</th>");
$("#citas").append("</tr>");



console.log()

    
    for(i=0;i<ObjetoJSON.length;i++){
        if(ObjetoJSON[i].Estado=="Pendiente"){
        $("#citas").append("<tr>");
        $("#citas").append("<th scope = 'row'>"+ObjetoJSON[i].nombre+" </th>");
        $("#citas").append("<td> "+ObjetoJSON[i].cedula+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].correo+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].idDoctor+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].fecha+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].hora+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].descripcion+" </td>");
        $("#citas").append("<td> "+ "<a class='link_edit btn btn-primary' href = actualizaCita.php?idCita="+ObjetoJSON[i].id+">Modificar</a>"+"</td>");
        $("#citas").append("<td>" + "<a class='link_delete btn btn-danger' href = eliminarCita.php?idCita="+ObjetoJSON[i].id+">Eliminar</a>"+"</td>");
      //  $("#citas").append("<td> "+ "<a class='link_edit btn btn-primary' href = recetaMedica.php?idCita="+ObjetoJSON[i].id+">Receta Medica</a>"+"</td>");
      $("#citas").append("<td> "+ "<a class='link_edit btn btn-primary' href = farmacia.php?idCita="+ObjetoJSON[i].id+">Receta Medica</a>"+"</td>");
        $("#citas").append("</tr>");
        }
    }



$("#table").append("</table>");





/*i=0;
n=0;
if(filter=="Luis Jose Solano Soto"){
$("#citas").remove();  
$("#citas").append("<tr>");
$("#citas").append("<th scope = 'col'>Pacientes</th>");
$("#citas").append("<th scope = 'col'>Cedula</th>");
$("#citas").append("<th scope = 'col'>Correo</th>");
$("#citas").append("<th scope = 'col'>Doctor</th>");
$("#citas").append("<th scope = 'col'>Fecha</th>");
$("#citas").append("<th scope = 'col'>Hora</th>");
$("#citas").append("<th scope = 'col'>Descripcion/Problema</th>");
$("#citas").append("<th scope = 'col'>Actualiza</th>");
$("#citas").append("<th scope = 'col'>Elimina</th>");
$("#citas").append("</tr>");
}*/
/*while(filter==ObjetoJSON[i].nombre){


    $("#citas").append("<tr>");
    $("#citas").append("<th scope = 'row'>"+ObjetoJSON[i].nombre+" </th>");
    $("#citas").append("<td> "+ObjetoJSON[i].cedula+ " </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].correo+ " </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].idDoctor+ " </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].fecha+" </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].hora+" </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].descripcion+" </td>");
    $("#citas").append("<td> "+ "<a >No se puede modificar</a>"+"</td>");
    $("#citas").append("<td>" + "<a>No se puede eliminar</a>"+"</td>");
    $("#citas").append("</tr>");
  i++
    n=1;
}*/
/*if(n==0){
    for(i=0;i<ObjetoJSON.length;i++){
        $("#citas").append("<tr>");
        $("#citas").append("<th scope = 'row'>"+ObjetoJSON[i].nombre+" </th>");
        $("#citas").append("<td> "+ObjetoJSON[i].cedula+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].correo+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].idDoctor+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].fecha+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].hora+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].descripcion+" </td>");
        $("#citas").append("<td> "+ "<a >No se puede modificar</a>"+"</td>");
        $("#citas").append("<td>" + "<a>No se puede eliminar</a>"+"</td>");
        $("#citas").append("</tr>");
    }  
}*/

/*for(i=0;i<ObjetoJSON.length;i++){
    $("#citas").append("<tr>");
    $("#citas").append("<th scope = 'row'>"+ObjetoJSON[i].nombre+" </th>");
    $("#citas").append("<td> "+ObjetoJSON[i].cedula+ " </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].correo+ " </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].idDoctor+ " </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].fecha+" </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].hora+" </td>");
    $("#citas").append("<td> "+ObjetoJSON[i].descripcion+" </td>");
    $("#citas").append("<td> "+ "<a href = actualizaCita.php?idCita="+ObjetoJSON[i].id+">Modificar</a>"+"</td>");
    $("#citas").append("<td>" + "<a href = eliminarCita.php?idCita="+ObjetoJSON[i].id+">Eliminar</a>"+"</td>");
    $("#citas").append("</tr>");
}*/

/*
    if( ObjetoJSON[i].ESTADO=='ATENDIDO'){
        $("#citas").append("<tr>");
        $("#citas").append("<th scope = 'row'>"+ObjetoJSON[i].nombre+" </th>");
        $("#citas").append("<td> "+ObjetoJSON[i].cedula+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].correo+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].idDoctor+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].fecha+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].hora+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].descripcion+" </td>");
        $("#citas").append("<td> "+ "<a >No se puede modificar</a>"+"</td>");
        $("#citas").append("<td>" + "<a>No se puede eliminar</a>"+"</td>");
        $("#citas").append("</tr>");
    }else{
        $("#citas").append("<tr>");
        $("#citas").append("<th scope = 'row'>"+ObjetoJSON[i].nombre+" </th>");
        $("#citas").append("<td> "+ObjetoJSON[i].cedula+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].correo+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].idDoctor+ " </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].fecha+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].hora+" </td>");
        $("#citas").append("<td> "+ObjetoJSON[i].descripcion+" </td>");
        $("#citas").append("<td> "+ "<a href = actualizaCita.php?idCita="+ObjetoJSON[i].id+">Modificar</a>"+"</td>");
        $("#citas").append("<td>" + "<a href = eliminarCita.php?idCita="+ObjetoJSON[i].id+">Eliminar</a>"+"</td>");
        $("#citas").append("</tr>");
    }*/
    



}