<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class institution extends Eloquent {

    public $timestamp = true;
    protected $table = 'org_institution';

    public function institution_type() {
        return $this->belongsTo('institution_type', 'institution_type');
    }

    public function place() {
        return $this->belongsTo('place', 'place');
    }

    public function courses() {
        return $this->hasMany('institution_course', 'institution');
    }

}
