<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Residentes</title>
    <!-- Bootstrap CSS --></head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <h2>Listado de Vehiculos Residentes</h2>
            </div>
        </div>
        <div class="row">
            <div class="card-body">
                <table class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" border="1">
                    <caption>Listado de Vehiculos Residentes</caption>
                    <thead>
                    <tr>
                        <th scope="col">Num. Placa</th>
                        <th scope="col">Tiempo estacionado (min.)</th>
                        <th scope="col">Cantidad a pagar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($recidentes as $recidente)
                        <tr>
                            <th scope="row">{{ $recidente->vehicle_registration_type.'-'.$recidente->vehicle_license_plates }}</th>
                            <td>{{ $recidente->parking_time }}</td>
                            <td>$. {{ $recidente->total }}</td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>
    </div>
</body>
</html>
