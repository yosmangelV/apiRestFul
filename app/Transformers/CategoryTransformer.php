<?php

namespace App\Transformers;

use App\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'identificador'=>(int)$category->id,
            'titulo'=>(string)$category->name,
            'detalles'=>(string)$category->description,
            'fechaCreacion'=>(string)$category->created_at,
            'fechaActualizacion'=>(string)$category->updated_at,
            'FechaEliminacion'=>isset($category->deleted_at) ? (string) $category->deleted_at : null,
        ];
    }

    public static function originalAttribute($index){
        
        $attributes=[
            'identificador'=>'id',
            'titulo'=>'name',
            'detalles'=>'description',
            'fechaCreacion'=>'created_at',
            'fechaActualizacion'=>'updated_at',
            'FechaEliminacion'=>'deleted_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    } 

    public static function transformAttribute($index){
        
        $attributes=[
            'id'=>'identificador',
            'name'=>'titulo',
            'description'=>'detalles',
            'created_at'=>'fechaCreacion',
            'updated_at'=>'fechaActualizacion',
            'deleted_at'=>'FechaEliminacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
