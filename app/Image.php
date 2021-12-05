<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'common_images';

    protected $guarded = ['id'];

    protected $fillable = [
        'tbl_id',
        'tbl_name',
        'heading',
        'content',
        'old_content',
        'default_content',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
    ];
}