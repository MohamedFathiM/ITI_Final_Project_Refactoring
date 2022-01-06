<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable =[
        'image','name','price','user_id' ,'product_id', 'qauntity'  
    ];

    public function Checkout(){
        return $this -> belingsTo(Checkout::class);
    }

}
