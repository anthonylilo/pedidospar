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
                    url: 'http://localhost/paginas/Cobranzas/clientes/eliminar',
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
                    url: 'http://localhost/paginas/micropar-pedidos/productos/eliminar',
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
function numberWithCommas(x) {  
    var parts = x.toString().split(",");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d)\.?)/g, "," , ".");
    return parts.join(".");
}

function format(input) {
    var num = input.value.replace(/\,/g, '');
    var decimales = "";
    if (num.indexOf(".") >= 0) { 
      decimales = "." + num.split(".")[1].substring(0,2); // sólo nos quedamos con los dos primeros decimales
      num = Math.floor(num); // redondeamos hacia abajo para quedarnos con la parte entera
    }
    if (!isNaN(num)) {
      num = num.toString().split('').reverse().join('').replace(/(?=\d*\,?)(\d{3})/g, '$1,');
      // añadir los decimales al final!
      num = num.split('').reverse().join('').replace(/^[\,]/, '') + decimales;
      input.value = num;
    }
    else {
      alert('Solo se permiten numeros');
      input.value = input.value.replace(/[^\d\,\.]*/g, '');
    }
}

function buscar_datos(consulta){
	$.ajax({
		url : 'http://localhost/paginas/micropar-pedidos/pedido/buscar',
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
            var precioProd = $(this).attr('PP');

            var totalProd = precioProd * CantProd;

            if (! $("#dltprod"+idprod).length){
                
                $("#tirar_aca").append(
                    '<tr>'+
                        '<td><button class="btn btn-danger" np2='+ nombreProd +' id="dltprod'+idprod+'">x</button></td>'+
                        '<input name="IdProd[]" value=' + idprod + ' type="hidden">' +
                        '<td>' + nombreProd + '</td>'+
                        '<td><input readonly name="PrecProdV[]" type="number" value="' + precioProd + '" id="precio'+idprod+'" class="bg-danger text-center precioPV w-50"></td>'+
                        '<td><input name="CantProdV[]" class="w-25" type="text" min="1" value="' + CantProd + '" id="canti'+idprod+'" ></td>'+
                        '<td><input readonly name="TotalProdV[]" type="number" value="' + totalProd + '" id="resultado'+idprod+'" class="bg-danger text-center total-fila w-50"></td>'+
                    '</tr>'+CalcularTotalVenta()
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
                TotalVentas.value = totalProd;
                
                CalcularTotalVenta();
                $('#CantProd').val("");
                
            }

            $('#canti'+idprod).on('keyup', function(e){
                e.preventDefault();

                jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));

                var precio = document.getElementById("precio"+idprod).value;
                var cantidad = document.getElementById("canti"+idprod).value;
                var resultado = document.getElementById("resultado"+idprod);

                resultado.value = cantidad*precio.replaceAll(',', '.');
                numberWithCommas(resultado.value);
        
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
                        // suma todos los totales de fila numberWithCommas
                        var totalesFila = document.querySelectorAll(".total-fila");
                        var total = 0;
                        for (var x = 0; x < totalesFila.length; x++) {
                        total += (parseInt(totalesFila[x].value) || 0);
                        }
                        TotalVentaGeneral.value = numberWithCommas(total);
                    }
                });
            }
        });
	})
  .fail(function() {
    console.log("error");
  })
}

$(document).on('keyup', '.table_search', function(){

var valor = $(this).val();
    if(valor.length >= 3){
        buscar_datos(valor);
    }else{
        buscar_datos();
    }

});