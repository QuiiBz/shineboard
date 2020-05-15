<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class EmbedController extends Controller
{
    /**
     * Show a page with JS code for embed integration
     *
     * @param Request $request
     * @param string $slug
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function embed(Request $request, string $slug): \Illuminate\Http\Response
    {
        $paste = Paste::where('slug', $slug)->first();

        $js = 'document.write("<link rel=\'stylesheet\' href=\'' .config('app.url'). '/css/embed.css\'>");';
        $js .= 'document.write("<link rel=\'stylesheet\' href=\'' .config('app.url'). '/css/app.css\'>");';
        $js .= 'document.write("<script src=\'https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js\'></script>");';
        $js .= 'document.write("<div class=\'shrcode-embed\'><div class=\'header\'><p class=\'title\'>' .$paste->title. '</p></div><div class=\'paste\'><pre class=\'language-\'><code class=\'language-\'>' .$paste->code. '</code></pre></div></div>");';
        $js .= 'document.write("<script type=\'text/javascript\'>document.querySelectorAll(\'pre code\').forEach(block => hljs.highlightBlock(block));</script>");';

        $contents = view('embed', compact('js'));

        return response($contents)
            ->header('Content-Type', 'application/javascript');
    }
}
