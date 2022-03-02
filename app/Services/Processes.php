<?php

namespace App\Services;

use App\Process;

class Processes
{
    public function get()
    {
        $processes = Process::where('is_closed',false)->orderBy('code','ASC')->get();
        $array = array();
        foreach ($processes as $process) {
            $array[$process->id] = $process->code;
        }
        return $array;
    }

    public function all()
    {
        $processes = Process::orderBy('code','ASC')->get();
        $array = array();
        foreach ($processes as $process) {
            $array[$process->id] = $process->code;
        }
        return $array;
    }
}