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
            'Total Harga',
            'Waktu Dihapus',
        ];
    }

    public function map($row): array
    {
        return [
            $row->customer,
            $row->phone_model,
            $row->damage,
            $row->complain ?? '-', // tambahkan complain
            ucfirst($row->status),
            $row->pickup_code ?? '-',
            'Rp' . number_format($row->total_price, 0, ',', '.'),
            \Carbon\Carbon::parse($row->deleted_at)->format('d-m-Y H:i'),
        ];
    }

    public function title(): string
    {
        return 'Export oleh: ' . $this->user->name;
    }
}
