<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
	public function immunization()
	{
		return $this->hasMany('App\Immunization','vaccine_id');
	}

	public function users()
	{
		return $this->belongsToMany('App\Post', 'immunizations', 'vaccine_id', 'p_id');
	}

}
