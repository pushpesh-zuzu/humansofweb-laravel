<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    protected $table = "enquiries";

    protected $fillable = ['name', 'email' , 'phone','website_url','service_intrested','monthly_budget','designation','about'];

}
