<?php

namespace App\Controllers;

use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskon;

    function __construct()
    {
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        $data['diskon'] = $this->diskon->findAll();
        return view('v_diskon', $data);
    }

    public function create()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tanggal' => 'required|is_unique[diskon.tanggal]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->diskon->insert([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal'),
            'created_at' => date("Y-m-d H:i:s")
        ]);
        return redirect('diskon')->with('success', 'Data Berhasil Ditambah');
    }

    public function update($id = null)
    {
        $this->diskon->update($id, [
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        return redirect('diskon')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id = null)
    {
        $this->diskon->delete($id);
        return redirect('diskon')->with('success', 'Data Berhasil Dihapus');
    }
}