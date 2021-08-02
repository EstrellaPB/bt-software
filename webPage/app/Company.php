<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "CompanyClients";

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'rfc',
        'city',
        'state',
        'created_at',
        'updated_at'
    ];

    public function messages()
    {
    	return $this->hasMany(Message::class, 'id_company');
    }

    public function companyDetail()
    {
    	return $this->hasOne(CompanyDetail::class, 'id_company');
    }
    public function publications()
    {
        return $this->hasMany(Publication::class, 'id_company');
    }

    public static function getCompanies($companiesArr = array(''=>'Selecciona una compañía'))
    {
        $companies = self::all();

        foreach($companies as $company){
            $companiesArr[$company->id] = $company->name;
        }

        return $companiesArr;
    }

}
