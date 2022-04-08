<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\TollFee;
use App\Models\Vehicle;
use App\Models\VehicleRegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index_oficial(){

        $recidentes = Vehicle::select('vehicles.id as id','vr.vehicle_registration_type','vehicles.vehicle_type_id','vehicles.vehicle_license_plates','vehicles.vehicle_registration_type_id')->where('vehicles.vehicle_type_id',1)->join('vehicle_registration_types as vr','vehicles.vehicle_registration_type_id','vr.id')
        ->get() ;

        $tollfee=TollFee::where('id',1)->first();
        foreach ($recidentes as $recidente) {
            $time=Record::select(DB::raw("SUM(parking_time) as parking_time"))->where('vehicle_registration_type_id',$recidente->vehicle_registration_type_id )
            ->where('vehicle_license_plates',$recidente->vehicle_license_plates )
            ->first();
            $recidente->parking_time=$time->parking_time;
            $recidente->total=$time->parking_time*$tollfee->toll_fee;
        }
        return view('vehicle.indexoficial')->with('recidentes', $recidentes);
    }

    public function index_residente(){

        $recidentes = Vehicle::select('vehicles.id as id','vr.vehicle_registration_type','vehicles.vehicle_type_id','vehicles.vehicle_license_plates','vehicles.vehicle_registration_type_id')->where('vehicles.vehicle_type_id',2)->join('vehicle_registration_types as vr','vehicles.vehicle_registration_type_id','vr.id')
        ->get() ;

        $tollfee=TollFee::where('id',2)->first();
        foreach ($recidentes as $recidente) {
            $time=Record::select(DB::raw("SUM(parking_time) as parking_time"))->where('vehicle_registration_type_id',$recidente->vehicle_registration_type_id )
            ->where('vehicle_license_plates',$recidente->vehicle_license_plates )
            ->first();
            $recidente->parking_time=$time->parking_time;
            $recidente->total=$time->parking_time*$tollfee->toll_fee;
        }
        return view('vehicle.indexresidente')->with('recidentes', $recidentes);
    }

    public function show(Vehicle $id){
        $records=Record::select('records.id as id','records.parking_time as parking_time','ci.ckeck_in as ckeck_in','co.ckeck_out as ckeck_out')->where('vehicle_registration_type_id',$id->vehicle_registration_type_id )
        ->join('check_ins as ci','records.id','=','ci.record_id')
        ->join('check_outs as co','records.id','=','co.record_id')
        ->where('vehicle_license_plates',$id->vehicle_license_plates )
        ->get();
        return view('vehicle.show')->with(['records'=> $records,'id'=>$id ]);
    }
}
