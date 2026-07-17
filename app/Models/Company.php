<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = [];
    
    public function users(){
        return $this->belongsTo(User::class);
    }

    public function contacts(){
        return $this->hasMany(Contact::class);
    }
}
