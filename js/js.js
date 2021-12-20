/*if (navigator.geolocation) { //check if geolocation is available
  navigator.geolocation.getCurrentPosition(function(position){
    console.log(position);
    https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyC0e3ERjEOvq-2_eiMVsxPWOYlyy4yQcaY
  });
}
$("#montoprestamo").on({
  "focus": function (event) {
      $(event.target).select();
  },
  "keyup": function (event) {
      $(event.target).val(function (index, value ) {
          return value.replace(/\D/g, "")
                      .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ".");
      });
  }
});*/

jQuery(document).ready(function($){
    $(document).ready(function() {
        $('.mi-selector').select2();
    });
});

//NOTE: Eliminar cliente
$('.eliminar_cliente').click(function (e) {
    e.preventDefault();

    var id_cliente = $(this).attr('data-id');
    var ruc = $(this).attr('ruc');
    var Cliente = $(this).attr('name-cliente');
    var parent = $(this)
        .parent("td")
        .parent("tr");

    swal({
        title: "¿Deseas eliminar al cliente " + Cliente + "?",
        text: "!Esto no es reversible!",
        buttons: [
            "No", "Sí!"
        ],
        icon: "warning"
    }).then(willDelete => {
        if (willDelete) {
            $
                .ajax({
                    //url: 'http://pedidos.micropar.com/clientes/eliminar',
                    url: 'http://localhost/paginas/pedidospar/clientes/eliminar',
                    type: 'POST',
                    async: true,
                    data: {
                        id: id_cliente,
                        ruc: ruc
                    }
                })
                .done(function (response) {
                    swal({title: "Cliente eliminado!", icon: "success"})
                    parent.fadeOut('slow');
                })
                .fail(function (xhr, ajaxOptions, thrownError) {
                    swal(
                        {title: "Error, no se pudo eliminar el cliente, a lo mejor tiene deudas pendientes...", icon: "error"}
                    )
                })
                .always(function () {
                    //window.location.href="?p=aplicaciones&eliminar=<?=$row['id']?>"; REDIRIGIR
                });
        }
    });
});
//</ELIMINAR Cliente

//NOTE: Eliminar producto
$('.eliminar_producto').click(function (e) {
    e.preventDefault();

    var idprod = $(this).attr('data-id');
    var Producto = $(this).attr('name-prod');
    var parent = $(this)
        .parent("td")
        .parent("tr");

    swal({
        title: "¿Deseas eliminar el producto " + Producto + "?",
        text: "!Esto no es reversible!",
        buttons: [
            "No", "Sí!"
        ],
        icon: "warning"
    }).then(willDelete => {
        if (willDelete) {
            $
                .ajax({
                    //url: 'http://pedidos.micropar.com/productos/eliminar',
                    url: 'http://localhost/paginas/pedidospar/productos/eliminar',
                    type: 'POST',
                    async: true,
                    data: {
                        id: idprod
                    }
                })
                .done(function (response) {
                    console.log(response);
                    swal({title: "Producto eliminado!", icon: "success"})
                    parent.fadeOut('slow');
                })
                .fail(function (xhr, ajaxOptions, thrownError) {
                    swal(
                        {title: "Error, no se pudo eliminar el producto, a lo mejor esta en alguna venta...", icon: "error"}
                    )
                })
                .always(function () {
                    //window.location.href="?p=aplicaciones&eliminar=<?=$row['id']?>"; REDIRIGIR
                });
        }
    });
});
//</ELIMINAR producto

//NOTE: Buscador con ajax.
$(document).on('keyup', '.table_search', function(){

    var valor = $(this).val();
        if(valor.length >= 2){
            buscar_datos(valor);
        }else{
            buscar_datos();
        }
    
});

const formatoMexico = (number) => {
    const exp = /(\d)(?=(\d{3})+(?!\d))/g;
    const rep = '$1.';
    let arr = number.toString().split(',');
    arr[0] = arr[0].replace(exp,rep);
    return arr[1] ? arr.join(','): arr[0];
}


