<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

use App\Models\OrderDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(){
        $patient = DB::table('patient_case')->where('userId', Auth::user()->id)->first();
        $orders = OrderDetail::where('patient_id', $patient->id)->orderBy('created_at', 'DESC')->get();
        dd($patient,$orders);
        return view('home.index', compact('patient', 'orders'));
    }
    public function patient_dashboard(){
        return view('home.index');
    }

    public function order_management(){
        $patient = DB::table('patient_case')->where('userId', Auth::user()->id)->first();
        $orders = OrderDetail::where('patient_id', $patient->id)->get();
        return view('home.order_management', compact('patient', 'orders'));
    }


}
