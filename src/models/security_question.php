<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class security_question extends Eloquent{
    public $timestamps = true;
    protected $table = 'org_security_question';
    
    public function user(){
        return $this->belongsTo('user','user');
    }
}