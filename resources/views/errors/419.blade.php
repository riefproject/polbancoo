@extends('errors.layout')

@section('title', 'Sesi Berakhir')
@section('code', '419')
@section('headline', 'Sesi Anda Telah Kedaluwarsa')
@section('message', 'Untuk menjaga keamanan transaksi di KopSy-Campus Polban, sesi Anda otomatis berakhir setelah periode tidak aktif.')

@section('actions')
    <a class="btn btn-primary" href="{{ url()->previous() ?: url('/') }}">Muat Ulang Halaman</a>
    @if (Route::has('login'))
        <a class="btn btn-outline" href="{{ route('login') }}">Masuk Kembali</a>
    @endif
@endsection
