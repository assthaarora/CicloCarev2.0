<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmailIntakeController extends Controller
{
    public function index()
    {
        return view('patient/email');
    }

    public function create($mId)
    {
        $mId=decrypt($mId);
        return view('patient/email',compact('mId'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'email'=>'required|email'
        ]);
       $email=$request->email;
       $mId=$request->mId;
        return redirect()->route('form',['email' =>encrypt($email),'mId' => encrypt($mId)]);
    }

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){ }
}
