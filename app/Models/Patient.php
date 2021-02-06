<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['dob'];

    protected $casts = [
        'dob' => 'date'
    ];

    /**
     * Extending the User Entity
     */
    public function user()
    {
        return $this->morphOne(User::class, 'authenticable');
    }
}
