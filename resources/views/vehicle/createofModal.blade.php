<!-- Modal -->
<div class="modal fade" id="modalCreateOf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    {!! Form::open( array( 'id' => 'VehicleOfForm' ) ) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Agregar Vehiculo Oficial</h4>
            </div>
            <div class="modal-body">


                <div class="row">

                <div class="col-sm-3">
                    {!! Form::label("vehicle_registration_type_id","Tipo de Placa:") !!}
                    <select class="form-control" name="vehicle_registration_type_id" id="vehicle_registration_type_id">
                    </select>
                </div>
                <div class="col-sm-8">
                    {!! Form::label("vehicle_license_plates","número de Placa:") !!}
                    {!! Form::text( "vehicle_license_plates" , null , ['class' => 'form-control' , 'placeholder' => 'Ingrese número de Placa']) !!}
                  </div>
              </div>
              <br>
              <br>
              <input type="hidden" name="_token" id="tokenVehicle" value="{{ csrf_token() }}">
              <input type="hidden" name="vehicle_type_id" id="vehicle_type_id" value="1">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonVehicleOfModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>

