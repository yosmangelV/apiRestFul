<?php

namespace App;

use App\Product;
use Illuminate\Database\Eloquent\Model;
use App\Transformers\CategoryTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{	
	use SoftDeletes;

	public $transformer= CategoryTransformer::class;

    protected $fillable=['name', 'description'];

    protected $dates=['deleted_at'];

    protected $hidden=['pivot'];

    public function products(){
    	return $this->belongsToMany(Product::class);
    }
}
