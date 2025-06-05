@extends("layouts.admin")

@section("title", "Beranda")

@section("content")

    <div class="d-flex justify-content-end mb-4">
        <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#addTransactionModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Transaksi Baru
        </button>
    </div>

    <div class="card mb-4 shadow">
        <div class="card-header d-flex align-items-center justify-content-between flex-row py-3">
            <h6 class="font-weight-bold text-primary m-0">Data Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="mb-4 rounded border p-3" style="background-color: #f8f9fc;">
                <form action="{{ route("beranda") }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="filter_category" class="form-label">Kategori:</label>
                            <select name="filter_category" id="filter_category" class="form-control">
                                <option value="">-- Semua Kategori --</option>
                                <option value="pendapatan"
                                    {{ ($filters["filter_category"] ?? "") == "pendapatan" ? "selected" : "" }}>Pendapatan
                                </option>
                                <option value="pengeluaran"
                                    {{ ($filters["filter_category"] ?? "") == "pengeluaran" ? "selected" : "" }}>Pengeluaran
                                </option>
                                <option value="modal"
                                    {{ ($filters["filter_category"] ?? "") == "modal" ? "selected" : "" }}>Modal</option>
                                <option value="utang"
                                    {{ ($filters["filter_category"] ?? "") == "utang" ? "selected" : "" }}>Utang</option>
                                <option value="aset"
                                    {{ ($filters["filter_category"] ?? "") == "aset" ? "selected" : "" }}>Aset</option>
                                <option value="prive"
                                    {{ ($filters["filter_category"] ?? "") == "prive" ? "selected" : "" }}>Prive</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Dari Tanggal:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ $filters["start_date"] ?? "" }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">Sampai Tanggal:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ $filters["end_date"] ?? "" }}">
                        </div>
                        <div class="col-md-3 d-flex">
                            <button type="submit" class="btn btn-info flex-grow-1 me-2 shadow-sm">
                                <i class="fas fa-filter fa-sm"></i> Filter
                            </button>
                            <a href="{{ route("transactions.export", request()->query()) }}"
                                class="btn btn-success shadow-sm">
                                <i class="fas fa-file-excel fa-sm"></i> Export
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table-bordered table-hover table" id="dataTable" width="100%" cellspacing="0">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th class="text-end">Debit (Rp)</th>
                            <th class="text-end">Kredit (Rp)</th>
                            <th width="8%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $debitCategories = ["pendapatan", "modal", "utang"];
                            $kreditCategories = ["pengeluaran", "prive", "aset"];
                        @endphp
                        @forelse ($transactions as $key => $transaction)
                            <tr>
                                <td class="text-center">{{ $transactions->firstItem() + $key }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($transaction->date)->format("d M Y") }}
                                </td>
                                <td>
                                    <span
                                        class="badge @switch($transaction->category)
                                @case("pendapatan") bg-success text-white @break
                                @case("pengeluaran") bg-danger text-white @break
                                @case("modal") bg-primary text-white @break
                                @case("prive") bg-dark text-white @break
                                @case("utang") bg-warning text-white @break
                                @case("aset") bg-info text-white @break
                                @default bg-secondary
                            @endswitch">
                                        {{ ucfirst($transaction->category) }}
                                    </span>
                                </td>
                                <td>{{ $transaction->description }}</td>

                                {{-- Kolom Debit --}}
                                <td class="text-end">
                                    @if (in_array($transaction->category, $debitCategories))
                                        {{ number_format($transaction->amount, 0, ",", ".") }}
                                    @endif
                                </td>

                                {{-- Kolom Kredit --}}
                                <td class="text-end">
                                    @if (in_array($transaction->category, $kreditCategories))
                                        {{ number_format($transaction->amount, 0, ",", ".") }}
                                    @endif
                                </td>

                                <td class="text-center">
                                    <form action="{{ route("transactions.destroy", $transaction->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center">
                                    Tidak ada data yang cocok.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr class="table-light font-weight-bold">
                            <td colspan="4" class="text-end">Total</td>
                            <td class="text-success text-end">Rp {{ number_format($totalDebit, 0, ",", ".") }}</td>
                            <td class="text-danger text-end">Rp {{ number_format($totalKredit, 0, ",", ".") }}</td>
                            <td></td>
                        </tr>
                        <tr class="table-light font-weight-bold">
                            <td colspan="4" class="text-end">Saldo Akhir</td>
                            <td colspan="2" class="h5 text-center">Rp
                                {{ number_format($totalDebit - $totalKredit, 0, ",", ".") }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        @endsection

        @section("scripts")
            <script>
                // Menangkap event submit pada semua form dengan class 'delete-form'
                $('.delete-form').on('submit', function(e) {
                    e.preventDefault(); // Mencegah form untuk submit secara default

                    var form = this; // Simpan referensi ke form yang di-trigger

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika pengguna mengklik "Ya, hapus!", maka submit form
                            form.submit();
                        }
                    });
                });
            </script>
            {{-- Jika ada error validasi, modal akan otomatis terbuka kembali saat halaman refresh --}}
            @if ($errors->any())
                <script>
                    $(document).ready(function() {
                        $('#addTransactionModal').modal('show');
                    });
                </script>
            @endif
        @endsection
