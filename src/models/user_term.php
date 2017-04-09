<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class user_term extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_user_term';

    public function user() {
        return $this->belongsTo('user', 'user');
    }

    public function term() {
        return $this->belongsTo('term', 'term');
    }
}
