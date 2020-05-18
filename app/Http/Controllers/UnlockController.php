<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UnlockController extends Controller
{
    /**
     * Unlock a paste protected by a password
     *
     * @param Request $request
     * @param string $slug
     * @return JsonResponse
     */
    public function unlock(Request $request): JsonResponse
    {
        $slug = $request->input('slug');
        $password = $request->input('password');
        $paste = Paste::where('slug', $slug)->first();

        if($paste && $paste->private === $password) {

            return response()->json([

                'success' => true,
                'user' => $paste->user,
                'language' => $paste->language,
                'title' => $paste->title,
                'code' => $paste->code,
                'private' => false,
            ]);
        }

        return response()->json([

            'success' => false,
        ]);
    }
}
