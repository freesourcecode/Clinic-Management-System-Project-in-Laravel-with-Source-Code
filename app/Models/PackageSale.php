<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageSale extends Model
{
	protected $fillable = ['package_id', 'invoice_id', 'package_price', 'patient_id'];

	public function package()
	{
		return $this->belongsTo('App\Models\Package');
	}
    //
    public function invoice()
	{
		return $this->belongsTo('App\Models\Invoice');
	}
	public function patient()
	{
		return $this->belongsTo('App\Models\Patient');
	}
    //
}
