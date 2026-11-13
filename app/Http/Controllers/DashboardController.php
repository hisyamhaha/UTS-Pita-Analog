<?php

namespace App\Http\Controllers;

use App\Services\KoleksiService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected KoleksiService $koleksiService
    ) {}

    /**
     * Tampilkan halaman dashboard statistik utama.
     */
    public function index(): View
    {
        $stats = $this->koleksiService->getDashboardStatistics();

        return view('dashboard.index', $stats);
    }
}
