@extends('layouts.app')

@section('content')
{{-- 1. Judul --}}
<h1 class="text-xl font-bold mb-3">Tambah</h1>

{{-- 2. tampilkan erorr jika ada --}}
@if ($errors->any())
<div class="bg-red-200 p-2 mb-3">
    <ul>
        @foreach ($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- 3. Form input --}}
<form action="{{ route('patients.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label>No RM</label>
        <input type="text" name="no_rm" class="border p-1 w-full" value="{{ old('no_rm') }}">
    </div>
    <div class="mb-2">
        <label>Nama</label>
        <input type="text" name="name" class="border p-1 w-full" value="{{ old('name') }}">
    </div>
    <div class="mb-2">
        <label>Gender</label>
        <select name="gender" class="border p-1 w-full">
            <option value="L" {{ old('gender') == 'L' ? 'selected': ''}}>Laki-Laki</option>
            <option value="P" {{ old('gender') == 'P' ? 'selected': ''}}>Perempuan</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
