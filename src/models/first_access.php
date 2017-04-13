<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class first_access extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_first_access';
    
    public function user() {
        return $this->belongsTo('user', 'user');
    }
}
