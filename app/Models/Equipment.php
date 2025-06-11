<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'equipment';

    protected $fillable = [
        'client_id',
        'type',
        'brand',
        'model',
        'serial_number',
        'description',
        'problem_description',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
} 