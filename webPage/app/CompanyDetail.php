<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    protected $table = "CompanyDetails";

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'id_company',
        'latitude',
        'longitude',
        'is_premium',
        'is_active',
        'urlImage',
        'created_at',
        'updated_at'
    ];

    protected $guarded  = [
    ];

    protected $cast = [
        "is_premium" => "boolean",
        "is_active" => "boolean"
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}
