<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SPAController extends Controller
{
    /**
     * Process all web routes
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function vue(): View
    {
        return view('app');
    }
}
