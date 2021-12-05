<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommonImage extends Model{
    
    protected $table = 'common_images';

    protected $guarded = ['id'];

    protected $fillable = [];
}