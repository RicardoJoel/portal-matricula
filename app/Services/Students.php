<?php

namespace App\Services;

use App\Student;

class Students
{
    public function get()
    {
        $students = Student::where('is_blocked',false)->orderByRaw('lastname ASC','name ASC')->get();
        $array = array();
        foreach ($students as $student) {
            $array[$student->id] = $student->lastname.', '.$student->name.' ('.$student->code.')';
        }
        return $array;
    }

    public function all()
    {
        $students = Student::orderByRaw('lastname ASC','name ASC')->get();
        $array = array();
        foreach ($students as $student) {
            $array[$student->id] = $student->lastname.', '.$student->name.' ('.$student->code.')';
        }
        return $array;
    }
}