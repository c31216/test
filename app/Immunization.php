<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Immunization extends Model
{
   public function vaccines()
  {
    return $this->belongsTo('App\Vaccine','id');
  }
}
