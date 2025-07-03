<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Illuminate\Support\Carbon;

class DummyServiceSeeder extends Seeder
{
    public function run()
    {
        $statusList = ['masuk', 'diperbaiki', 'selesai'];
        $today = Carbon::today();

        // Buat 30 data dummy dengan tanggal acak dalam 30 hari terakhir
        for ($i = 0; $i < 30; $i++) {
            Service::create([
                'customer' => 'Pelanggan ' . ($i + 1),
                'phone_model' => 'HP Model ' . rand(1, 10),
                'damage' => 'Kerusakan contoh',
                'status' => $statusList[array_rand($statusList)],
                'received_at' => $today->copy()->subDays(rand(0, 29)),
                'notes' => 'Catatan servis ke-' . ($i + 1)
            ]);
        }
    }
}
