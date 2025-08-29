<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'item_name',
        'item_price',
    ];

    /**
     * Relasi ke Service (Many-to-One)
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
