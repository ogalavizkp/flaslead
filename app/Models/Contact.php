<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'phone2',
        'area',
        'company_id',
        'account_id',
        'notes',
    ];

    /**
     * Relación con la empresa (Company)
     * Un contacto pertenece a una empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
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
