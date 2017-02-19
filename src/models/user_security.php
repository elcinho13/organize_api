<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_security extends Eloquent{
    public $timestamps = true;
    protected $table = 'org_user_security';
    
    public function user(){
        return $this->belongsTo('user','user');
    }
    
    public function security_question(){
        return $this->belongsTo('security_question','security_question');
    }
}