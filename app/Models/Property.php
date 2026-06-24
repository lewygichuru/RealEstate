<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Property extends Model
{
    use HasUuids, LogsActivity;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'owner_id',
        'title',
        'slug',
        'address',
        'city',
        'state',
        'country',
        'latitude',
        'longitude',
        'type',
        'price',
        'description',
        'amenities',
        'status',
        'is_featured',
    ];

    protected $casts = [
        'amenities' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function user()
    {
        return $this->owner();
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function staff()
    {
        return $this->hasMany(PropertyStaff::class);
    }

    public function gallery()
    {
        return $this->morphMany(File::class, 'model');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'model');
    }

    public function rating()
    {
        return $this->ratings();
    }

    // Accessors for backward compatibility with older views
    public function getBedroomAttribute()
    {
        return $this->units->first()->bedrooms ?? 0;
    }

    public function getBathroomAttribute()
    {
        return $this->units->first()->bathrooms ?? 0;
    }

    public function getAreaAttribute()
    {
        return $this->units->first()->size_sqft ?? 0;
    }

    public function getImageAttribute()
    {
        return $this->gallery->first()->file_name ?? null;
    }
}
