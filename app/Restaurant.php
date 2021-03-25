<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function dishes(){
        return $this->hasMany('App\Dish');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }
    protected $fillable = ['name', 'slug', 'city', 'address', 'cover','description'];
}
