<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function switch(string $locale): RedirectResponse
    {
        if (!in_array($locale, ['kk', 'ru', 'en'])) {
            abort(400);
        }

        Session::put('locale', $locale);
        App::setLocale($locale);

        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }

        return back();
    }
}
