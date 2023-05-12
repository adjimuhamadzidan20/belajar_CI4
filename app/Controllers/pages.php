<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            "judul" => "beranda"
        ];

        return view('pages/beranda', $data);
    }

    public function tentang() {
        $data = [
            "judul" => "tentang"
        ];

        return view('pages/tentang', $data);
    }

    public function kontak() {
        $data = [
            "judul" => "kontak", 
        ];

        return view('pages/kontak', $data);
    }
}
