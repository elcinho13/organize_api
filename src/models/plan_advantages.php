<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class plan_advantages extends Eloquent {

    public $timestamps = true;
    protected $table = 'org_plan_advantages';

    public function plan() {
        return $this->belongsTo('plan', 'plan');
    }

}
