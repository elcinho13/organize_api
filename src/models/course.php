<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class course extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_course';

    public function classes() {
        return $this->hasMany('classes', 'institution_course');
    }
}
