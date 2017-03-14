<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class settings extends Eloquent
{
    public $timestamps = true;
    protected $table = 'org_settings';

    public function user(){
        return $this->belongsTo('user','user');
    }

}