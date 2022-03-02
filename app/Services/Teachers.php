<?php

namespace App\Services;

use App\Teacher;

class Teachers
{
    public function get()
    {
        $teachers = Teacher::where('is_blocked',false)->orderByRaw('lastname ASC','name ASC')->get();
        $array = array();
        foreach ($teachers as $teacher) {
            $array[$teacher->id] = $teacher->lastname.', '.$teacher->name.' ('.$teacher->code.')';
        }
        return $array;
    }

    public function all()
    {
        $teachers = Teacher::orderByRaw('lastname ASC','name ASC')->get();
        $array = array();
        foreach ($teachers as $teacher) {
            $array[$teacher->id] = $teacher->lastname.', '.$teacher->name.' ('.$teacher->code.')';
        }
        return $array;
    }
}