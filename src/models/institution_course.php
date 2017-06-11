<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class institution_course extends Eloquent {

    public $timestamp = true;
    protected $table = 'org_institution_course';

    public function institution() {
        return $this->belongsTo('institution', 'institution');
    }

    public function course() {
        return $this->belongsTo('course', 'course');
    }
}
