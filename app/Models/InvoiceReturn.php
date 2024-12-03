<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceReturn extends Model
{
	protected $fillable = ['invoice_id', 'return_amount', 'user_id', 'status', 'return_reason'];
    //

    public function invoice()
    { 
    	return $this->belongsTo('App\Models\Invoice');

    }

     public function user()
    { 
    	return $this->belongsTo('App\Models\User');

    }
}
