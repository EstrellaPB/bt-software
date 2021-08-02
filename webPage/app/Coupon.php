<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
   protected $table = "CouponBooks";

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'id_customer',
        'id_publication',
        'used'
    ];

    protected $guarded  = [
    ];

    protected $cast = [
        "used" => "boolean"
    ];

   public function publication()
   {
   	 return $this->belongsTo(Publication::class, 'id_publication');
   }
}
