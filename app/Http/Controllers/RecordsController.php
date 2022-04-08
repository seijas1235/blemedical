<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\Record;
use App\Models\TollFee;
use App\Models\Vehicle;
use App\Models\VehicleRegistrationType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class RecordsController extends Controller
{
    //guarda vehiculos recidentes
    public function store_check_in(Request $request){
        $data=$request->all();
        $record=Record::create($data);

        $checkin=new CheckIn();
        $checkin->record_id=$record->id;
        $checkin->ckeck_in=Carbon::now();
        $checkin->save();

        return Response::json(['success' => 'Éxito']);
    }

        //guarda vehiculos recidentes
        public function store_check_out(Request $request){
            $record=Record::where('vehicle_registration_type_id',$request->vehicle_registration_type_id)->where('vehicle_license_plates',$request->vehicle_license_plates)->latest()->first();
            if ($record) {

                $checkin=CheckIn::where('record_id',$record->id)->first();
                $timeout=Carbon::now();

                $checkout=new CheckOut();
                $checkout->record_id=$record->id;
                $checkout->ckeck_out=$timeout;
                $checkout->save();

                $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $checkin->ckeck_in);
                $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $timeout);
                $diff_in_minutes = $to->diffInMinutes($from);

                $record->parking_time=$diff_in_minutes;
                $record->save();

                $vehicle=Vehicle::where('vehicle_registration_type_id',$request->vehicle_registration_type_id)->where('vehicle_license_plates',$request->vehicle_license_plates)->first();
                if ($vehicle) {

                return Response::json(['success' => 'Buen Viaje']);
                } else {
                    $toll_fees= TollFee::where('id',3)->first();
                    $total=$diff_in_minutes*$toll_fees->toll_fee;

                    return Response::json(['success' => 'El total a cobrar es: $. '.number_format($total, 2, '.', ',')]);
                }


            } else {

                return Response::json(["error"=>"No hay registro de entrada de este vehiculo"]);
            }

        }


}
