<?php

namespace App\Http\Controllers\Web;

use App\Eloquents\MagazineLog;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class LogController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('log');
    }
}
