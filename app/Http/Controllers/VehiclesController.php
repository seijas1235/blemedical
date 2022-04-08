<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleRegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class VehiclesController extends Controller
{
    //guardar vehiculos oficiales
    public function store_vehicle_of(Request $request){

        Vehicle::create($request->all());
        return Response::json(['success' => 'Éxito']);
    }
    //guarda vehiculos recidentes
    public function store_vehicle_res(Request $request){
        $data=$request->all();
        $data['vehicle_type_id']=2;
        Vehicle::create($data);
        return Response::json(['success' => 'Éxito']);
    }
    //comprueba que la placa no este registrada en sistema
    public function get_vehicle_plates(Request $request)
    {
        $dato = $request->vehicle_license_plates;
        $query = Vehicle::where("vehicle_license_plates",$dato)->get();
        $contador = count($query);
        if ($contador == 0)
        {
            return 'false';
        }
        else
        {
            return 'true';
        }

    }
    public function get_vehicle_registration(){
        $result = VehicleRegistrationType::select('id','vehicle_registration_type')->get();

        return Response::json( $result );
    }
}
