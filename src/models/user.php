<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user';

    public function user_type() {
        return $this->belongsTo('user_type', 'user_type');
    }

    public function term() {
        return $this->belongsTo('term', 'term');
    }
    
    public function plan() {
        return $this->belongsTo('plan', 'plan');
    }

}
