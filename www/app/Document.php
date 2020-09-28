<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function suit_case()
    {
        return $this->belongsTo(SuitCase::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}

