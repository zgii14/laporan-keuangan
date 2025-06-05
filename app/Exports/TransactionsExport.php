<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    protected array $filters;

    /**
     * Menerima filter dari controller saat class ini diinisiasi.
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Menyiapkan query Eloquent untuk mengambil data dari database.
     * Menggunakan FromQuery lebih efisien untuk data besar.
     */
    public function query()
    {
        $query = Transaction::query()->orderBy('date', 'desc');

        // Terapkan filter jika ada
        if (!empty($this->filters['filter_category'])) {
            $query->where('category', $this->filters['filter_category']);
        }
        if (!empty($this->filters['start_date'])) {
            $query->whereDate('date', '>=', $this->filters['start_date']);
        }
        if (!empty($this->filters['end_date'])) {
            $query->whereDate('date', '<=', $this->filters['end_date']);
        }

        return $query;
    }

    /**
     * Menentukan judul untuk setiap kolom di file Excel.
     */
    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Tanggal',
            'Kategori',
            'Deskripsi',
            'Jumlah (Rp)',
            'Tanggal Input',
        ];
    }

    /**
     * Memetakan data dari setiap baris transaksi ke format array.
     * @param Transaction $transaction
     */
    public function map($transaction): array
    {
        return [
            $transaction->id,
            Carbon::parse($transaction->date)->format('d-m-Y'),
            ucfirst($transaction->category),
            $transaction->description,
            $transaction->amount,
            $transaction->created_at->format('d-m-Y H:i:s'),
        ];
    }
}