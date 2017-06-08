<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class shift extends Eloquent {

	public $timestamp = true;
	protected $table = 'org_shift';
}