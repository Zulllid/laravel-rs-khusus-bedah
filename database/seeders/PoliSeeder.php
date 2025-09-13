<?php


namespace Database\Seeders;
use App\Models\Poli;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poli = ['Bedah', 'Urologi', 'Penyakit Dalam', 'OBGYN', 'Gigi'];
        foreach($poli as $name){
            Poli::create(['name' => $name]);
        }
    }
}
