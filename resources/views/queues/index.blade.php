@extends('layouts.app')

@section('content')
    <h1 class="text-xl font-hold mb-3">Daftar Antrian</h1>

    @if (session('success'))
        <div class="bg-green-200 p-2 mb-3">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white shadow-md rounded">
    <thead>
        <tr class="bg-gray-200 text-left">
            <th class="px-4 py-2">No Antrian</th>
            <th class="px-4 py-2">Pasien</th>
            <th class="px-4 py-2">Poli</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($queues as $q)
        <tr>
            <td class="border px-4 py-2">{{ $q->number }}</td>
            <td class="border px-4 py-2">{{ $q->appointment->patient->name }}</td>
            <td class="border px-4 py-2">{{ $q->appointment->poli->name }}</td>
            <td class="border px-4 py-2">{{ $q->status }}</td>
            <td class="border px-4 py-2">
                @if($q->status=='waiting')
                <form action="{{ route('queues.done',$q) }}" method="POST" class="inline-block">
                    @csrf
                    <button class="text-green-500" type="submit">Selesai</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<form action="{{ route('queues.callNext') }}" method="POST" class="mt-3">
    @csrf
    <button class="bg-blue-500 text-white px-4 py-2 rounded">Panggil Next</button>
</form>
@endsection
