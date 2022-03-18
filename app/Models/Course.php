<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Course extends Model
{
    use HasFactory;
    protected $fillable = ['course_name','mark'];

    public function student(){

        return $this->belongsTo(Student::class, 'id', 'student_id');
    }



}
