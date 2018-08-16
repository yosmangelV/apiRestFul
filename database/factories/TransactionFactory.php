<?php

use App\Seller;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
	$vendedores=Seller::has('products')->get()->random();
	$comprador=Seller::all()->except($vendedores->id)->random();
    return [
        'quantity'=>$faker->numberBetween(1,3),
        'buyer_id'=>$comprador->id,
        'product_id'=>$vendedores->products->random()->id,
    ];
});
