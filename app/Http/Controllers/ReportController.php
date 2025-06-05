<?php
namespace App\Http\Controllers;

use App\Services\FinancialReportService; // Inject Service kita

class ReportController extends Controller
{
    protected $reportService;

    // Gunakan Constructor Injection untuk memasukkan Service
    public function __construct(FinancialReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function arusKas()
    {
        $data = $this->reportService->getArusKasData();
        return view('reports.arus_kas', $data);
    }

    public function labaRugi()
    {
        $data = $this->reportService->getLabaRugiData();
        return view('reports.laba_rugi', $data);
    }

    public function perubahanModal()
    {
        $data = $this->reportService->getPerubahanModalData();
        return view('reports.perubahan_modal', $data);
    }

    public function neraca()
    {
        $data = $this->reportService->getNeracaData();
        return view('reports.neraca', $data);
    }
}