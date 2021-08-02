<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = "Publications";

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_category',
        'id_company',
        'title',
        'description',
        'urlImage',
        'is_coupon',
        'clicked',
        'expiration_date',
        'created_at',
        'updated_at'
    ];

    protected $guarded  = [
    ];

    protected $cast = [
        "is_coupon" => "boolean"
    ];

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'id_publication');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        /*static::delete(function ($publication){
            $publication->coupons->delete();
        });*/
    }
}
