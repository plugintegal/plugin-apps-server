<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryEvent extends Model
{
  protected $guarded = [];
  public $timestamps = false;

  protected $hidden = ['category_event_id'];
}
