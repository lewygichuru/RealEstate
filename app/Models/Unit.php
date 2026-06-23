<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Unit extends Model
{
    use HasUuids, LogsActivity;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'property_id',
        'unit_number',
        'floor',
        'bedrooms',
        'bathrooms',
        'size_sqft',
        'rent_amount',
        'deposit_amount',
        'status',
        'notes',
    ];

    protected $casts = [
        'size_sqft' => 'decimal:2',
        'rent_amount' => 'decimal:2',
        'deposit_amount' => 'decimal:2',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }

    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class);
    }

    public function leases()
    {
        return $this->hasMany(\App\Models\Lease::class);
    }

    public function maintenanceRequests()
    {
        return $this->hasMany(\App\Models\MaintenanceRequest::class);
    }

    public function inspections()
    {
        return $this->hasMany(\App\Models\Inspection::class);
    }
}
