<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'name',
        'trade_name',
        'identification_type',
        'identification',
        'email',
        'website',
        'address',
        'country',
        'city',
        'phone',
        'phone2',
        'phone3',
        'category',
        'status',
        'employees',
        'revenue_range',
        'notes',
        'account_id',
    ];

    /**
     * Relación: Una empresa pertenece a una cuenta.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * Relación: Una empresa tiene muchos contactos.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function actividades()
    {
        return $this->morphMany(Actividad::class, 'relacionable');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_at');
    }
}
