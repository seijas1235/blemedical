$.validator.addMethod("nombreUnico", function(value, element) {
    var valid = false;
    $.ajax({
      type: "GET",
      async: false,
      url: "/vehicle-licence-plate-unique",
      data: "vehicle_license_plates=" + value,
      dataType: "json",
      success: function(msg) {
        valid = !msg;
      }
    });
    return valid;
  }, "El vehiculo ya está registrado en el sistema");

var validator = $("#VehicleresForm").validate({
	ignore: [],
	onkeyup:false,
    onclick: false,
	//onfocusout: true,
	rules: {
		vehicle_license_plates:{
			required: true,
			nombreUnico: true
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
			required:"Por favor, seleccione un nivel"
		},
	}
});

$("#ButtonVehicleResModal").click(function(event) {
	event.preventDefault();
	if ($('#VehicleresForm').valid()) {

		saveModalres();
	} else {
		validator.focusInvalid();
	}
});

function saveModalres(button) {
	$('.loader').addClass('is-active');
	var formData = $("#VehicleresForm").serialize();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenVehicle').val()},
		url: "/vehicle/save-res",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormulariores();
			$('#modalres').modal("hide");
            Swal.fire(
                'Good job!',
                'Vehiculo recidente creado con exito!',
                'success'
              )

		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#VehicleresForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}

	});
}


$('#modalres').on('shown.bs.modal', function(event){
	cargarSelectPlacasres();
 });

 function cargarSelectPlacasres(){
    $('#vehicle_registration_type_idres').empty();
    $("#vehicle_registration_type_idres").append('<option value="" selected>Seleccione Tipo de placa</option>');
    $.ajax({
      type: "GET",
      url: "vehicle-registration-types",
      dataType: "json",
      success: function(data){
        $.each(data,function(key, registro) {

          $("#vehicle_registration_type_idres").append('<option value='+registro.id+'>'+registro.vehicle_registration_type+'</option>');


        });

      },
      error: function(data) {
        alert('error');
      }
      });
    }



    function BorrarFormulariores() {
        $("#VehicleresForm :input").each(function () {
            $(this).val('');
        });
        $('#vehicle_registration_type_id').val('');
        $('#vehicle_license_plates').change();
    };

	$('#modalres').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormulariores();
	});

	$('#modalres').on('shown.bs.modal', function(){
		window.location.hash = '#createres';

	});
    $('#vres').click(function (e) {
        $('#modalres').modal('show');
    });
