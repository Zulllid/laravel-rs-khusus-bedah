@extends('layouts.app')

@section('content')
<h1 class="text-xl font-bold mb-3">Daftar Appointment</h1>

@if(session('success'))
    <div class="bg-green-200 p-2 mb-3">{{ session('success') }}</div>
@endif

<table class="min-w-full bg-white shadow-md rounded">
    <thead>
        <tr class="bg-gray-200 text-left">
            <th class="px-4 py-2">Pasien</th>
            <th class="px-4 py-2">Poli</th>
            <th class="px-4 py-2">Dokter</th>
            <th class="px-4 py-2">Jadwal</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td class="border px-4 py-2">{{ $appointment->patient->name }}</td>
            <td class="border px-4 py-2">{{ $appointment->poli->name }}</td>
            <td class="border px-4 py-2">{{ $appointment->doctor->name }}</td>
            <td class="border px-4 py-2">{{ $appointment->schedule }}</td>
            <td class="border px-4 py-2">
                {{-- Tombol Masuk Antrian --}}
                <form action="{{ route('queues.enqueue', $appointment) }}" method="POST">
                    @csrf
                    <button type="submit" style="background:red;color:black">
                        Masuk Antrian
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
<div class="mt-3">
    {{ $appointments->links() }}
</div>
@endsection
