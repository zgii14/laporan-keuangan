@extends("layouts.admin")

@section("title", "Laporan Neraca")

@section("content")
    <div class="row">

        <div class="col-lg-6">
            <div class="card mb-4 shadow">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold text-primary m-0">AKTIVA (Harta)</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Aset
                            <span>Rp {{ number_format($aset, 0, ",", ".") }}</span>
                        </li>
                        {{-- Tambahkan item Aktiva lain di sini jika ada --}}
                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                            TOTAL AKTIVA
                            <span>Rp {{ number_format($aset, 0, ",", ".") }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4 shadow">
                <div class="card-header py-3">
                    <h6 class="font-weight-bold text-primary m-0">PASIVA (Utang + Modal)</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Utang
                            <span>Rp {{ number_format($utang, 0, ",", ".") }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Modal Akhir
                            <span>Rp {{ number_format($modalAkhir, 0, ",", ".") }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                            TOTAL PASIVA
                            <span>Rp {{ number_format($totalPasiva, 0, ",", ".") }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
