$(document).ready(function () {
    cargaMedicina();
});


function cargaMedicina() {
    try {
        $.ajax({
            url: 'getFarmacia.php'
        })
            .done(function (data) {
                ImprTablaMJson(data);
            })
    } catch (err) {
        alert(err);
    }
}

function ImprTablaMJson(TextoJSON) {
    //  filtrar(TextoJSON);
    let ObjetoJSON = JSON.parse(TextoJSON);
    //alert(ObjetoJSON[0].Descripcion);
    $("#medicamentos").append("<tr>");
    $("#medicamentos").append("<th scope = 'col'>Identificador del Medicamento</th>");
    $("#medicamentos").append("<th scope = 'col'>Nombre del Medicamento</th>");
    $("#medicamentos").append("<th scope = 'col'>Precio del Medicamento</th>");
    $("#medicamentos").append("<th scope = 'col'>Descripcion del Medicamento</th>");
   // $("#medicamentos").append("<th scope = 'col'>Actualiza</th>");
   // $("#medicamentos").append("<th scope = 'col'>Elimina</th>");
    $("#medicamentos").append("</tr>");

    for (i = 0; i < ObjetoJSON.length; i++) {

        $("#medicamentos").append("<tr>");
        $("#medicamentos").append("<th scope = 'row'>" + ObjetoJSON[i].id + " </th>");
        $("#medicamentos").append("<td> " + ObjetoJSON[i].nombre + " </td>");
        $("#medicamentos").append("<td> " + ObjetoJSON[i].precio + " </td>");
        $("#medicamentos").append("<td> " + ObjetoJSON[i].descripcion + " </td>");
        //$("#medicamentos").append("<td> " + "<a href = actualizaMedicamento.php?idCita=" + ObjetoJSON[i].ID + "&nombre=" + ObjetoJSON[i].NOMBRE + ">Modificar</a>" + "</td>");
       // $("#medicamentos").append("<td>" + "<a href = eliminarMedicamento.php?idCita=" + ObjetoJSON[i].ID + ">Eliminar</a>" + "</td>");
        $("#medicamentos").append("</tr>");


    }

}


function limpiarTabla() {
    $("#medicamentos").remove();
}
