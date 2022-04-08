var validator = $("#CheckoutForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		vehicle_license_plates:{
			required: true,
		},
		vehicle_registration_type_id:{
			required:true
		},
	},
	messages: {
		vehicle_license_plates: {
			required: "Por favor, ingrese número de placa "
		},
		vehicle_registration_type_id:{
			required:"Por favor, seleccione un tipo de placa"
		},
	}
});

$("#ButtonVehicleoutModal").click(function(event) {
	event.preventDefault();
	if ($('#CheckoutForm').valid()) {

		saveModalout();
	} else {
		validator.focusInvalid();
	}
});


function saveModalout(button) {
	$('.loader').addClass('is-active');
	var formData = $("#CheckoutForm").serialize();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenVehicle').val()},
		url: "/record/check-out",
		data: formData,
		dataType: "json",

        success: function(respuesta) {
            if (respuesta.error) {

                $('.loader').removeClass('is-active');
                BorrarFormularioCheckout();
                $('#modalCheckout').modal("hide");
                Swal.fire(
                    'Error!',
                    respuesta.error,
                    'error'
                  )
            }else{
                $('.loader').removeClass('is-active');
                BorrarFormularioCheckout();
                $('#modalCheckout').modal("hide");
                Swal.fire(
                    'Good job!',
                    respuesta.success,
                    'success'
                  )
            }},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#CheckoutForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}


	});
}


$('#modalCheckout').on('shown.bs.modal', function(event){
	cargarSelectPlacascheckout();
 });

 function cargarSelectPlacascheckout(){
    $('#vehicle_registration_type_id_out').empty();
    $("#vehicle_registration_type_id_out").append('<option value="" selected>Seleccione Tipo de placa</option>');
    $.ajax({
      type: "GET",
      url: "vehicle-registration-types",
      dataType: "json",
      success: function(data){
        $.each(data,function(key, registro) {

          $("#vehicle_registration_type_id_out").append('<option value='+registro.id+' >'+registro.vehicle_registration_type+'</option>');


        });

      },
      error: function(data) {
        alert('error');
      }
      });
    }



    function BorrarFormularioCheckout() {
        $("#CheckoutForm :input").each(function () {
            $(this).val('');
        });
        $('#vehicle_registration_type_id_out').val('');
        $('#vehicle_license_plates').change();
    };

	$('#modalCheckout').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioCheckout();
	});

	$('#modalCheckout').on('shown.bs.modal', function(){
		window.location.hash = '#checkout';

	});
    $('#checkout').click(function (e) {
        $('#modalCheckout').modal('show');
    });
