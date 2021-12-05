<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model{
    
    protected $table = 'forms';

    protected $guarded = ['id'];

    protected $fillable = [];

    public function formElements() {
    	return $this->hasMany('App\FormElement', 'form_id');
    }
}