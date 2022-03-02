<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use SoftDeletes;

    protected $table = 'processes';
    
    protected $fillable = [
        'start_at', 'end_at', 'code', 'is_closed',
    ];

    protected $attributes = [
        'is_closed' => false,
    ];

    protected $guarded = [
        'id',
    ];
    
    public function sections()
    {
    	return $this->hasMany(Section::class);
    }
}
