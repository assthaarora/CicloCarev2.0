<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

<<<<<<< HEAD
=======
use Auth;
use DB;

use App\Models\OrderDetail;

>>>>>>> master
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

<<<<<<< HEAD
    
    public function index()
    {
        return view('home.index');
=======

    public function index(){
        $patient = DB::table('patient_case')->where('userId', Auth::user()->id)->first();
        $orders = OrderDetail::where('patient_id', $patient->id)->orderBy('created_at', 'DESC')->get();
        dd($patient,$orders);
        return view('home.index', compact('patient', 'orders'));
>>>>>>> master
    }
    public function patient_dashboard(){
        return view('home.index');
    }
<<<<<<< HEAD
    
    public function order_management(){
        return view('home.order_management');
    }

    
=======

    public function order_management(){
        $patient = DB::table('patient_case')->where('userId', Auth::user()->id)->first();
        $orders = OrderDetail::where('patient_id', $patient->id)->get();
        return view('home.order_management', compact('patient', 'orders'));
    }


>>>>>>> master
}
