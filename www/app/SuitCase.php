<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SuitCase extends Model
{
 public function documents()
 {
     return $this->hasMany(Document::class);
 }
}