function buscar_datos(consulta){
	$.ajax({
		//url : 'http://pedidos.micropar.com/pedido/buscar',
        url : 'http://localhost/paginas/pedidospar/pedido/buscar',
		type : 'POST',
		dataType : 'html',
        async : true,
		data : { consulta: consulta },
		})

	.done(function(respuesta){
		$("#LiAjax").html(respuesta);

        $('.ProdBtn').on('click', function() {
            $('.table_search').val("");
            

            var CantProd = document
            .getElementById('CantProd')
            .value;
        
            if (isNaN(CantProd)) {
                var CantProd = 1;
            } else if (CantProd === null || CantProd === '') {
                var CantProd = 1;
            } else {}
        
            var idprod = $(this).attr('IP');
            var nombreProd = $(this).attr('NP');
            var precioProd = $(this).attr('PP').replaceAll(',', '.');
            var codeProd = $(this).attr('CP');

            var totalProd = precioProd * CantProd;

            var TotalClear = formatoMexico(totalProd);
            var precioProdClear = formatoMexico(precioProd-0);

            if (! $("#dltprod"+idprod).length){
                
                $("#tirar_aca").append(
                    '<tr>'+
                        '<td><button class="btn btn-danger" np2='+ nombreProd +' id="dltprod'+idprod+'">x</button></td>'+
                        '<input name="IdProd[]" value=' + idprod + ' type="hidden">' +
                        '<input name="CodProd[]" value=' + codeProd + ' type="hidden">' +
                        '<td>' + nombreProd + '</td>'+
                        '<td><input readonly name="PrecProdV[]" type="text" value="' + precioProdClear + '" id="precio'+idprod+'" class="text-center precioPV" style="width:70px;color:red;"></td>'+
                        '<td><input name="CantProdV[]" style="width:50px;" type="text" min="1" value="' + CantProd + '" id="canti'+idprod+'" ></td>'+
                        '<td><input readonly name="TotalProdV[]" type="text" value="' + TotalClear + '" id="resultado'+idprod+'" class="text-center total-fila" style="width:80px;color:red;"></td>'+
                    '</tr>',
                    CalcularTotalVenta()
                );
                
                $('#CantProd').val("");

            }else{

                var TotalVentaGeneral = document.getElementById("TotalVenta");
                var TotalVentasViejo = document.getElementById("resultado"+idprod).value;

                var total = TotalVentaGeneral.value-TotalVentasViejo;
                TotalVentaGeneral.value = total;

                //NOTE: SI EXISTE EL PRODUCTO EN LA VENTA
                //NOTE:  CANTIDAD SERA IGUAL A LO QUE ESTA EN EL INPUT
                var CantidadEnVentas = document.getElementById("canti"+idprod);
                CantidadEnVentas.value = CantProd;

                var TotalVentas = document.getElementById("resultado"+idprod);
                TotalVentas.value = TotalClear;
                
                CalcularTotalVenta();
                $('#CantProd').val("");
                
            }

            $('#canti'+idprod).on('keyup', function(e){
                e.preventDefault();

                jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));

                var precio = document.getElementById("precio"+idprod).value;
                var precioClear = parseFloat(precio.replace('.','')) || 0;

                var cantidad = document.getElementById("canti"+idprod).value;
                var resultado = document.getElementById("resultado"+idprod);
                
                var totalEnCant = precioClear*cantidad

                resultado.value = formatoMexico(totalEnCant);
                CalcularTotalVenta();
            });
        
            $('#dltprod'+idprod).click(function (e){
                e.preventDefault();
        
                var TotalVentaGeneral = document.getElementById("TotalVenta");
                var LeerTotal = document.getElementById("resultado"+idprod).value;
        
                var np2 = $(this).attr('np2');
                var parent = $(this)
                    .parent("td")
                    .parent("tr");
        
                swal(
                    {title: "¿Deseas sacar este producto "+np2+" de tu venta?", icon: "warning", buttons: true, dangerMode: true}
                ).then((willDelete) => {
                    if (willDelete) {
        
                    var total = TotalVentaGeneral.value-LeerTotal;
        
                    TotalVentaGeneral.value = total;
        
                    parent.remove();
        
                    } else if (willDelete) {}
                });
        
            }); //NOTE: final del sweet alert
        
            function CalcularTotalVenta(){
                $(document).ready(function(){
                    var parent = $('#tirar_aca tr');
                    var TotalVentaGeneral = document.getElementById("TotalVenta");
        
                    for(i = 0; i < parent.length; i++){
                        // suma todos los totales de fila
                        var totalesFila = document.querySelectorAll(".total-fila");
                        var total = 0;

                        for (var x = 0; x < totalesFila.length; x++) {
   
                        total += (parseInt(totalesFila[x].value.replaceAll('.', '')) || 0);

                        }
                        TotalVentaGeneral.value = formatoMexico(total);
                    }
                });
            }
        });
	})
  .fail(function() {
    console.log("error");
  })
}

$('#btnpedido').click(function (e){
    e.preventDefault();
    var form = $(this).parents('form');

    swal(
        {title: "¿Estas seguro que deseas realizar el pedido?", icon: "warning", buttons: true, dangerMode: true}
    ).then((isConfirm) => {
        if (isConfirm) {
            form.submit();
        } else if (isConfirm) {
            
        }
    });

}); //NOTE: final del sweet alert