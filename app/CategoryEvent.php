<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryEvent extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    protected $hidden = ['event_id','category_id'];

    public function category(){
      return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategories(){
      return $this->hasMany(SubCategoryEvent::class, 'category_event_id', 'id');
    }
}
