<?php

namespace App\Services;

use App\Models\Transaction;

class FinancialReportService
{
    /**
     * Menghitung data untuk Laporan Laba Rugi.
     * @return array
     */
    public function getLabaRugiData(): array
    {
        $pendapatan = Transaction::where('category', 'pendapatan')->sum('amount');
        $pengeluaran = Transaction::where('category', 'pengeluaran')->sum('amount');
        $labaBersih = $pendapatan - $pengeluaran;

        return compact('pendapatan', 'pengeluaran', 'labaBersih');
    }

    /**
     * Menghitung data untuk Laporan Perubahan Modal.
     * @return array
     */
    public function getPerubahanModalData(): array
    {
        $labaRugiData = $this->getLabaRugiData();
        $labaBersih = $labaRugiData['labaBersih'];

        $modalAwal = Transaction::where('category', 'modal')->sum('amount');
        $prive = Transaction::where('category', 'prive')->sum('amount');
        $modalAkhir = $modalAwal + $labaBersih - $prive;

        return compact('modalAwal', 'labaBersih', 'prive', 'modalAkhir');
    }

    /**
     * Menghitung data untuk Laporan Neraca.
     * @return array
     */
    public function getNeracaData(): array
    {
        $perubahanModalData = $this->getPerubahanModalData();
        $modalAkhir = $perubahanModalData['modalAkhir'];

        $aset = Transaction::where('category', 'aset')->sum('amount');
        $utang = Transaction::where('category', 'utang')->sum('amount');
        $totalPasiva = $utang + $modalAkhir;

        return compact('aset', 'utang', 'modalAkhir', 'totalPasiva');
    }

    /**
     * Menghitung data untuk Laporan Arus Kas.
     * @return array
     */
    public function getArusKasData(): array
    {
        // Kategori yang dianggap sebagai pemasukan kas
        $pemasukanCategories = ['pendapatan', 'modal', 'utang'];
        // Kategori yang dianggap sebagai pengeluaran kas
        $pengeluaranCategories = ['pengeluaran', 'prive', 'aset'];

        $totalDebit = Transaction::whereIn('category', $pemasukanCategories)->sum('amount');
        $totalKredit = Transaction::whereIn('category', $pengeluaranCategories)->sum('amount');
        $netCashFlow = $totalDebit - $totalKredit;

        return compact('totalDebit', 'totalKredit', 'netCashFlow');
    }
}