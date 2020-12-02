$(document).ready(function () {
    //cargaDias();
    cargaDoctores();
    cargaCitas();

    $("#btEnviar").click(function () {
        actualizaCita($("#idCita").val(),
        $("#nombrePaciente").val(),$("#cedula").val(),$("#correo").val(),$("#idDoctor").val(),
            $("#datepicker").val(),$("input[name='hora']:checked").val(),$("#descripcion").val());
    });

    $("#btRestablecer").click(function () {
        LimpiaCampos();
    });

});


function cargaDoctores() {
    try {
        $.ajax({

            url: 'getDoctores.php'

        })
            .done(function (data) {
                LlenaDoctorJson(data);
            });
    } catch (err) {
        alert(err);
    }
}
function cargaCitas() {
    try {
        $.ajax({
            
            url: 'getCita.php?idCita=' + $("#idCita").val()
        })
            .done(function (data) {
               // console.log($("#idCita").val());
               //  console.log(data);
                  LlenarCitaJson(data);
            })
    } catch (err) {
        alert(err);
    }
}


function actualizaCita(pidCita, 
                       pnombrePaciente,
                       pcedula,pcorreo, pidDoctor,
                       pfecha, pHora, pDescripcion) {
                           
    
    try {
        $.ajax({
            data: {
                idCita: parseInt(pidCita),
                nombrePaciente: pnombrePaciente,
                cedula:pcedula,
                correo:pcorreo,
                idDoctor: pidDoctor,
                fecha: pfecha,
                hora: pHora,
                descripcion: pDescripcion,
                
            },
            url: 'actualiza.php',
            type: 'POST',
            dataType: 'json',
            success: function (r) {
                //console.log(r);
                window.location.replace("citas.php");
              //  ActualizacionInsercionCitaExitosa(r);
            },
            error: function (r) {
                window.location.replace("citas.php");
               // console.log(r);
              // ActualizacionCitaFallida(r);
            }
        });
    } catch (err) {
        alert(err);
    }
}


function LlenaDoctorJson(TextoJSON) {

    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);

//console.log(ObjetoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i]._id;
      //  alert(elValor);
        elHTML = ObjetoJSON[i].NOMBRE;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML));
        
    }
}
function ActualizacionInsercionCitaExitosa(TextoJSON) {
    $("#pnlInfo").dialog();
    $("#pnlInfo").html('<p>' + TextoJSON + '</p>');
    LimpiaCampos();
    window.location.replace("citas.php");
}
function LimpiaCampos(){
    $('#nombrePaciente').val('');
    $('#cedula').val('');
    $('#correo').val('');
    $('#descripcion').val('');
    $("#idDoctor").val("1");
    $("idDia").val("1");
    $("input[name=hora][value='10']").prop("checked",true);
}
function ActualizacionCitaFallida(TextoJSON){
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p> Ocurrio un error en el servidor </p>'+TextoJSON.responseText);
}
function LlenarCitaJson(TextoJSON){
   
var ObjetoJSON=JSON.parse(TextoJSON);

console.log(ObjetoJSON);
console.log(ObjetoJSON.idDoctor[0]);

    $('#nombrePaciente').val(ObjetoJSON.nombre);
    $('#cedula').val(ObjetoJSON.cedula);
    $('#correo').val(ObjetoJSON.correo);
    $('#descripcion').val(ObjetoJSON.descripcion);
    $('#idDoctor').val(ObjetoJSON.idDoctor[0]._id);
    $("input[name=hora][value="+ObjetoJSON.hora+"]").prop("checked",true);
    $("#datepicker").datepicker("setDate", ObjetoJSON.fecha);
 
}






