<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class token extends Eloquent{
    public $timestamps = true;
    protected $table = 'org_token';
    
    public function user(){
        return $this->belongsTo('user','user');
    }
    
    public function first_access(){
        return $this->belongsTo('first_access','first_access');
    }
}

