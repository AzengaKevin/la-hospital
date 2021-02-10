<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['request_id', 'doctor_id', 'description', 'read'];

    /**
     * Request Doctor Relationship  M : 1
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * Request User Relationship M : 1
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Request Response Relationship 1 : M
     */
    public function response()
    {
        return $this->hasMany(Response::class);
    }
}
