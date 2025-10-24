@extends('errors.layout')

@section('title', 'Tidak Ditemukan')
@section('code', '404')
@section('headline', 'Halaman Tidak Ditemukan')
@section('message', 'Kami tidak menemukan halaman yang Anda minta. Bisa jadi tautan sudah berubah atau informasi dipindahkan.')

@section('actions')
    <a class="btn btn-primary" href="{{ url('/') }}">Kembali ke Beranda KopSy-Campus</a>
@endsection
