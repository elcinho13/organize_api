<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user extends Eloquent{
    public $timestamps = true;
    protected $table = 'org_user';
    
    public function term(){
        return $this->belongsTo('term','term');
    }
}

