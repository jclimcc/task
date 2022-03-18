<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function my_course(){

        return $this->hasMany(Course::class, 'student_id','id');
    }

    public function particular_course($course){
        return $this->my_course()->find($course);
    }

    public static function boot() {
        parent::boot();
    
        static::deleting(function($student) {
            // here you could instantiate each related Comment
            // in this way the boot function in the Comment model will be called
            $student->my_course->each(function($course) {
                // and then the static::deleting method when you delete each one
                $course->delete();
            });
        });
    } 
}
