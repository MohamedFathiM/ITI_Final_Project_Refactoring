<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Product extends Model
{
    use Rateable;

    protected $fillable =[
        'name','description','image1','image2','image3','price','color','user_id','category_id','cart_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }


    public function cart(){
        return $this->belongsTo(cart::class);
    }
    public function Comment(){
        return $this->hasMany(Comment::class);
    }
}
