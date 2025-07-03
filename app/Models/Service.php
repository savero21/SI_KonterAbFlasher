<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;

    // Daftar kolom yang boleh diisi secara massal (mass assignment)
    protected $fillable = [
      'customer', 'phone_model', 'damage', 'status',
    'pickup_code', 'total_price', 'received_at', 'notes'
    ];
         public $timestamps = true;

    use SoftDeletes;

}
