<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    
    protected $table = 'school';
    public $timestamps = false;
    protected $fillable = ['name', 'city', 'address', 'phone'];
    
    
    
    public function teachers(){
        return $this->hasMany('App\Models\Teacher', 'school_id');
    }
}
