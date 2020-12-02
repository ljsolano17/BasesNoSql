$(document).ready(function () {
    
    cargaDoctores();
    cargaSalas();
    
    
    $("#btEnviar").click(function () {
       
    alert($("#nombrePaciente").val());
      ingresaCita($("#nombrePaciente").val(),$("#cedula").val(),$("#correo").val(),$("#idDoctor").val(),$("#idSala").val(),$("#datepicker").val(),
            $("input[name='hora']:checked").val(),$("#descripcion").val());

            
    });

   


    $("#btRestablecer").click(function () {
       LimpiaCampos();
    });

});

$(document).on('change', '#idSala', function() {
    var value = $(this).val();
    console.log(value);  
    cargaSalas2(value);
});

/*
$("#idSala").click(function(){
    var selectedCountry = $(this).children("option:selected").val();
    console.log(selectedCountry+"asdasd");
});*/
function cargaSalas2(id) {
    
    try {
        $.ajax({

            url: 'getSalas.php?idSala='+id

        })
            .done(function (data) {
                
                LlenaOtrosJson(data);
                //console.log(data);
            });
    } catch (err) {
        alert(err);
    }
}
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

function cargaSalas() {
    
    try {
        $.ajax({

            url: 'getSalas.php'

        })
            .done(function (data) {
                
               LlenaSalasJson(data);
            });
    } catch (err) {
        alert(err);
    }
}


function LlenaDoctorJson(TextoJSON) {

    var elValor;
    var elHTML;
    var ObjetoJSON = JSON.parse(TextoJSON);


    for (i = 0; i < ObjetoJSON.length; i++) {
        elValor = ObjetoJSON[i]._id;
      //  alert(elValor);
        elHTML = ObjetoJSON[i].NOMBRE;
        $('#idDoctor').append($('<option></option>').val(elValor).html(elHTML));
        
    }
}


function LlenaOtrosJson(TextoJSON){

    /*
    Cargar los datos de tipo sala y sede con base a la sala seleccionada
    */
   console.log(TextoJSON);
}







function LlenaSalasJson(TextoJSON) {

   /* var elValor;
    var elHTML;*/
    var id_Sala ;
    var id_Tsala ;
    var  id_Sede ;
    var  nombre_sala ;
    var nombre_tipo ;
    var nombre_sede ;

    var ObjetoJSON = JSON.parse(TextoJSON);

    //console.log(ObjetoJSON[0].nombre_sala);
   // console.log(ObjetoJSON[0].tipo_sala[0]);
   // console.log(ObjetoJSON[0].tipo_sala[0].nombre_tipo_sala);
   // console.log(ObjetoJSON[0].tipo_sala[0].nombre_tipo_sala);


//array=[{"_id":{"$oid":"5fa3d1bead92ddfa8984e76f"},"_id_sala":1,"nombre_sala":"Sala01","tipo_sala":[{"_id_tipo_sala":1,"nombre_tipo_sala":"Consultorio"}],"sede":[{"_id_sede":1,"nombre_sede":"San Jose","direccion":"San Jose"}]},{"_id":{"$oid":"5fa3d1bfad92ddfa8984e770"},"_id_sala":2,"nombre_sala":"Sala02","tipo_sala":[{"_id_tipo_sala":2,"nombre_tipo_sala":"Cirugia"}],"sede":[{"_id_sede":2,"nombre_sede":"Alajuela","direccion":"Alajuela"}]}];
//console.log(JSON.parse(array));   
//console.log(array[1].tipo_sala[0].nombre_tipo_sala); 
//console.log(ObjetoJSON[0].tipo_sala[0].nombre_tipo_sala);
console.log(ObjetoJSON);
    for (i = 0; i < ObjetoJSON.length; i++) {
        
            id_Sala  = ObjetoJSON[i]._id_sala;
            id_Tsala = ObjetoJSON[i].tipo_sala[0]._id_tipo_sala;
            id_Sede  = ObjetoJSON[i].     sede[0]._id_sede;
            nombre_sala = ObjetoJSON[i].nombre_sala;
            nombre_tipo = ObjetoJSON[i].tipo_sala[0].nombre_tipo_sala;
            nombre_sede = ObjetoJSON[i].sede[0].nombre_sede;
            $('#idSala').append($('<option></option>').val(id_Sala).html(nombre_sala));
            $('#idTSala').append($('<option></option>').val(id_Tsala).html(nombre_tipo));
            $('#idSede').append($('<option></option>').val(id_Sede).html(nombre_sede));
            //console.log(nombre_tipo_sala);
        
      
        
    }
    
}


