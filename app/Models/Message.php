<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inquiry;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Message extends Model
{
    use HasUuids, LogsActivity;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'inquiry_id',
        'subject',
        'body',
        'read_at',
        'name',
        'email',
        'phone',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logFillable();
    }

    public function sender()
    {
        return $this->belongsTo(\App\Models\User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(\App\Models\User::class, 'receiver_id');
    }

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function getNameAttribute()
    {
        if (!empty($this->attributes['name'])) {
            return $this->attributes['name'];
        }
        return $this->inquiry ? $this->inquiry->name : ($this->sender ? $this->sender->name : 'Unknown');
    }

    public function getEmailAttribute()
    {
        if (!empty($this->attributes['email'])) {
            return $this->attributes['email'];
        }
        return $this->inquiry ? $this->inquiry->email : ($this->sender ? $this->sender->email : 'Unknown');
    }

    public function getPhoneAttribute()
    {
        if (!empty($this->attributes['phone'])) {
            return $this->attributes['phone'];
        }
        return $this->inquiry ? $this->inquiry->phone : ($this->sender ? $this->sender->phone : null);
    }

    public function getMessageAttribute()
    {
        return $this->body;
    }
}
