<?php

namespace Database\Seeders;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Poli;
use App\Models\User;

use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $patients = Patient::all();
       $polis = Poli::all();
       $doctors = User::whereHas('role', fn($q)=>$q->where('name', 'Doctor'))->get();

       foreach ($patients as $patient)
       {
          Appointment::create([
            'patient_id' => $patient->id,
            'poli_id' => $polis->random()->id,
            'doctor_id' => $doctors->random()->id,
            'schedule' => now()->addDays(rand(1,5)),
            'status' => 'waiting'
          ]);
       }

    }
}
