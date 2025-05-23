<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades'; // 💡 Indica el nombre correcto de la tabla

    protected $fillable = [
        'account_id',
        'titulo',
        'descripcion',
        'tipo',
        'prioridad',
        'estado',
        'recordatorio',
        'recordatorio_fecha',
        'relacionable_id',
        'relacionable_type'
    ];

    public function relacionable()
    {
        return $this->morphTo();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
