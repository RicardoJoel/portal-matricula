<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use SoftDeletes;

    protected $table = 'sections';
    
    protected $fillable = [
        'course_id', 'teacher_id', 'process_id', 'code', 'is_closed', 'quantity'
    ];
    
    protected $attributes = [
        'is_closed' => false, 'quantity' => 0
    ];

    protected $guarded = [
        'id',
    ];
    
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }

    public function process()
    {
    	return $this->belongsTo(Process::class);
    }

    public function enrollments()
    {
    	return $this->hasMany(Enrollment::class);
    }
        
    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Section $section) {
            $ini = substr($section->course->code,0,3);
            $maxcode = Section::where('code','LIKE',$ini.'%')->where('process_id',$section->process->id)->max(\DB::raw('substr(code,4,3)'));
            $section->code = $ini.str_pad(++$maxcode,3,'0',STR_PAD_LEFT);
            return true;
        });
    }
}
