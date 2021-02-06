<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory; 

    protected $fillable = ['availability', 'education', 'experience', 'speciality'];

    /**
     * Doctor speciality options
     * 
     * @return array of doctor specialilities
     */
    public static function specialityOptions() : array
    {
        return [
            'Oncologist',
            'Paedetrician',
            'Pyschiatrist',
            'Dentist',
            'Surgeon',
            'Optician',
        ];
    }

    /**
     * Extending the User Entity
     */
    public function user()
    {
        return $this->morphOne(User::class, 'authenticable');
    }
}
