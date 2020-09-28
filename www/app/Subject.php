<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
   public function documents()
   {
       return $this->hasMany(Document::class);
   }
}
