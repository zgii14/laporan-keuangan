<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransactionRequest; // Gunakan Form Request kita
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    // Menampilkan halaman utama dengan filter
     public function index(Request $request)
    {
        // Query dasar dengan filter
        $query = Transaction::query();
        if ($request->filled('filter_category')) $query->where('category', $request->filter_category);
        if ($request->filled('start_date')) $query->whereDate('date', '>=', $request->start_date);
        if ($request->filled('end_date')) $query->whereDate('date', '<=', $request->end_date);

        // Definisikan kategori untuk Debit dan Kredit
        $debitCategories = ['pendapatan', 'modal', 'utang'];
        $kreditCategories = ['pengeluaran', 'prive', 'aset'];

        // Hitung total Debit dan Kredit dari query yang sudah difilter
        // Kita clone query agar perhitungan total tidak terpengaruh oleh paginasi
        $totalDebit = (clone $query)->whereIn('category', $debitCategories)->sum('amount');
        $totalKredit = (clone $query)->whereIn('category', $kreditCategories)->sum('amount');
        
        // Ambil data transaksi dengan paginasi
        $transactions = $query->latest('date')->paginate(15);

        // Kirim semua data yang dibutuhkan ke view
        return view('dashboard', [
            'transactions' => $transactions,
            'filters' => $request->all(),
            'totalDebit' => $totalDebit,
            'totalKredit' => $totalKredit,
        ]);
    }
    // Menyimpan data, validasi ditangani oleh StoreTransactionRequest
    public function store(StoreTransactionRequest $request)
    {
        Transaction::create($request->validated());
        return redirect()->route('beranda')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    // Menghapus data menggunakan Route Model Binding
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('beranda')->with('success', 'Transaksi berhasil dihapus.');
    }

    // Mengekspor data
    public function export(Request $request)
    {
        // Buat nama file yang akan diunduh, contoh: transaksi_2025-06-05.xlsx
        $fileName = 'transaksi_' . date('Y-m-d') . '.xlsx';

        // Panggil class export kita sambil meneruskan filter dari request,
        // lalu unduh sebagai file Excel.
        return Excel::download(new TransactionsExport($request->all()), $fileName);
    }
}