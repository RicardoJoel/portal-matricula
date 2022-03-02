<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $table = 'students';
    
    protected $fillable = [
        'name', 'lastname', 'document', 'code', 'is_blocked'
    ];

    protected $attributes = [
        'is_blocked' => false,
    ];

    protected $guarded = [
        'id',
    ];

    public function enrollments()
    {
    	return $this->hasMany(Enrollment::class);
    }
    
    public function cantEnrollments($process_id)
    {
        $enrolls = Enrollment::leftJoin('sections','sections.id','enrollments.section_id')
            ->leftJoin('processes','processes.id','sections.process_id')
            ->where('student_id',$this->id)
            ->where('process_id',$process_id)
            ->get();
        return count($enrolls);
    }

    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Student $student) {
            $maxcode = Student::where('code', 'LIKE', 'A'.date('Y').'%')->max(\DB::raw('substr(code, 6, 4)'));
            $student->code = 'A'.date('Y').str_pad(++$maxcode, 4, '0', STR_PAD_LEFT);
            return true;
        });
    }
}
