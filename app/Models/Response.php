<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = ['request_id', 'type' ,'description', 'appointment', 'prescription'];

    protected $casts = [
        'appointment' => 'array', 
        'prescription' => 'array'
    ];

    /**
     * The possible response types for a patient request
     * 
     * @return array of the types
     */
    public static function types() : array
    {
        return ['Prescription', 'Appointment'];
    }

    /**
     * A response belongs to a request
     * 
     * M : 1
     */
    public function response()
    {
        return $this->hasMany(Request::class);
    }
}
