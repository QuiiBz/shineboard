<?php

namespace App\Http\Controllers;

use App\Paste;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UnlockController extends Controller
{
    /**
     * Unlock a paste protected by a password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function unlock(Request $request): JsonResponse
    {
        $slug = $request->input('slug');
        $password = $request->input('password');
        $paste = Paste::where('slug', $slug)->first();

        if($paste && $this->match($paste->private, $password)) {

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

    /**
     * Return if the password match the hash
     *
     * @param $hash
     * @param $password
     * @return bool
     */
    public function match($hash, $password): bool
    {
        return Hash::check($password, $hash);
    }
}
