<?php

namespace App\Providers;

use App\User;
use App\Product;
use GuzzleHttp\retry;
use App\Mail\UserCreated;
use App\Mail\UserMailChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        User::created(function($user){
            retry(5, function() use($user){
                Mail::to($user)->send(new UserCreated($user));
            },100);
        });

        User::updated(function($user){
            if($user->isDirty('email')){
                retry(5, function() use($user){
                    Mail::to($user)->send(new UserMailChanged($user));
                },100);
            }
        });

        Product::updated(function($producto){
            if($producto->quantity==0 && $producto->estaDiponible()){
                $producto->status= Product::PRODUCTO_NO_DISPONIBLE;

                $producto->save();
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
