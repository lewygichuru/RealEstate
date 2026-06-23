<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Tenant extends Model
{
    use HasUuids, LogsActivity;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'id_number',
        'date_of_birth',
        'occupation',
        'employer',
        'emergency_contact_name',
        'emergency_contact_phone',
        'documents',
        'notes',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'documents' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function leases()
    {
        return $this->hasMany(\App\Models\Lease::class);
    }
}
