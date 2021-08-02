<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = "Devices";

    protected $fillable = ['mac', 'status'];

    // protected $appends = ['coupons'];

    public function messages(){
    	return $this->belongsToMany(Message::class, 'MessagesDevices', 'id_device', 'id_message');
    }

    // public function getCouponsAttribute(){

    	

    // }
}
