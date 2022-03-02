<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $table = 'enrollments';
    
    protected $fillable = [
        'user_id', 'section_id', 'student_id', 
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function section()
    {
    	return $this->belongsTo(Section::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
