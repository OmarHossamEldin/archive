<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $guarded = [];
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function parent()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function children(){
        return $this->hasMany(Organization::class, 'organization_id', 'id');
    }
    public function root(){
        return $this->belongsTo(Organization::class, 'root_organization_id', 'id');
    }
}
