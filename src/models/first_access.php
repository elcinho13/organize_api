<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class firstAccess extends Eloquent{
    public $timestamps = true;
    protected $table = 'org_first_access';
}

