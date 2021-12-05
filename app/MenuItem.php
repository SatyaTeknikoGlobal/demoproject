<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model{
    
    protected $table = 'menu_items';

    protected $guarded = ['id'];

    protected $fillable = [];

    public function children(){
    	return $this->hasMany('App\MenuItem', 'parent_id');
    }

}