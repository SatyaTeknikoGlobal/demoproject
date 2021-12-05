<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model{

    protected $table = 'blogs';

    protected $guarded = ['id'];

    protected $fillable = [
        'category_id',
        'title',
        'type',
        'subtitle',
        'slug',
        'content',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',
        'featured',
        'blog_date',
        'status',
        'created_at',
        'updated_at',
    ];

    //public $timestamps = false;

    public function Images() {
        return $this->hasMany('App\BlogImage', 'blog_id');
    }

    function Category(){
        return $this->belongsTo('App\BlogCategory', 'category_id');
    }
}