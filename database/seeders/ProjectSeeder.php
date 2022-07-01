<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => "Pembuatan SI Keuangan",
            'client' => "Bakeuda Prov. Kalsel",
            'leader' => "Indra Setiawan",
            'email' => "Indra.setiawan@gmail.com",
            'start' => date("2022-01-14"),
            'end' => date("2022-08-14"),
            'progress' => "30",
            'image' => "upload/profile.jpg",
        ]);

        DB::table('projects')->insert([
            'name' => "Learning Management System",
            'client' => "Ruang Guru",
            'leader' => "Hilman Syaputera",
            'email' => "hilman.syah@gmail.com",
            'start' => date("2022-01-30"),
            'end' => date("2022-03-10"),
            'progress' => "80",
            'image' => "upload/profile.jpg",
        ]);

        DB::table('projects')->insert([
            'name' => "SI Pendataan Atlet Daerah",
            'client' => "Dispora Jawa Timur",
            'leader' => "Febri Gunawan",
            'email' => "febri.gunawan@gmail.com",
            'start' => date("2022-02-02"),
            'end' => date("2022-05-30"),
            'progress' => "40",
            'image' => "upload/profile.jpg",
        ]);

        DB::table('projects')->insert([
            'name' => "Employee Monitoring",
            'client' => "PT. Bina Sarana Sukses",
            'leader' => "Handoko Aji",
            'email' => "handoko.aji@gmail.com",
            'start' => date("2021-09-02"),
            'end' => date("2022-01-15"),
            'progress' => "100",
            'image' => "upload/profile.jpg",
        ]);
    }
}
