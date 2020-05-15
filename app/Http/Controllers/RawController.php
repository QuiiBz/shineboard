<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RawController extends Controller
{
    /**
     * Show a page with only raw content of the paste
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function raw(Request $request, string $slug): View
    {
        $paste = Paste::where('slug', $slug)->first();

        if($paste)
            return view('raw', ['paste' => $paste->code]);
        else
            return view('raw', ['paste' => 'This paste does not exist!']);
    }
}
