<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    
    protected $table = 'teacher';
    public $timestamps = false;
    protected $fillable = ['school_id', 'DNI', 'name', 'surname', 'phone', 'wage', 'picture_url'];
    
    
    public function school(){
        return $this->belongsTo('App\Models\School', 'school_id');
    }
}
