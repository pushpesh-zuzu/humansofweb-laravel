<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{
    Auth, Hash, DB, Mail, Validator, Response
};

use App\Models\Enquiry;

class DashboardController extends Controller
{
    

    public function dashboard(Request $request){
        return view('admin.dashboard.dashboard');
    }
}
