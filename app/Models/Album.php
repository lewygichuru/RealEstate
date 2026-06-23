<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $fillable = ['model_type', 'model_id', 'title', 'order'];

    public function model()
    {
        return $this->morphTo();
    }

    public function files()
    {
        return $this->morphMany(File::class, 'model');
    }
}
