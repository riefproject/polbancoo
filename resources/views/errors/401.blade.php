@extends('errors.layout')

@section('title', 'Butuh Akses')
@section('code', '401')
@section('headline', 'Akses Memerlukan Masuk')
@section('message', 'Anda perlu masuk sebagai anggota sah KopSy-Campus Polban sebelum dapat melanjutkan ke halaman ini.')

@section('actions')
    @if (Route::has('login'))
        <a class="btn btn-primary" href="{{ route('login') }}">Masuk ke Akun</a>
    @endif
    <a class="btn btn-outline" href="{{ url('/') }}">Kembali ke Beranda</a>
@endsection
