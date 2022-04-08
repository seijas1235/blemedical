<?php

namespace App\Http\Controllers;

use App\Models\ClosingRecord;
use App\Models\Record;
use App\Models\TollFee;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use PDF;

class ReportController extends Controller
{
    public function index(){

        $recidentes = Vehicle::select('vr.vehicle_registration_type','vehicles.vehicle_type_id','vehicles.vehicle_license_plates','vehicles.vehicle_registration_type_id')->where('vehicles.vehicle_type_id',2)->join('vehicle_registration_types as vr','vehicles.vehicle_registration_type_id','vr.id')
        ->get() ;
        $clos=ClosingRecord::orderBy('closing_records','DESC')->first();
        $tollfee=TollFee::where('id',2)->first();
        foreach ($recidentes as $recidente) {
            $time=Record::select(DB::raw("SUM(parking_time) as parking_time"))->where('vehicle_registration_type_id',$recidente->vehicle_registration_type_id )
            ->where('vehicle_license_plates',$recidente->vehicle_license_plates )
            ->where('created_at','>=',$clos->closing_records)
            ->first();
            $recidente->parking_time=$time->parking_time;
            $recidente->total=$time->parking_time*$tollfee->toll_fee;
        }
        return view('reports.index')->with('recidentes', $recidentes);
    }
    public function report_pay_pdf(Request $request){
        $recidentes = Vehicle::select('vr.vehicle_registration_type','vehicles.vehicle_type_id','vehicles.vehicle_license_plates','vehicles.vehicle_registration_type_id')->where('vehicles.vehicle_type_id',2)->join('vehicle_registration_types as vr','vehicles.vehicle_registration_type_id','vr.id')
        ->get() ;
        $clos=ClosingRecord::orderBy('closing_records','DESC')->first();
        $tollfee=TollFee::where('id',2)->first();
        foreach ($recidentes as $recidente) {
            $time=Record::select(DB::raw("SUM(parking_time) as parking_time"))->where('vehicle_registration_type_id',$recidente->vehicle_registration_type_id )
            ->where('vehicle_license_plates',$recidente->vehicle_license_plates )
            ->where('created_at','>=',$clos->closing_records)
            ->first();
            $recidente->parking_time=$time->parking_time;
            $recidente->total=$time->parking_time*$tollfee->toll_fee;
        }
        $pdf = PDf::loadView('reports.report', compact('recidentes'));
        return $pdf->stream($request->name.'.pdf');
    }

    public function close_report(){
        $Close=ClosingRecord::create(['closing_records'=>Carbon::now()]);
        return Response::json(['success' => 'Éxito']);
    }
}
