<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class academic_class extends Eloquent {

    public $timestamp = true;
    protected $table = 'org_academic_class';

    public function institution_course() {
        return $this->belongsTo('institution_course', 'institution_course');
    }

    public function shift() {
        return $this->belongsTo('shift', 'shift');
    }

}
