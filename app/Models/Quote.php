<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'equipment_id',
        'quote_number',
        'labor_cost',
        'parts_cost',
        'additional_costs',
        'discount',
        'total',
        'diagnosis',
        'services_description',
        'notes',
        'status',
        'approved_at',
        'completed_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function calculateTotal()
    {
        $this->total = ($this->labor_cost + $this->parts_cost + $this->additional_costs) - $this->discount;
        return $this->total;
    }
}
