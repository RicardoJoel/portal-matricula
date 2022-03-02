<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $table = 'teachers';
    
    protected $fillable = [
        'name', 'lastname', 'document', 'code', 'is_blocked'
    ];

    protected $attributes = [
        'is_blocked' => false,
    ];

    protected $guarded = [
        'id',
    ];

    public function sections()
    {
    	return $this->hasMany(Section::class);
    }
        
    /**
     * Boot function for using with User Events
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        
        self::creating(function(Teacher $teacher) {
            $maxcode = Teacher::where('code', 'LIKE', 'D'.date('Y').'%')->max(\DB::raw('substr(code, 6, 4)'));
            $teacher->code = 'D'.date('Y').str_pad(++$maxcode, 4, '0', STR_PAD_LEFT);
            return true;
        });
    }
}
