<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EnquiryController;


Route::get('api-test', function(){
    print_r("api is working");
});

Route::post('submit-enquiry',[EnquiryController::class,'submitEnquiry']);


Route::prefix('/')->group(function () {
    

    
    
});

Route::middleware('auth:sanctum', 'authMiddleware')->group(function () {

     Route::get('auth-api-test', function(){
        print_r("api is working");
    });

        
});
