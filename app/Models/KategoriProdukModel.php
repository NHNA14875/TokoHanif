<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriProdukModel extends Model
{
    protected $table = 'kategori_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'created_at', 'updated_at'];
}