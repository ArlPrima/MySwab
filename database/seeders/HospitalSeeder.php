<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hospitals')->insert([
            'name'       => 'Rumah Sakit Bunda Dalima',
            'address'    => 'Jl. Batam, Rw. Mekar Jaya, Kec. Serpong, Kota Tangerang Selatan, Banten 15310',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('hospitals')->insert([
            'name'       => 'Eka Hospital BSD',
            'address'    => 'Central Business District Lot. IX, Jl. Boulevard BSD Tim., Lengkong Gudang, Kec. Serpong, Kota Tangerang Selatan, Banten 15321',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('hospitals')->insert([
            'name'       => 'RS Ichsan Medical Centre Bintaro',
            'address'    => 'Jl. Jombang Raya No.56, Bintaro, Jombang, Kec. Ciputat, Kota Tangerang Selatan, Banten 15414',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('hospitals')->insert([
            'name'       => 'RS Medika BSD',
            'address'    => 'JL. Letnan Soetopo, No. 7, BSD Serpong, Kavling Komplek 3A, Lengkong Wetan, Tangerang, Lengkong Wetan, Kec. Serpong, Kota Tangerang Selatan, Banten 15310',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }
}
