<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model{
    
    protected $table = 'blog_categories';

    protected $guarded = ['id'];

    protected $fillable = [
        'parent_id',
        'name',
        'type',
        'slug',
        'sort_order',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'created_at',
        'updated_at'
    ];

    //public $timestamps = false;

    public function Blogs() {
        return $this->hasMany('App\Blog','category_id', 'id');
    }

    /**
     * Sub-Categories of this Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(){
        return $this->hasMany('App\BlogCategory', 'parent_id');
    }

    /**
     * Parent Category of this Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(){
        return $this->belongsTo('App\BlogCategory', 'parent_id');
    }
}