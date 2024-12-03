<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
	protected $fillable = 
	[
        'name', 'slogan', 'logo','address', 'contact', 'email', 'website', 'description', 'invoice_prefix' , 'patient_prefix', 'tax_type', 'tax_percent', 'invoice_message', 'pan_no', 'registration_no'
    ];
    //
}
