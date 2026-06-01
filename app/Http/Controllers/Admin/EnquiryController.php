<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{
    Auth, Hash, DB, Mail, Validator, Response
};
use Yajra\DataTables\DataTables;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    

    public function index(Request $request){

        $data['title'] = 'Enquiries List';

        $enquiries = Enquiry::whereNull('deleted_at');

        if ($request->ajax()) {
            return DataTables::of($enquiries)
                ->addIndexColumn()
                ->editColumn('created_at', function ($enquiry) {
                    $date = $enquiry->created_at->format('d/m/Y h:i A');
                    return $date;
                })
                ->rawColumns(['created_at'])
                ->make(true);
        }

        return view ('admin.enquiries.list', $data);
    }
}
