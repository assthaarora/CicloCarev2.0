<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\EmailStoreRequest;


class EmailIntakeController extends Controller
{
    public function index(){}

    public function create($mId,$bId,$qId)
    {
        $mId=decrypt($mId);
        $bId= decrypt($bId);
        return view('patient/email',compact('mId','bId','qId'));
    }

    public function store(EmailStoreRequest $request)
    {
        $email=$request->email;
        $mId=$request->mId;
        $bId = $request->bId;
        $qId = $request->qId;
        return redirect()->route('personalInfo',['email' =>encrypt($email),'mId' => encrypt($mId),'bId' => encrypt($bId),'qId' => $qId]);
    }

    public function show($id){}

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){ }
}
