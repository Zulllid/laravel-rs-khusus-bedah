@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-3">Buat Janji</h1>

    @if ($errors->any())
    <div class="bg--red-200 p-2 mb-3">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label>Pasien</label>
            <select name="patient_id" class="border p-1 w-full">
                @foreach ($patients as $p)
                    <option value="{{ $p->id }}">{{ $p->no_rm }} - {{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Poli</label>
            <select name="poli_id" class="border p-1 w-full">
                @foreach ($polis as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Doctor</label>
            <select name="doctor_id" class="border p-1 w-full">
                @foreach ($doctors as $d)
                    <option value="{{ $d->id }}">{{ $d->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-2">
            <label>Jadwal</label>
            <input type="datetime-local" name="schedule" class="border p-1 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
@endsection