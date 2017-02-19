<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_security extends Eloquent{
    public $timestamps = true;
    protected $table = 'org_user_security';
    
    public function org_user_id(){
        return $this->belongsTo('user','org_user_id');
    }
    
    public function org_security_question_id(){
        return $this->belongsTo('security_question','org_security_question_id');
    }
}