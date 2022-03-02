<?php

namespace App\Services;

use App\Section;

class Sections
{
    public function get()
    {
        $sections = Section::where('is_closed',false)->orderBy('code', 'ASC')->get();
        $array = array();
        foreach ($sections as $section) {
            $array[$section->id] = $section;
        }
        return $array;
    }

    public function all()
    {
        $sections = Section::orderBy('code', 'ASC')->get();
        $array = array();
        foreach ($sections as $section) {
            $array[$section->id] = $section->code;
        }
        return $array;
    }
}