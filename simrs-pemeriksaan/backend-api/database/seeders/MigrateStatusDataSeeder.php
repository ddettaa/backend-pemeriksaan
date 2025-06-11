<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\StatusHistory;

class MigrateStatusDataSeeder extends Seeder
{
    public function run()
    {
        try {
            DB::beginTransaction();

            // Migrasi status dari tabel pasien
            $pasiens = DB::table('pasien')->whereNotNull('status')->get();
            foreach ($pasiens as $pasien) {
                if ($pasien->status) {
                    StatusHistory::create([
                        'no_reg' => $pasien->no_reg,
                        'status' => $pasien->status,
                        'keterangan' => 'Status dari data pasien lama',
                        'changed_by_type' => 'sistem',
                        'changed_by_id' => 1, // ID sistem
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            // Migrasi status dari tabel pemeriksaan
            $pemeriksaans = DB::table('pemeriksaan')->whereNotNull('status')->get();
            foreach ($pemeriksaans as $pemeriksaan) {
                if ($pemeriksaan->status) {
                    StatusHistory::create([
                        'no_reg' => $pemeriksaan->no_registrasi,
                        'status' => $pemeriksaan->status,
                        'keterangan' => 'Status dari data pemeriksaan lama',
                        'changed_by_type' => 'sistem',
                        'changed_by_id' => 1, // ID sistem
                        'created_at' => $pemeriksaan->created_at ?? now(),
                        'updated_at' => $pemeriksaan->updated_at ?? now()
                    ]);
                }
            }

            DB::commit();
            $this->command->info('Status data berhasil dimigrasi ke status_histories');

        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error('Error saat migrasi status: ' . $e->getMessage());
            throw $e;
        }
    }
} 