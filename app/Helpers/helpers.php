<?php

if (! function_exists("tanggal")) {


    function tanggal($tgl, $tampil_hari = true)
    {
        $nama_hari  = array(
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        );
        $nama_bulan = array(
            1 =>
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Agust', 'Sep', 'Oct', 'Nov', 'Dec'
        );

        $tahun   = substr($tgl, 0, 4);
        $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
        $tanggal = substr($tgl, 8, 2);
        $text    = '';

        if ($tampil_hari) {
            $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
            $hari        = $nama_hari[$urutan_hari];
            $text       .= "$hari, $tanggal $bulan $tahun";
        } else {
            $text       .= "$tanggal $bulan $tahun";
        }

        return $text;
    }
}
