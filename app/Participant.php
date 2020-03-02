<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $guarded = [];

    public $timestamps = false;

    public function event(){
      return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function subCategory(){
      return $this->belongsTo(SubCategoryEvent::class, 'sub_category_event_id', 'id');
    }
}
