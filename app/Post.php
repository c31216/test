<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public function immunization()
	{
		return $this->hasMany('App\Immunization', 'vaccine_id');
	}

	public function immunizations()
	{
		return $this->hasMany('App\Immunization', 'p_id');
	}
  	
}
