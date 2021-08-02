<?php

namespace publicity;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Categories';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'shortDescription',
        'longDescription',
        'urlImage',
        'created_at',
        'updated_at'
    ];

    public function publications()
    {
    	return $this->hasMany(Publication::class, 'id_category');
    } 
    public function scopeGroup($query, $letraInicio, $letraFin)
    {
        return $query->where('shortDescription', 'REGEXP', "^[".$letraInicio."-".$letraFin."]")->orderBy('shortDescription', 'ASC')->get();
    }

    public static function getCategories($categoriesArr = array(''=>'Selecciona una categoría'))
    {
        $categories = self::all();

        foreach($categories as $category){
            $categoriesArr[$category->id] = $category->shortDescription;
        }

        return $categoriesArr;
    }
}
