<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function pincode($pincode)
    {
        // dd($pincode,pincode($pincode));
        return pincode($pincode);
    }
}
