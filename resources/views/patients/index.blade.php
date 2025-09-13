@extends('layouts.app')

@section('content')

{{--1. div untuk judul dan tombol --}}
<div class="flex justify-between mb-3">
    <h1 class="text-xl font-bold">Daftar Pasien</h1>
    <a href="{{ route('patients.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Pasien</a>
</div>

{{-- 2. kalau ada pesan sukses --}}
@if (session('success'))
    <div class="bg-green-200 text-green-800 p-2 rounded mb-2">
    {{ session('success') }}
    </div>
@endif


{{--3. Tabel daftar Pasien --}}
<table class="min-w-full bg-white shadow-md rounded">
    <thead>
        <tr class="bg-gray-200 text-left">
            <th class="px-4 py-2">No RM</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Gender</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $patient)
        <tr>
            <td class="border px-4 py-2">{{ $patient->no_rm }}</td>
            <td class="border px-4 py-2">{{ $patient->name }}</td>
            <td class="border px-4 py-2">{{ $patient->gender }}</td>
            <td class="border px-4 py-2">
                <a href="{{ route('patients.edit', $patient) }}" class="text-blue-500">Edit</a> |
                <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline-block">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin Hapus?')" class="text-red-500">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
