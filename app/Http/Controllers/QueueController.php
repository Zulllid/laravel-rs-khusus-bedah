<?php

namespace App\Http\Controllers;
use App\Models\Queue;
use App\Models\Appointment;

use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
       $queues = Queue::with('appointment.patient', 'appointment.poli')
                ->orderBy('number')->get();
       return view('queues.index', compact('queues'));
    }

    public function enqueue(Appointment $appointment) 
    {
        //cari nomor antrian terakhir hari ini
        $lastQueue = Queue::whereDate('created_at', now()->toDateString())
                    ->latest('number')->first();//ambil satu baris pertama (nomor terbesar hari ini)
        $number = $lastQueue ? $lastQueue->number + 1 : 1; //tanda (:) itu bukan bagi. 
        //jadi jika data tidak null pada $lastQueue maka tambah 1, jika null, mulai dengan angka : 1.
        //mengapa harus ditambahkan 1? karena setiap nomor antrian akan bertambah supaya tidak bentrok dengan yang sebelumnya

        Queue::create([
            'appointment_id' => $appointment->id,
            'number' => $number,
            'status' => 'waiting'
        ]);

        return redirect()->route('queues.index')->with('success', 'Pasien masuk antrian');
    }

    public function callNext()
    {
        //kalau callNext dipanggil maka status berubah jadi called
        $next = Queue::where('status', 'waiting')->orderBy('number')->first();//ambil satu baris kolom urut dari pertama
        if($next) { //jika $next tidak nul? artinya ada datanya, 
            $next->status = 'called'; //maka ubah jadi called
            $next->save();
        }
        return redirect()->route('queues.index');
    }

    public function done(Queue $queue)
    {
        $queue->status = 'done';
        $queue->save();
        return redirect()->route('queues.index');
    }
}
