function ingresaCita(pnombrePaciente,pcedula,pcorreo, pidDoctor,pidSala, pfecha, pHora, pDescripcion) {
//alert(pnombrePaciente);
    try {
        $.ajax(
            {

            data: {

                nombrePaciente: pnombrePaciente,
                cedula:pcedula,
                correo:pcorreo,
                idDoctor: pidDoctor,
                idSala:pidSala,
                fecha: pfecha,
                hora: pHora,
                descripcion: pDescripcion,
            },
            url: 'insertaCita.php',
            type: 'POST',
            datatype: 'json',
            success: function (r) {
                InsercionCitaExitosa(r);
            },
            error: function (r) {
                InsercionCitaFallida(r);

            }
        });

    } catch (err) {
        alert(err);
    }
}

function InsercionCitaExitosa(TextoJSON) {
    
    $("#pnlInfo").dialog();
    $("#pnlInfo").html('<p style="color:black">' + TextoJSON + '</p>');
    LimpiaCampos();
}

function LimpiaCampos() {
    $('#nombrePaciente').val('');
    $('#cedula').val('');
    $('#descripcion').val('');
    $('#correo').val('');
    $("#idDoctor").val("1");
    $("idDia").val("1");
    $("input[name=hora][value='10']").prop("checked", true);
}

function InsercionCitaFallida(TextoJSON) {
    
    $("#pnlMensaje").dialog();
    $("#pnlMensaje").html('<p>Ocurrio un error en el servidor..</p>' + TextoJSON.responseText);
}