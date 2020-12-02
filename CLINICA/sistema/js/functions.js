$(document).ready(function() {
    
$("#txt_id_producto").keyup(function(e){
    
    e.preventDefault();
    var producto = $(this).val();
    var action = 'infoProducto';

    if(producto != ''){
        $.ajax({
            url: 'ajax.php',
            type:  'POST',
            async: true,
            data: {action:action, producto:producto},
            success: function(response)
            {
               // console.log(response);
                if(response != 'error'){
                    var info = JSON.parse(response);
                  // var info = response;
                 //  console.log(info+"keyup");
                   // console.log(info[0].nombre);
                    $('#txt_nombre').html(info[0].nombre);
                    $('#txt_precio').html(info[0].precio);
                    $('#txt_descripcion').html(info[0].descripcion);
                    $('#txt_cant_producto').val('1');
                    $('#txt_precio_total').html(info[0].precio)
                    $('#txt_cant_producto').removeAttr('disabled');   
                    $('#add_product_venta').slideDown();
                }else{
                    $('#txt_nombre').html('-');
                    $('#txt_descripcion').html('-');
                    $('#txt_cant_producto').val('0');
                    $('#txt_precio').html('0.00');
                    $('#txt_precio_total').html('0.00');
                    $('#txt_cant_producto').attr('disabled','disabled');   
                    $('#add_product_venta').slideUp();
                }
                
            },
            error: function(error){
                console.log(error);
            }
        });
    }

});



$('#txt_cant_producto').keyup(function (e){
    e.preventDefault();
    //Aca obtiene la cantidad de productos por el precio
    var precio_total = $(this).val() * $('#txt_precio').html();
    var existencia = parseInt($('#txt_existencia').html());
    $('#txt_precio_total').html(precio_total);
    

    if( ($(this).val() < 1 || isNaN($(this).val())) || ( $(this).val() > existencia ) ){
        $('#add_product_venta').slideUp();
    }else{
        $('#add_product_venta').slideDown();
    }

});

$('#add_product_venta').click(function(e){
    e.preventDefault();

    if($('#txt_cant_producto').val() > 0){

        var idproducto =  $('#txt_id_producto').val();
        var cantidad =  $('#txt_cant_producto').val();
        var action = 'addProductoDetalle';
        var idPaciente = $('#idCita').val();
        var comentario=$('#comentario').val();
  // console.log(comentario);
        
        $.ajax({
            url: 'ajax.php',
            type:  'POST',
            async: true,
            data: {action:action, producto:idproducto, cantidad:cantidad,paciente:idPaciente,comentario:comentario},
            success: function(response)
            {
             //  console.log("hola agregando");
                ActualizacionInsercionCitaExitosa(response)
                $('#txt_id_producto').val('0');
                $('#txt_nombre').html('-');
                $('#txt_descripcion').html('-');
                $('#txt_cant_producto').val('0');
                $('#txt_precio').html('0.00');
                $('#txt_precio_total').html('0.00');
                $('#txt_cant_producto').attr('disabled','disabled');  
                $('#comentario').val(''); 
                $('#add_product_venta').slideUp();
            },
            error: function(error){
                console.log(error);
            }
        });
    }

});

/*
$('#add_product_venta').click(function(e){
    e.preventDefault();

    if($('#txt_cant_producto').val() > 0){

        var idproducto =  $('#txt_id_producto').val();
        var cantidad =  $('#txt_cant_producto').val();
        var action = 'addProductoDetalle';//
        var idPaciente = $('#idCita').val();
        var total = $('#total').val();
console.log(total+",,,total");
        $.ajax({
            url: 'ajax.php',
            type:  'POST',
            async: true,
            data: {action:action, producto:idproducto, cantidad:cantidad,paciente:idPaciente},
            success: function(response)
            {
                if(response != 'error'){

                    var info = JSON.parse(response);
                    // var info = response;
                    console.log("hola");
                     console.log(info+"keyup");

                 //  var info = JSON.parse(response);

                    $('#detalle_venta').html(info.detalle);
                    $('#detalle_totales').html(info.totales)

                    $('#txt_id_producto').val('');
                    $('#txt_descripcion').html('-');
                    $('#txt_cant_producto').val('0');
                    $('#txt_existencia').html('-');
                    $('#txt_precio').html('0.00');
                    $('#txt_precio_total').html('0.00');

                    $('#txt_cant_producto').attr('disabled','disabled');  
                    $('#add_product_venta').slideUp();
                }else{
                    console.log('error');
                }
               // viewProcesar();
            },
            error: function(error){
                console.log(error);
            }
        });
    }

});*/




});

function ActualizacionInsercionCitaExitosa(TextoJSON) {
    Mensaje=JSON.parse(TextoJSON);
   // console.log("hola>>>>"+Mensaje);
    $("#pnlInfo").dialog();
    $("#pnlInfo").html('<p>' + Mensaje[0] + '</p>');
    
    //console.log(Mensaje[0]);
    //window.location.replace("farmacia.php?idCita="+Mensaje[1]);
}
/*
function seachForDetalle(id){
    //console.log("si entra por aca");
    var action = 'searchForDetalle';
    var user = id;

    $.ajax({
        url: 'ajax.php',
        type:  'POST',
        async: true,
        data: {action:action},
        success: function(response)
        {
            if(response != 'error'){
               //console.log(response);
                var info = JSON.parse(response);
                console.log(info);
              //  console.log(info["detalle"]);
                $('#detalle_venta').html(info.detalle);
                $('#detalle_totales').html(info.totales)
            }
           // viewProcesar();
        },
        error: function(error){
            console.log(error);
        }
    });
}*/
