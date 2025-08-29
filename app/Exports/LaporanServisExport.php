<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanServisExport implements FromCollection, WithHeadings, WithTitle, WithMapping
{
    protected $start;
    protected $end;
    protected $user;

    public function __construct($start, $end, $user)
    {
        $this->start = $start;
        $this->end = $end;
        $this->user = $user;
    }

    public function collection()
    {
        return Service::onlyTrashed()
            ->with('items') // ✅ load sparepart
            ->whereBetween('deleted_at', [$this->start, $this->end])
            ->orderBy('deleted_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'HP',
            'Kerusakan',
            'Complain',
            'Status',
            'Nomor Pengambilan',
            'Sparepart & Harga', // ✅ kolom baru
            'Total Harga',
            'Waktu Dibayar',
        ];
    }

    public function map($row): array
    {
        // gabungkan sparepart dalam format "Item (RpHarga)"
        $items = $row->items->map(function ($i) {
            return $i->item_name . ' (Rp' . number_format($i->item_price, 0, ',', '.') . ')';
        })->implode(', ');

        return [
            $row->customer,
            $row->phone_model,
            $row->damage,
            $row->complain ?? '-',
            ucfirst($row->status),
            $row->pickup_code ?? '-',
            $items ?: '-', // ✅ sparepart
            'Rp' . number_format($row->total_price, 0, ',', '.'),
            \Carbon\Carbon::parse($row->deleted_at)->format('d-m-Y H:i'),
        ];
    }

    public function title(): string
    {
        return 'Export oleh: ' . $this->user->name;
    }
}
