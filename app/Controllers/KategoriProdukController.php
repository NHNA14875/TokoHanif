<?php

namespace App\Controllers;

use App\Models\KategoriProdukModel;

class KategoriProdukController extends BaseController
{
    protected $kategori;

    function __construct()
    {
        $this->kategori = new KategoriProdukModel();
    }

    public function index()
    {
        $kategori = $this->kategori->findAll();
        $data['kategori'] = $kategori;

        return view('v_kategori_produk', $data);
    }

    public function create()
    {
        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'created_at' => date("Y-m-d H:i:s")
        ];

        $this->kategori->insert($dataForm);

        return redirect('kategori-produk')->with('success', 'Data Berhasil Ditambah');
    } 

    public function edit($id)
    {
        $dataForm = [
            'nama' => $this->request->getPost('nama'),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $this->kategori->update($id, $dataForm);

        return redirect('kategori-produk')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $this->kategori->delete($id);

        return redirect('kategori-produk')->with('success', 'Data Berhasil Dihapus');
    }
}