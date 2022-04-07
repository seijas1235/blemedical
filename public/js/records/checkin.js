$('#modalUpdateHabitacion').on('shown.bs.modal', function(event){
	cargarSelectPlacas();
 });

 function cargarSelectPlacas(){
    $('#tipo_placa_id').empty();
    $("#tipo_placa_id").append('<option value="" selected>Seleccione Tipo de placa</option>');
    $.ajax({
      type: "GET",
      url: "{{route('vechicle.plates')}}",
      dataType: "json",
      success: function(data){
        $.each(data,function(key, registro) {

          $("#tipo_placa_id").append('<option value='+registro.id+' selected>'+registro.vehicle_licence_plate+'</option>');


        });

      },
      error: function(data) {
        alert('error');
      }
      });
    }



    function BorrarFormularioCheckIn() {
        $("#HabitacionForm :input").each(function () {
            $(this).val('');
        });
        $('#roles').val('');
        $('#roles').change();
    };

	$('#modalcheckin').on('hide.bs.modal', function(){
		window.location.hash = '#';
		$("label.error").remove();
		BorrarFormularioCheckIn();
	});

	$('#modalcheckin').on('shown.bs.modal', function(){
		window.location.hash = '#create';

	});
    $('#checkin').click(function (e) {
        $('#modalcheckin').modal('show');
    });
