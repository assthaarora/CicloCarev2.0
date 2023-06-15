<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\OrderDetail;

class DashboradController extends Controller
{
    public function index()
    {
        //############################################### Get Patient Cases Details Ends ###############################################
    //    dd(Auth::user()->id);
        $recentOrderCreatedAt=DB::table('patient_case')
       ->select( 'created_at' )
       ->where('userId',Auth::user()->id)->orderBy('created_at','desc')
       ->first();
       $userId=Auth::user()->id;
       if ($recentOrderCreatedAt) 
        $recentOrderCreatedAt=date("F j, Y", strtotime($recentOrderCreatedAt->created_at));

       $patientCases = DB::table('users AS u')
       ->join('patient_case AS pc', 'pc.userId', '=', 'u.id')
       ->join('patient_case_status AS pcs', 'pcs.id', '=', 'pc.case_status_id')
       ->join('genral_admin_medicinedetails AS gam', 'gam.userId', '=', 'u.customer_of')
       ->join('patient_subscription AS ps', function ($join) {
           $join->on('ps.userId', '=', 'u.id')
                ->on('ps.caseId', '=', 'pc.id');
       })
       ->select('u.id as userId','pc.case_id','pc.id as dbcaseId','med_name', 'ps.subscription', 'price', 'pcs.name')
       ->where('u.id', $userId)
       ->get();
       

        $medicineName = DB::table('users AS u')
            ->join('patient_case AS pc', 'pc.userId', '=', 'u.id')
            ->join('genral_admin_medicinedetails AS gam', 'gam.userId', '=', 'u.customer_of')
            ->where('u.id', $userId)
            ->orderBy('pc.created_at', 'desc')
            ->limit(1)
            ->pluck('med_name')
            ->first();
       
        $caseStatus = DB::table('users')
            ->join('patient_case AS pc', 'pc.userId', '=', 'users.id')
            ->join('patient_case_status AS pcs', 'pcs.caseId', '=', 'pc.case_id')
            ->where('users.id', $userId)
            ->orderBy('pcs.updated_at', 'desc')
            ->limit(1)
            ->pluck('pcs.updated_at')
            ->first();
        $caseStatus=date("F j, Y", strtotime($caseStatus));
        
        $prescriptionStatus =DB::table('users')
        ->join('patient_case AS pc', 'pc.userId', '=', 'users.id')
            ->join('patient_prescription_details AS ppd', 'ppd.case_id', '=', 'pc.case_id')
            ->where('users.id', $userId)
            ->pluck('ppd.updated_at')
            ->first();
        if($prescriptionStatus)
            $prescriptionStatus=date("F j, Y", strtotime($prescriptionStatus));
        
        $orderStatus = DB::table('users')
        ->join('patient_case AS pc', 'pc.userId', '=', 'users.id')
            ->join('patient_order_details AS pod', 'pod.caseId', '=', 'pc.case_id')
            ->where('users.id', $userId)
            ->pluck('pod.updated_at')
            ->first();
        if($orderStatus)
            $orderStatus=date("F j, Y", strtotime($orderStatus));
        
       

    //    dd($userId,$recentOrderCreatedAt,$patientCases,$medicineName,$caseStatus,$prescriptionStatus,$orderStatus);
       
        return view('home.index',compact('patientCases','recentOrderCreatedAt','medicineName','caseStatus','prescriptionStatus','orderStatus'));

    }

    public function create(){}

    public function store(Request $request){}

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}
}
