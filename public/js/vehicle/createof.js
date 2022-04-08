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

var validator = $("#VehicleOfForm").validate({
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

$("#ButtonVehicleModal").click(function(event) {
	event.preventDefault();
	if ($('#VehicleofForm').valid()) {

		saveModalof();
	} else {
		validator.focusInvalid();
	}
});

function saveModalof(button) {
	$('.loader').addClass('is-active');
	var formData = $("#VehicleofForm").serialize();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenVehicle').val()},
		url: "/vehicle/save-of",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioCheckIn();
			$('#modalCreateOf').modal("hide");
            Swal.fire(
                'Good job!',
                'You clicked the button!',
                'success'
              )

		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#VehicleofForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}

	});
}


$('#modalCreateOf').on('shown.bs.modal', function(event){
	cargarSelectPlacas();
 });

 function cargarSelectPlacas(){
    $('#vehicle_registration_type_id').empty();
    $("#vehicle_registration_type_id").append('<option value="" selected>Seleccione Tipo de placa</option>');
    $.ajax({
      type: "GET",
      url: "vehicle-registration-types",
      dataType: "json",
      success: function(data){
        $.each(data,function(key, registro) {

          $("#vehicle_registration_type_id").append('<option value='+registro.id+' >'+registro.vehicle_registration_type+'</option>');


        });

      },
      error: function(data) {
        alert('error');
      }
      });
    }



    function BorrarFormularioCheckIn() {
        $("#VehicleOfForm :input").each(function () {
            $(this).val('');
        });
        $('#vehicle_registration_type_id').val('');
        $('#vehicle_license_plates').change();
    };

	$('#modalCreateOf').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioCheckIn();
	});

	$('#modalCreateOf').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	});
    $('#vof').click(function (e) {
        $('#modalCreateOf').modal('show');
    });
