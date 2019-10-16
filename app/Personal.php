<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;

    public $timestamps = false;

    protected $guarded = [];

    protected $hidden = ['user_id'];

}
