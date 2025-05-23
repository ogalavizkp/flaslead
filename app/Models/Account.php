<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nit',
        'description',
    ];

    /**
     * Relación: Una cuenta tiene múltiples contactos.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_at');
    }
}
