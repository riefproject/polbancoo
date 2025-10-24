@extends('errors.layout')

@section('title', 'Terlalu Banyak Permintaan')
@section('code', '429')
@section('headline', 'Terlalu Banyak Permintaan')
@section('message', 'Kami menerima terlalu banyak permintaan dalam waktu singkat. Mohon tunggu sejenak agar sistem KopSy-Campus tetap stabil untuk seluruh sivitas Polban.')

@section('actions')
    <a class="btn btn-primary" href="{{ url('/') }}">Kembali ke Beranda</a>
    <a class="btn btn-outline" href="https://www.polban.ac.id">Kunjungi Situs Polban</a>
@endsection
