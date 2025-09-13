<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Poli;
use App\Models\User;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //1. Query Eloquent
        $appointments = Appointment::latest()->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Eloquent ORM
        $patients = Patient::all();
        $polis = Poli::all();
        $doctors = User::whereHas('role', fn($q) =>$q->where('name', 'Doctor'))->get();
        return view('appointments.create', compact('patients', 'polis', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1. validate
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'poli_id' => 'required|exists:polis,id',
            'doctor_id' => 'required|exists:users,id',
            'schedule' => 'required|date',
        ]);

        //Query
        Appointment::create($request->all());
        return redirect()->route('appointments.index')->with('success', 'Appointment berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
