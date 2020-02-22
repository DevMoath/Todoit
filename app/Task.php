<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'list_id',
        'name',
        'completed'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
      'completed' => 'boolean'
    ];
}
