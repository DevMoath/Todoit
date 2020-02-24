<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lists extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'color'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id');
    }
}
