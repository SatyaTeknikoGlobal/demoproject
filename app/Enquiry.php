<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model{
    
    protected $table = 'enquiries';

    protected $guarded = ['id'];
    

    protected $fillable = [];

     public function form() {
    	return $this->belongsTo('App\Form', 'form_id');
    }

}