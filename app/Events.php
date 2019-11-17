<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'event_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    public $timestamps = false;

}
