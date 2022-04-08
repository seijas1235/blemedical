$('#close').click(function (e) {
    Swal.fire({
        title: 'Crear nuevo mes',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Look up',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
          return fetch(`/record/close-record`,{method: 'POST',
          headers: {'X-CSRF-TOKEN': $('#tokenVehicle').val()},})
            .then(response => {
              if (!response.ok) {
                throw new Error(response.statusText)
              }
              return response.json()
            })
            .catch(error => {
              Swal.showValidationMessage(
                `Request failed: ${error}`
              )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {

            Swal.fire(
                'Exito',
                'Inicio de mes Creado con exito',
                'success'
              )
      })
});
