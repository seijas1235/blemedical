var validator = $("#CheckinForm").validate({
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

$("#ButtonVehicleinModal").click(function(event) {
	event.preventDefault();
	if ($('#CheckinForm').valid()) {

		saveModalin();
	} else {
		validator.focusInvalid();
	}
});


function saveModalin(button) {
	$('.loader').addClass('is-active');
	var formData = $("#CheckinForm").serialize();
	$.ajax({
		type: "POST",
		headers: {'X-CSRF-TOKEN': $('#tokenVehicle').val()},
		url: "/record/check-in",
		data: formData,
		dataType: "json",
		success: function(data) {
			$('.loader').removeClass('is-active');
			BorrarFormularioCheckIn();
			$('#modalCheckin').modal("hide");
            Swal.fire(
                'Good job!',
                'Checkin creado con exito!',
                'success'
              )

		},
		error: function(errors) {
			$('.loader').removeClass('is-active');
			var errors = JSON.parse(errors.responseText);
			if (errors.nombre != null) {
				$("#CheckinForm input[name='nombre'] ").after("<label class='error' id='ErrorNombre'>"+errors.nombre+"</label>");
			}
			else{
				$("#ErrorNombre").remove();
			}
		}

	});
}


$('#modalCheckin').on('shown.bs.modal', function(event){
	cargarSelectPlacascheckin();
 });

 function cargarSelectPlacascheckin(){
    $('#vehicle_registration_type_id_in').empty();
    $("#vehicle_registration_type_id_in").append('<option value="" selected>Seleccione Tipo de placa</option>');
    $.ajax({
      type: "GET",
      url: "vehicle-registration-types",
      dataType: "json",
      success: function(data){
        $.each(data,function(key, registro) {

          $("#vehicle_registration_type_id_in").append('<option value='+registro.id+' >'+registro.vehicle_registration_type+'</option>');


        });

      },
      error: function(data) {
        alert('error');
      }
      });
    }



    function BorrarFormularioCheckIn() {
        $("#CheckinForm :input").each(function () {
            $(this).val('');
        });
        $('#vehicle_registration_type_id_in').val('');
        $('#vehicle_license_plates').change();
    };

	$('#modalCheckin').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioCheckIn();
	});

	$('#modalCheckin').on('shown.bs.modal', function(){
		window.location.hash = '#checkin';

	});
    $('#checkin').click(function (e) {
        $('#modalCheckin').modal('show');
    });
