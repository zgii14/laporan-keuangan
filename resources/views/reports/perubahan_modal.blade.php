@extends('layouts.admin')

@section('title', 'Laporan Perubahan Modal')

@section('content')
<div class="row">

    <div class="col-lg-6 mb-4">
        <div class="card bg-secondary text-white shadow">
            <div class="card-body">
                Modal Awal
                <div class="text-white-50 h5 mb-0">Rp {{ number_format($modalAwal, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                (+) Laba Bersih
                <div class="text-white-50 h5 mb-0">Rp {{ number_format($labaBersih, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                (-) Prive
                <div class="text-white-50 h5 mb-0">Rp {{ number_format($prive, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                (=) Modal Akhir
                <div class="text-white-50 h5 mb-0 font-weight-bold">Rp {{ number_format($modalAkhir, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

</div>
@endsection