<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{
    Auth, Hash, DB, Mail, Validator, Response
};

use App\Models\Enquiry;

class EnquiryController extends Controller
{
    

    public function submitEnquiry(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ], [
            'name.required' => 'Name is required.',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['website_url'] = $request->website_url ?? '';
        $data['service_intrested'] = $request->service_intrested ?? '';
        $data['monthly_budget'] = $request->monthly_budget ?? '';
        $data['designation'] = $request->designation ?? '';
        $data['about'] = $request->about ?? '';
        $data['created_at'] = date('Y-m-d H:i:s');

        $eid = Enquiry::insertGetId($data);

        if($eid){
            return $this->sendResponse("Enquiry submitted successfully!");
        }

        return $this->sendError("Something went wrong! Please try again.");
    }
}
