<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function parent()
    {
        return $this->belongsTo(Organiztion::class);
    }
}
