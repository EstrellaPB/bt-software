<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $table = "Messages";

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_category',
        'id_company',
        'description',
        'urlImage',
        'is_coupon',
        'clicked',
        'created_at',
        'updated_at'
    ];

    protected $guarded  = [
    ];

    protected $cast = [
        "is_coupon" => "boolean"
    ];

    public function devices(){
        return $this->belongsToMany(Device::class, 'MessagesDevices', 'id_message', 'id_device');
    }

    public function coupons()
    {
    	return $this->hasMany(Coupon::class, 'id_message');
    }

    public function publication()
    {
        return $this->belongsTo(Publication::class, 'id_publication');
    }

    public function company()
    {
    	return $this->belongsTo(Company::class, 'id_company');
    }

    public function category()
    {
    	return $this->belongsTo(Category::class, 'id_category');
    }
}
