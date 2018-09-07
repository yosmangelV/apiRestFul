<?php

namespace App;

use App\Seller;
use App\Category;
use App\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    
	const PRODUCTO_DISPONIBLE='disponible';
	const PRODUCTO_NO_DISPONIBLE='no disponible';

    protected $fillable=['name', 'description', 'quatity', 'status', 'image', 'sellerd_id'];
    protected $dates=['deleted_at'];

    public function estaDisponible(){
    	return $this->status == Product::PRODUCTO_DISPONIBLE;
    }

    public function categories(){
    	return $this->belongsToMany(Category::class);
    }

    public function seller(){
    	$this->belongsTo(Seller::class);
    }

    public function transaction(){
    	return $this->hasMany(Transaction::class);
    }
}
