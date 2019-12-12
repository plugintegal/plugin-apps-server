<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function categories(){
      return $this->hasMany(CategoryEvent::class, 'event_id', 'id');
    }
}
