<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $table = 'courses';
    
    protected $fillable = [
        'name', 'hours', 'code', 'is_blocked'
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
}