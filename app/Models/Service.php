<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    // ✅ Daftar kolom yang boleh diisi secara massal
    protected $fillable = [
        'customer',
        'phone_model',
        'damage',
        'status',
        'pickup_code',
        'total_price',
        'received_at',
        'notes',
        'photo_path',   // ✅ bukti foto
        'timeline'      // ✅ timeline perbaikan
    ];

    public $timestamps = true;

    /**
     * ✅ Relasi ke ServiceItem (One-to-Many)
     * Satu service bisa memiliki banyak item sparepart
     */
    public function items()
    {
        return $this->hasMany(ServiceItem::class);
    }

    /**
     * ✅ Accessor untuk menghitung total harga sparepart
     * Bisa dipanggil dengan $service->items_total
     */
    public function getItemsTotalAttribute()
    {
        return $this->items()->sum('item_price');
    }

    /**
     * ✅ Mutator otomatis untuk menyimpan total_price dari items
     * Bisa dipanggil setiap kali menyimpan service
     */
    public function updateTotalPrice()
    {
        $this->total_price = $this->items_total;
        $this->save();
    }
}
