<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonVideo extends Model
{
    protected $table = 'common_videos';

    protected $guarded = ['id'];

    protected $fillable = [];
}