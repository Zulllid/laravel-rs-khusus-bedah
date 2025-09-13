<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
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
            'no_rm' => 'required|unique:patients,no_rm',
            'name' => 'required|string|max:225',
            'gender' => 'required|in:L,P',
        ]);

        //2. Query Eloquent
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //1. validate
        $request->validate([
            'no_rm' => 'required|unique:patients,no_rm' . $patient->id,
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
        ]);

        //2. Query Eloquent
        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil di perbarui.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Pasien berhasil di hapus');
    }
}
