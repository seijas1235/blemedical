<!-- Modal -->
<div class="modal fade" id="modalcheckin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    {!! Form::open( array( 'id' => 'HabitacionForm' ) ) !!}

      <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Agregar Entrada</h4>
            </div>
            <div class="modal-body">


                <div class="row">

                <div class="col-sm-6">
                  {!! Form::label("precio","Precio:") !!}
                  {!! Form::number( "precio" , null , ['class' => 'form-control' , 'placeholder' => 'Precio']) !!}
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-12">
                  {!! Form::label("descripcion","Descripción:") !!}
                  {!! Form::text( "descripcion" , null , ['class' => 'form-control' , 'placeholder' => 'Ingrese la descripción']) !!}
                </div>
              </div>
              <br>
              <input type="hidden" name="_token" id="tokenHabitacion" value="{{ csrf_token() }}">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" id="ButtonHabitacionModal" >Agregar</button>
            </div>
          </div>
        </div>
    {!! Form::close() !!}
      </div>

