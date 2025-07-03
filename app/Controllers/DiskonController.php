<?php

namespace App\Controllers;

use App\Models\DiskonModel;
use CodeIgniter\I18n\Time;

class DiskonController extends BaseController
{
    protected $diskon;

    function __construct()
    {
        helper('number');
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        $data['diskon'] = $this->diskon->findAll();
        return view('v_diskon', $data);
    }

    public function create()
    {
        $rules = [
            'tanggal' => [
                'rules' => 'required|is_unique[diskon.tanggal]',
                'errors' => [
                    'is_unique' => 'Diskon untuk tanggal tersebut sudah ada.'
                ]
            ],
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $tanggalDiskon = $this->request->getPost('tanggal');
        $nominalDiskon = $this->request->getPost('nominal');

        $this->diskon->insert([
            'tanggal'    => $tanggalDiskon,
            'nominal'    => $nominalDiskon,
            'created_at' => Time::now(config('App')->appTimezone),
        ]);

        $tanggalSekarang = Time::now(config('App')->appTimezone)->toDateString();
        if ($tanggalDiskon == $tanggalSekarang) {
            session()->set('diskon', $nominalDiskon);
        }

        return redirect('diskon')->with('success', 'Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $diskonData = $this->diskon->find($id);

        $this->diskon->update($id, [
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => Time::now(config('App')->appTimezone),
        ]);

        $tanggalDiskon = $diskonData['tanggal'];
        $tanggalSekarang = Time::now(config('App')->appTimezone)->toDateString();

        if ($tanggalDiskon == $tanggalSekarang) {
            session()->set('diskon', $this->request->getPost('nominal'));
        }

        return redirect('diskon')->with('success', 'Data Berhasil Diubah');
    }

    public function delete($id)
    {
        $diskonData = $this->diskon->find($id);
        
        $this->diskon->delete($id);

        if ($diskonData) {
            $tanggalDiskon = $diskonData['tanggal'];
            $tanggalSekarang = Time::now(config('App')->appTimezone)->toDateString();

            if ($tanggalDiskon == $tanggalSekarang) {
                session()->set('diskon', 0);
            }
        }
        
        return redirect('diskon')->with('success', 'Data Berhasil Dihapus');
    }
}
