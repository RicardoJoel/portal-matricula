<?php

namespace App\Services;

use App\Course;

class Courses
{
    public function get()
    {
        $courses = Course::where('is_blocked',false)->orderBy('name','ASC')->get();
        $array = array();
        foreach ($courses as $course) {
            $array[$course->id] = $course->name.' ('.$course->code.')';
        }
        return $array;
    }

    public function all()
    {
        $courses = Course::orderBy('name','ASC')->get();
        $array = array();
        foreach ($courses as $course) {
            $array[$course->id] = $course->name.' ('.$course->code.')';
        }
        return $array;
    }
}