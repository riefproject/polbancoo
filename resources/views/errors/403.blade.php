@extends('errors.layout')

@section('title', 'Tidak Diizinkan')
@section('code', '403')
@section('headline', 'Anda Tidak Memiliki Hak Akses')
@section('message', 'Halaman ini hanya tersedia untuk peran tertentu di KopSy-Campus. Silakan hubungi pengurus jika Anda memerlukan izin tambahan.')

@section('actions')
    <a class="btn btn-outline" href="{{ url()->previous() ?: url('/') }}">Kembali</a>
@endsection
