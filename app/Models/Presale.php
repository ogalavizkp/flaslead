<?php

namespace App\Models; // 👈 Agrega esta línea

use Illuminate\Database\Eloquent\Model;

class Presale extends Model
{
    protected $fillable = [
        'company_id',
        'meeting_subject',
        'portfolio',
        'start_date',
        'end_date',
        'task_type',
        'commercial_id',
        'assigned_to',
        'created_by',
        'updated_by',
        'description',
        'history',
        'priority',
        'notification_emails',
        'status',
        'sla',
        'expired_time'
    ];


    

    public function commercial()
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
