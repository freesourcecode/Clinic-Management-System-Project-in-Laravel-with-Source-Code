<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSale extends Model
{
	protected $fillable = ['service_id', 'service_name','amount', 'invoice_id' ];
    //


public function invoice()
{
    return $this->belongsTo('App\Models\Invoice');
}

public function service()
{
	return $this->belongsTo('App\Models\Service');
}

}