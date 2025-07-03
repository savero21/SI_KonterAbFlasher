<?php

namespace App\Exports;

use App\Models\Service;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class LaporanServisExport implements FromCollection, WithHeadings, WithTitle
{
    protected $start;
    protected $end;
    protected $user;

    /**
     * Konstruktor dengan parameter dinamis
     */
    public function __construct($start, $end, $user)
    {
        $this->start = $start;
        $this->end = $end;
        $this->user = $user;
    }

    /**
     * Ambil data dari database yang sudah soft-deleted
     */
    public function collection()
    {
        return Service::onlyTrashed()
            ->whereBetween('deleted_at', [$this->start, $this->end])
            ->select('customer', 'phone_model', 'status', 'total_price', 'deleted_at')
            ->orderBy('deleted_at', 'desc')
            ->get();
    }

    /**
     * Judul header kolom
     */
    public function headings(): array
    {
        return ['Nama', 'HP', 'Status', 'Total Harga', 'Waktu Dihapus'];
    }

    /**
     * Nama sheet
     */
    public function title(): string
    {
        return 'Export oleh: ' . $this->user->name;
    }
}
