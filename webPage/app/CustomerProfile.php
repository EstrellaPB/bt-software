<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
	protected $table = 'CustomersProfiles';

	protected $fillable = ['first_name', 'last_name', 'address', 'tel', 'city', 'state'];

    public function customer()
    {
    	return $this->belongsTo(Customer::class, 'id_customer');
    }
}
