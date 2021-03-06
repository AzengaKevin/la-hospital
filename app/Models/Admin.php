<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = ['role'];

    /**
     * Creates array of the admin roles
     * 
     * @return array of the roles
     */
    public static function roles()
    {
        return ['Default', 'Editor'];
    }

    /**
     * Extending the Admin Model to the User Model
     */
    public function user()
    {
        return $this->morphOne(User::class, 'authenticable');
    }
}
