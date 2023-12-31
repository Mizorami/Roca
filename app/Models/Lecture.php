<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Lecture extends Pivot
{
    use HasFactory;
    public $timestamps = false;

    protected $casts = [
        'sequence' => 'array'
    ];

    public function histoire()
    {
        return $this->belongsTo(Histoire::class);
    }
}
