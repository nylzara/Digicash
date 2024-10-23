<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('tgl_indo')) {
    // Function format tanggal Indonesia
    function tgl_indo($tanggal) {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );

        $pecahkan = explode('-', $tanggal);

        // variable pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

if (!function_exists('num')) {
    // Function format rupiah
    function num($rp) {
        if ($rp != 0) {
            $hasil = number_format($rp, 0, ',', '.'); // Menggunakan koma sebagai pemisah desimal dan titik sebagai pemisah ribuan
        } else {
            $hasil = 0;
        }
        return $hasil;
    }
}