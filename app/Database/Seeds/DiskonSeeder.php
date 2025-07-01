<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'tanggal' => date('Y-m-d', strtotime("+$i days")),
                'nominal'  => 100000 * (($i % 3) + 1),
                'created_at' => date("Y-m-d H:i:s"),
            ];
        }

        // Using Query Builder
        $this->db->table('diskon')->insertBatch($data);
    }
}