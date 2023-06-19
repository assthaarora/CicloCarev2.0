<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;

class PatientPrescription extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pId,$cId)
    {
        // dd($pId,$cId,Auth::user());
        $medicineDetails = DB::table('users AS u')
            ->join('patient_case AS pc', 'pc.userId', '=', 'u.id')
            ->join('genral_admin_medicinedetails AS gam', 'gam.userId', '=', 'u.customer_of')
            ->where('u.id',Auth::user()->id)
            ->orderBy('pc.created_at', 'desc')
            ->select('med_name','med_Desc','price','case_id')
            ->limit(1)
            ->first();
        $prescriptionDetails=DB::table('patient_prescription_details')
        ->where('case_id',$medicineDetails->case_id)
        ->orderBy('created_at', 'desc')
        ->first();
        return view('home.patient_prescription',compact('medicineDetails','prescriptionDetails'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
